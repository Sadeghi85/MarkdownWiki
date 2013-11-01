@extends('layouts.front')

@section('style')
@parent

	<link href="{{ asset('/assets/css/show_post.css') }}" rel="stylesheet">

	<style type="text/css">
  		.home-posts {
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

@section('javascript')
	@parent

	<script src="{{ asset('/assets/js/show_post.js') }}"></script>
@stop

@section('content')
	@foreach ($results as $result)
		<div class="row-fluid">
			<div class="span12 home-posts">
				<div class="offset1 span10">
					<?php
						$oSlug = $result->slugHistories()->orderBy('id', 'DESC')->select('slug')->first();
					?>
					<a href="{{ $oSlug->slug }}">{{ $result['title'] }}</a>
				</div>
			</div>
		</div>
	@endforeach

	{{ $results->appends(array_except(Input::all(), array('page')))->links() }}
@stop


