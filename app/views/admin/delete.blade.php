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
      form = document.getElementById('delete-form');
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
<div class="col-md-12 form-login">
	
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          <strong>{{ Lang::get('site.delete-post') }}</strong>
        </div>
      </div>
      <p>&nbsp;</p>
      <div class="row">
        <div class="col-md-offset-3 col-md-2">
          {{ Form::open(array('route' => array('do-delete', $post->id), 'id' => 'delete-form')) }}

            <!-- Task -->
            {{ Form::hidden('task', '', array()) }}
            
            <!-- Submit button -->
            <div class="form-group">
              <button href="#" onclick="submitform('delete')" class="btn btn-danger">{{ Lang::get('site.yes') }}</button>
            </div>
            
          {{ Form::close() }}
        </div>
        
        <div class="col-md-offset-1 col-md-2">
          <a href="#" class="btn btn-default" onclick="javascript:window.history.back(-1);return false;">{{ Lang::get('site.no') }}</a>
        </div>
      </div>
    </div>
  </div>

  <p>&nbsp;</p>

	<div class="table-responsive">
	  <table class="table table-hover table-bordered">
	  	<thead>
        <tr>
          <th>#Id</th>
          <th>{{ Lang::get('site.published') }}</th>
          <th>{{ Lang::get('site.title') }}</th>
          <th>{{ Lang::get('site.main-tag') }}</th>
          <th>{{ Lang::get('site.alias') }}</th>
          <th>{{ Lang::get('site.created') }}</th>
          <th>{{ Lang::get('site.modified') }}</th>
        </tr>
      </thead>
      <tbody>
			     <tr><td>{{ $post->id }}</td><td>{{ $post->published }}</td><td>{{ $post->title }}</td><td>{{ $post->main_tag }}</td><td>{{ $post->alias }}</td><td>{{ $post->created_at }}</td><td>{{ $post->updated_at }}</td></tr>
		  </tbody>
	  </table>
	</div>
</div>
</div>
@stop