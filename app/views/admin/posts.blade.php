@extends('layouts.admin')

@section('style')
@parent
	<style type="text/css">
		.form-login {
        /*max-width: 300px;*/
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }

    .form-login .form-login-heading,
      .form-login .checkbox {
        margin-bottom: 10px;
      }
	 
	</style>
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
	<h3 class="form-signin-heading">{{ Lang::get('site.posts') }}</h3>
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
		    @foreach ($posts as $post)
			     <tr><td>{{ $post->id }}</td><td>{{ $post->published }}</td><td><a href="{{ URL::Route('edit', array($post->id)) }}">{{ $post->title }}</a></td><td>{{ $post->main_tag }}</td><td>{{ $post->alias }}</td><td>{{ $post->created_at }}</td><td>{{ $post->updated_at }}</td></tr>
			 @endforeach
		  </tbody>
	  </table>
	</div>

	{{ $posts->links() }}
</div>
</div>
@stop