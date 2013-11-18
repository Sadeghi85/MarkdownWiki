@extends('layouts.front')

@section('style')
@parent

	<style type="text/css">
  		
    </style>
@stop

@section('javascript')
	@parent

	
@stop

@section('content')
<div class="col-md-12">
	<div class="row box">
		<div class="col-md-offset-1 col-md-10">
			<?php
		          $tags = Tag::has('posts')->get();

		          //$tags = Tag::all();

		          $cloud = array();

		          foreach ($tags as $tag)
		          {
		            if ($tag->posts()->where('published', 1)->count() > 0)
		            {
		              $cloud[] = array('title'=>str_replace('-', ' ', $tag->tag), 'weight'=>$tag->posts()->where('published', 1)->count(), 'params'=>array('url'=>URL::route('front-tag', $tag->tag)));
		            }
		          }

		          // Create the cloud and assign static tags to it
		          $oCloud = new Zend\Tag\Cloud(array('tags' => $cloud));

		          // Render the cloud
		          echo $oCloud;
		           
		      ?>
		</div>
	</div>
</div>
    
@stop


