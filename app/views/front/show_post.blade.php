@extends('layouts.front')

@section('style')
@parent

	<link href="{{ asset('/assets/css/show_post.css') }}" rel="stylesheet">

	<style type="text/css">
  		
    </style>
@stop

@section('javascript')
	@parent

	<script src="{{ asset('/assets/js/show_post.js') }}"></script>
@stop

@section('content')
<div class="col-md-12">
	<div class="row box">
		<div class="col-md-12">
			<h3>{{ $post->title }}</h3>
			<hr>

			<?php
				$md = new dflydev\markdown\MarkdownExtraParser();
			?>
			<p>
				{{ $md->transformMarkdown(html_entity_decode($post->content, ENT_QUOTES, 'UTF-8')); }}
			</p>

			<p>&nbsp;</p>
			
			<p>
				{{-- <i class="icon-user"></i> by <a href="#">John</a> 
				| <i class="icon-calendar"></i> Sept 16th, 2012
				| <i class="icon-comment"></i> <a href="#">3 Comments</a>
				| <i class="icon-share"></i> <a href="#">39 Shares</a>
				| --}}
				<?php
				  $tags = $post->tags()->get();
				?>

				<i class="icon-tags"></i> {{ Lang::get('site.tags') }} :
				@foreach ($tags as $tag)

				  <a href="{{ URL::route('front-tag', $tag->tag) }}"><span class="label label-info">{{ str_replace('-', ' ', $tag->tag) }}</span></a> 
				@endforeach

			</p>
			
			

		</div>
	</div>
</div>
@stop


