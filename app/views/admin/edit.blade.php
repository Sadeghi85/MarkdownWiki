@extends('layouts.admin')

@section('style')
@parent
	<style type="text/css">
      .form-login {
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

      .form-login input[type="text"],
      .form-login input[type="password"],
      .form-login label {
		/*min-height: 28px; */
        font-size: 14px;
        height: auto;
        margin-bottom: 10px;
        padding: 7px 9px;
      }

	</style>
@stop

@section('javascript')
@parent
	<script type="text/javascript">
		submitform = function(task)
		{
			form = document.getElementById('edit-form');
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
	{{ Form::open(array('route' => array('do-edit', $post->id), 'class' => 'form-login', 'id' => 'edit-form')) }}
		<h3 class="form-login-heading">{{ Lang::get('site.edit-post') }}</h3>
		 <p>&nbsp;</p>

		<!-- Task -->
		{{ Form::hidden('task', '', array()) }}

		<!-- Submit button -->
		<div class="form-group">
			<button href="#" onclick="submitform('apply')" class="btn btn-success"><i class="icon-edit icon-white">&nbsp;</i>{{ Lang::get('site.save') }}</button>
			<button href="#" onclick="submitform('save')" class="btn btn-default"><i class="icon-ok">&nbsp;</i>{{ Lang::get('site.save-close') }}</button>
			<button href="#" onclick="submitform('cancel')" class="btn btn-default"><i class="icon-remove">&nbsp;</i>{{ Lang::get('site.close') }}</button>
		</div>
		
		<p>&nbsp;</p>
		
		<!-- Title -->
		<div class="form-group {{ $errors->has('title') ? 'error' : '' }}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.title') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('title', (isset($post->title) ? $post->title : Input::old('title')), array('class'=>'form-control')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('title') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Alias -->
		<div class="form-group {{{ $errors->has('alias') ? 'error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.alias') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('alias', (isset($post->alias) ? $post->alias : Input::old('alias')), array('class'=>'form-control')) }}
						{{ Form::hidden('old_alias', (isset($post->alias) ? $post->alias : Input::old('old_alias')), array()) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('alias') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Main tag -->
		<div class="form-group {{{ $errors->has('main-tag') ? 'error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.main-tag') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('main-tag',  (isset($post->main_tag) ? $post->main_tag : Input::old('main-tag')), array('class'=>'form-control', 'data-provide' => 'tag')) }}
						{{ Form::hidden('old_main-tag', (isset($post->main_tag) ? $post->main_tag : Input::old('old_main-tag')), array()) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('main-tag') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Minor tags -->
		<div class="form-group {{{ $errors->has('minor-tags') ? 'error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.minor-tags') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
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
						{{ Form::text('minor-tags', ($minorTags ? $minorTags : Input::old('minor-tags')), array('class'=>'form-control', 'data-provide' => 'tag')) }}
						{{ Form::hidden('old_minor-tags', ($minorTags ? $minorTags : Input::old('old_minor-tags')), array()) }}
					</div>
					<div class="row">							
						{{-- <div class="help-block">{{ $errors->first('minor-tags') }}</div> --}}
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Content -->
		<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.content') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::textarea('content', (isset($post->content) ? $post->content : Input::old('content')), array('class'=>'form-control','data-provide' => 'markdown', 'rows' => '10')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('content') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Featured -->
		<div class="form-group">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.featured') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::checkbox('featured', 'featured', ((isset($post->featured) ? $post->featured : Input::old('featured')) ? true : false), array('class' => 'checkbox-inline')) }}
					</div>
				</div>
			</fieldset>
		</div>

		<!-- List -->
		<div class="form-group">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.list') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::checkbox('list', 'list', ((isset($post->list) ? $post->list : Input::old('list')) ? true : false), array('class' => 'checkbox-inline')) }}
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Publish -->
		<div class="form-group">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.publish') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::checkbox('publish', 'publish', ((isset($post->published) ? $post->published : Input::old('publish')) ? true : false), array('class' => 'checkbox-inline')) }}
					</div>
				</div>
			</fieldset>
		</div>

	{{ Form::close() }}
</div>
</div>
@stop