@extends('layouts.admin')

@section('style')
	@parent

	<style type="text/css">
		.posts-table {
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
	 
	</style>
@stop

@section('content')
<div class="row-fluid">
  <div class="span12">
      <!-- Success-Messages -->
      @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <h4>Success</h4>
              <br />
              {{{ $message }}}
          </div>
      @endif
  </div>
</div>

<div class="row-fluid">
<div class="span12 posts-table">
	<h3 class="form-signin-heading">Posts</h3>
	<p>&nbsp;</p>

	<div class="table-responsive">
	  <table class="table table-hover table-bordered">
	  	<thead>
        <tr>
          <th>#Id</th>
          <th>Published</th>
          <th>Title</th>
          <th>Main Tag</th>
          <th>Slug</th>
          <th>Created</th>
          <th>Modified</th>
        </tr>
      </thead>
      <tbody>
		    @foreach ($posts as $post)
			     <tr><td>{{ $post->id }}</td><td>{{ $post->published }}</td><td><a href="{{ URL::Route('edit', array($post->id)) }}">{{ $post->title }}</a></td><td>{{ $post->main_tag }}</td><td>{{ $post->slug }}</td><td>{{ $post->created_at }}</td><td>{{ $post->updated_at }}</td></tr>
			 @endforeach
		  </tbody>
	  </table>
	</div>

	{{ $posts->links() }}
</div>
</div>
@stop


