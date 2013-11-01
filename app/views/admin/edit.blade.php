@extends('layouts.admin')

{{--  @section('sidebar')
     @parent

    <p>This is appended to the master sidebar.</p> 
 @stop
--}}

@section('style')
@parent
	<style type="text/css">
      .form-signin {
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

      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }

      .form-signin input[type="text"],
      .form-signin input[type="password"],
      .form-signin label {
		/*min-height: 28px; */
        font-size: 14px;
        height: auto;
        margin-bottom: 10px;
        padding: 7px 9px;
      }

	</style>
@stop

@section('script')
	<script type="text/javascript">
		submitform = function(task)
		{
			form = document.getElementById('edit-form');
			form.task.value = task;
			//if ("function" == typeof b.onsubmit) b.onsubmit();
			//"function" == typeof b.fireEvent && b.fireEvent("submit");
			form.submit();
		}

	</script>
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
<div class="span12">
	{{ Form::open(array('route' => array('do-edit', $post->id), 'class' => 'form-signin', 'id' => 'edit-form')) }}
		<h3 class="form-signin-heading">Edit Post</h3>
		 <p>&nbsp;</p>

		<!-- Task -->
		{{ Form::hidden('task', '', array()) }}

		<!-- Submit button -->
		<div class="control-group">
			<div class="controls">
				<button href="#" onclick="submitform('apply')" class="btn btn-success"><i class="icon-edit icon-white"></i>Save</button>
				<button href="#" onclick="submitform('save')" class="btn"><i class="icon-ok"></i>Save &amp; Close</button>
				<button href="#" onclick="submitform('cancel')" class="btn"><i class="icon-remove"></i>Close</button>
			</div>
		</div>
		
		<p>&nbsp;</p>

		<!-- Title -->
		<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Title</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::text('title', (isset($post->title) ? $post->title : Input::old('title')), array('class'=>'span12')) }}
						</span>
						<span class="row-fluid">
							<span class="help-inline">{{ $errors->first('title') }}</span>
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- Slug -->
		<div class="control-group {{{ $errors->has('slug') ? 'error' : '' }}}">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Slug</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::text('slug', (isset($post->slug) ? $post->slug : Input::old('slug')), array('class'=>'span12')) }}
							{{ Form::hidden('old_slug', (isset($post->slug) ? $post->slug : Input::old('old_slug')), array()) }}
						</span>
						<span class="row-fluid">
							<span class="help-inline">{{ $errors->first('slug') }}</span>
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- Main tag -->
		<div class="control-group {{{ $errors->has('main_tag') ? 'error' : '' }}}">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Main Tag</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::text('main_tag', (isset($post->main_tag) ? $post->main_tag : Input::old('main_tag')), array('class'=>'span12','data-provide' => 'tag')) }}
							{{ Form::hidden('old_main_tag', (isset($post->main_tag) ? $post->main_tag : Input::old('old_main_tag')), array()) }}
						</span>
						<span class="row-fluid">
							<span class="help-inline">{{ $errors->first('main_tag') }}</span>
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- Minor tags -->
		<div class="control-group {{{ $errors->has('minor_tags') ? 'error' : '' }}}">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Minor Tags</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							<?php 
								$minorTags = '';

								if ($post)
								{	
									foreach ($post->tags as $oTag)
									{
										if ($oTag->tag != $post->main_tag)
										{
											$minorTags .= str_replace('-', ' ', $oTag->tag).',';
										}
									}
								}

								$minorTags = trim($minorTags, ',');
								
							?>
							{{ Form::text('minor_tags', ($minorTags ? $minorTags : Input::old('minor_tags')), array('class'=>'span12','data-provide' => 'tag')) }}
							{{ Form::hidden('old_minor_tags', ($minorTags ? $minorTags : Input::old('old_minor_tags')), array()) }}
						</span>
						<span class="row-fluid">							
							{{-- <span class="help-inline">{{ $errors->first('minor_tags') }}</span> --}}
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- Content -->
		<div class="control-group {{{ $errors->has('content') ? 'error' : '' }}}">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Content</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::textarea('content', (isset($post->content) ? $post->content : Input::old('content')), array('class'=>'span12','data-provide' => 'markdown', 'rows' => '10')) }}
						</span>
						<span class="row-fluid">
							<span class="help-inline">{{ $errors->first('content') }}</span>
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- Publish -->
		<div class="control-group">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">Publish?</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::checkbox('publish', 'publish', ((isset($post->published) ? $post->published : Input::old('publish')) ? true : false)) }}
						</span>
					</span>
				</fieldset>
			</div>
		</div>

		<!-- List -->
		<div class="control-group">
			<div class="controls">
				<fieldset class="form-inline">
					<span class="span2">
						<label class="control-label">List?</label>
					</span>
					<span class="span10">
						<span class="row-fluid">
							{{ Form::checkbox('list', 'list', ((isset($post->list) ? $post->list : Input::old('list')) ? true : false)) }}
						</span>
					</span>
				</fieldset>
			</div>
		</div>
	{{ Form::close() }}
</div>
</div>
@stop