@extends('layouts.admin')

@section('style')
@parent
	<style type="text/css">

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
<div class="col-md-12">
	{{ Form::open(array('route' => 'do-new', 'class' => 'form-login', 'id' => 'new-form')) }}
		<h3 class="form-login-heading">{{ Lang::get('site.new-post') }}</h3>
		 <p>&nbsp;</p>

		<!-- Task -->
		{{ Form::hidden('task', '', array()) }}

		<!-- Submit button -->
		<div class="form-group">
			<button href="#" onclick="submitform('apply')" class="btn btn-success"><i class="glyphicon glyphicon-pencil">&nbsp;</i>{{ Lang::get('site.save') }}</button>
			<button href="#" onclick="submitform('save')" class="btn btn-default"><i class="glyphicon glyphicon-ok">&nbsp;</i>{{ Lang::get('site.save-close') }}</button>
			<button href="#" onclick="submitform('cancel')" class="btn btn-default"><i class="glyphicon glyphicon-remove">&nbsp;</i>{{ Lang::get('site.close') }}</button>
		</div>

		<p>&nbsp;</p>
		
		<!-- Title -->
		<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.title') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('title', Input::old('title'), array('class'=>'form-control')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('title') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Alias -->
		<div class="form-group {{{ $errors->has('alias') ? 'has-error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.alias') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('alias', Input::old('alias'), array('class'=>'form-control')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('alias') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Main tag -->
		<div class="form-group {{{ $errors->has('main-tag') ? 'has-error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.main-tag') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('main-tag', Input::old('main-tag'), array('class'=>'form-control', 'data-provide' => 'tag')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('main-tag') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Minor tags -->
		<div class="form-group {{{ $errors->has('minor-tags') ? 'has-error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.minor-tags') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::text('minor-tags', Input::old('minor-tags'), array('class'=>'form-control', 'data-provide' => 'tag')) }}
					</div>
					<div class="row">							
						{{-- <div class="help-block">{{ $errors->first('minor-tags') }}</div> --}}
					</div>
				</div>
			</fieldset>
		</div>

		<!-- Content -->
		<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
			<fieldset class="form-inline">
				<div class="col-md-2">
					<div class="row">
						<label class="control-label">{{ Lang::get('site.content') }}</label>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						{{ Form::textarea('content', Input::old('content'), array('class'=>'form-control','data-provide' => 'markdown', 'rows' => '10')) }}
					</div>
					<div class="row">
						<div class="help-block">{{ $errors->first('content') }}</div>
					</div>
				</div>
			</fieldset>
		</div>

		<div class="form-group">
		    <label class="col-md-2 control-label">{{ Lang::get('site.status') }}</label>
		    <div class="col-md-10">
		    	<div class="row">
			    	<!-- Featured -->
			      	<label class="control-label">
			      		{{ Form::checkbox('featured', 'featured', (Input::old('featured') ? true : false), array('class' => 'checkbox-inline')) }} {{ Lang::get('site.featured') }}
			      	</label>

			      	<!-- List -->
			      	<label class="control-label">
			       		 {{ Form::checkbox('list', 'list', (Input::old('list') ? true : false), array('class' => 'checkbox-inline')) }} {{ Lang::get('site.list') }}
		     	 	</label>

		     	 	<!-- Publish -->
			      	<label class="control-label">
			        {{ Form::checkbox('publish', 'publish', (Input::old('publish') ? true : false), array('class' => 'checkbox-inline')) }} {{ Lang::get('site.publish') }}
			      	</label>
		      	</div>
		    </div>
		</div>

		<p>&nbsp;</p>

		<hr>

		<!-- Button trigger modal -->
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			{{ Lang::get('site.add-attachment') }}
		</button>

		<p>&nbsp;</p>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">{{ Lang::get('site.add-attachment') }}</h4>
		      </div>
		      <div class="modal-body">

		      	<div class="form-group">
					<fieldset class="form-inline">
						<div class="col-md-2">
							<div class="row">
								<label class="control-label">{{ Lang::get('site.id') }}</label>
							</div>
						</div>
						<div class="col-md-1">
							<div class="row">
								<input class="form-control" name="fake-attachment-id" id="fake-attachment-id" type="text">
							</div>
						</div>
						<div class="col-md-2 col-md-offset-1">
							<div class="row">
								<label class="control-label">{{ Lang::get('site.comment') }}</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<input class="form-control" name="fake-attachment-comment" id="fake-attachment-comment" type="text">
							</div>
						</div>
					</fieldset>
				</div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="add-attachment">{{ Lang::get('site.save') }}</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('site.close') }}</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	{{ Form::close() }}
</div>
</div>
@stop

@section('javascript')
@parent
	<script type="text/javascript">
		form_name = 'new-form';

		submitform = function(task)
		{
			form = document.getElementById(form_name);
			form.task.value = task;
			form.submit();
		}


		$(function() {
			$('#add-attachment').click(function() {
				$('#' + form_name).append(
					'<div class="alert alert-dismissable alert-info"> \
						<button type="button" class="close" data-dismiss="alert">&times;</button> \
						<p>&nbsp;</p> \
						<div class="form-group">\
							<fieldset class="form-inline"> \
								<div class="col-md-2"> \
									<div class="row"> \
										<label class="control-label">' + '{{ Lang::get("site.id") }}' + '</label> \
									</div> \
								</div> \
								<div class="col-md-1"> \
									<div class="row"> \
										<input class="form-control" name="attachment-id[]" value="' + $('#fake-attachment-id').val() + '" type="text"> \
									</div> \
								</div> \
								<div class="col-md-2 col-md-offset-1"> \
									<div class="row"> \
										<label class="control-label">' + '{{ Lang::get("site.comment") }}' + '</label> \
									</div> \
								</div> \
								<div class="col-md-6"> \
									<div class="row"> \
										<input class="form-control" name="attachment-comment[]" value="' + $('#fake-attachment-comment').val() + '" type="text"> \
									</div> \
								</div> \
							</fieldset> \
						</div> \
					</div>'
				);

				$('#fake-attachment-id').val('');
				$('#fake-attachment-comment').val('');

				$('#myModal').modal('hide')

				
			});

			$(document).on("click", ".close", function() {
			    $(this).parent().remove();
			});

		});
	</script>
@stop