@extends('layouts.admin')

@section('style')
@parent
  <style type="text/css">
      

  </style>
@stop

@section('javascript')
@parent
  <script type="text/javascript">
    submitform = function(task)
    {
      form = document.getElementById('new-form');
      form.task.value = task;
      form.submit();
    }
  </script>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
  <!-- Success-Messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>{{ Lang::get('site.success') }}</h4>
            <br />
            {{{ $message }}}
        </div>
    @endif
  </div>
</div>

<div class="row">
<div class="col-md-12">

  <ul class="nav nav-tabs nav-justified">
    <?php
      $mediaTabs = array('list' => 'active', 'upload' => '');
    ?>
     
    <li class="{{ $mediaTabs['list'] }}"><a data-toggle="tab" href="#list">{{ Lang::get('site.media') }}</a></li>
    <li class="{{ $mediaTabs['upload'] }}"><a data-toggle="tab" href="#upload">{{ Lang::get('site.upload') }}</a></li>
  </ul>

    <div id='content' class="tab-content">

      <div class="tab-pane {{ $mediaTabs['list'] }}" id="list">
        
        <div class="row">
          <div class="col-md-12 form-login">
            <h3 class="form-signin-heading">{{ Lang::get('site.media') }}</h3>
            <p>&nbsp;</p>
{{--
            {{ Form::open(array('url' => Route::getCurrentRoute()->getPath(), 'method' => 'get', 'class' => 'form-inline')) }}
              <div class="form-group">
                  {{ Form::text('s', Input::get('s'), array('class'=>'form-control', 'placeholder'=> Lang::get('site.search').'...', 'style' => 'width:250px;')) }}

                  <button class="btn btn-default btn-md" type="submit"><span class="glyphicon glyphicon-search"></button>
              </div>
            {{ Form::close() }}
--}}
            <p>&nbsp;</p>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>#Id</th>
                    <th>{{ Lang::get('site.file-name') }}</th>
                    <th>{{ Lang::get('site.file-size') }}</th>
                    <th>{{ Lang::get('site.created') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($media as $m)
                     <tr><td>{{ $m->id }}</td><td><a href="{{ URL::Route('media-download', array($m->id)) }}">{{ $m->name }}</a></td><td>{{ $m->size }}</td><td>{{ $m->created_at }}</td></tr>
                 @endforeach
                </tbody>
              </table>
            </div>

            {{ $media->links() }}
          </div>
        </div>

      </div>

      <div class="tab-pane {{ $mediaTabs['upload'] }}" id="upload">
        <div class="row">
          <div class="col-md-12 form-login">
            {{ Form::open(array('route' => 'upload', 'id' => 'media-form', 'files' => true)) }}
              <h3 class="form-login-heading">{{ Lang::get('site.upload-media') }}</h3>
               <p>&nbsp;</p>

                <div class="form-group">
                 
                  <a href="javascript:;" class="btn btn-default btn-md file-input-wrapper">Search for a file to add<input title="Search for a file to add" type="file" name="files[]" onchange='$("#file-info1").html($(this).val().replace(/(?:[^\/\\]*[\/\\])*(.+)/, "$1"));'></a>&nbsp;<span class='label label-info' id="file-info1"></span><p>&nbsp;</p>

                  <a href="javascript:;" class="btn btn-default btn-md file-input-wrapper">Search for a file to add<input title="Search for a file to add" type="file" name="files[]" onchange='$("#file-info2").html($(this).val().replace(/(?:[^\/\\]*[\/\\])*(.+)/, "$1"));'></a>&nbsp;<span class='label label-info' id="file-info2"></span><p>&nbsp;</p>

                  <a href="javascript:;" class="btn btn-default btn-md file-input-wrapper">Search for a file to add<input title="Search for a file to add" type="file" name="files[]" onchange='$("#file-info3").html($(this).val().replace(/(?:[^\/\\]*[\/\\])*(.+)/, "$1"));'></a>&nbsp;<span class='label label-info' id="file-info3"></span><p>&nbsp;</p>

                  <a href="javascript:;" class="btn btn-default btn-md file-input-wrapper">Search for a file to add<input title="Search for a file to add" type="file" name="files[]" onchange='$("#file-info4").html($(this).val().replace(/(?:[^\/\\]*[\/\\])*(.+)/, "$1"));'></a>&nbsp;<span class='label label-info' id="file-info4"></span><p>&nbsp;</p>

                  <button class="btn btn-primary btn-lg" type="submit"><span class="glyphicon glyphicon-upload"></button>
                </div>

            {{ Form::close() }}
          </div>
        </div>

      </div>
      
    </div>    

</div>
</div>
@stop