@extends('layouts.front')

@section('title')
	{{ Lang::get('title.login') }} | @parent
@stop

@section('style')
<style type="text/css">
	body {
  			padding-top: 70px;
  			padding-bottom: 40px;
	        background-color: #f5f5f5;

	        font-family: "Trebuchet MS",Tahoma,Arial,sans-serif;
	        font-size: 14px;
	        line-height: 20px;
	        color: #333;
  		}

      .form-login {
        max-width: 400px;
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
      .form-login input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 10px;
        padding: 7px 9px;
      }
</style>
@stop

@section('navbar')

@stop

@section('container')
<div class="container">
	<div class="row">
      <div class="col-md-12">
		{{ Form::open(array('route' => 'do-login', 'class' => 'form-login')) }}
			<h3 class="form-login-heading">{{Lang::get('site.login-message')}}</h3>
			<p>&nbsp;</p>
			<!-- Username -->
			<div class="form-group {{ $errors->has('username') ? 'error' : '' }}">
				{{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'style' => 'width:250px;', 'placeholder' => Lang::get('site.username'))) }}
				<span class="help-block">{{ $errors->first('username') }}</span>
			</div>

			<!-- Password -->
			<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
				{{ Form::password('password', array('class'=>'form-control', 'style' => 'width:250px;', 'placeholder' => Lang::get('site.password'))) }}
				<span class="help-block">{{ $errors->first('password') }}</span>
			</div>

			<!-- Remember me -->
			<div class="form-group">
				<label class="checkbox">
					{{ Form::checkbox('remember-me', 'remember-me') }}
					{{ Lang::get('site.remember-me') }}
				</label>
			</div>
			<p>&nbsp;</p>
			<!-- Login button -->
			<div class="form-group">
				{{ Form::submit(Lang::get('site.login'), array('class' => 'btn btn-lg btn-default')) }}
			</div>
		{{ Form::close() }}
		</div>
	</div>
</div>
@stop