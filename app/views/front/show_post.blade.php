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

				<i class="glyphicon glyphicon-tags"></i> {{ Lang::get('site.tags') }} :
				@foreach ($tags as $tag)

				  <a href="{{ URL::route('front-tag', $tag->tag) }}"><span class="label label-info">{{ str_replace('-', ' ', $tag->tag) }}</span></a> 
				@endforeach

			</p>
			
			<p>&nbsp;</p>

			<?php
			 	 $attachments = $post->media()->get();
			?>
			<p class="{{ count($attachments) ? '' : 'hide' }}">
				

				<i class="glyphicon glyphicon-paperclip"></i> {{ Lang::get('site.attachments') }} :
				@foreach ($attachments as $attachment)
					<div class="alert alert-block alert-info">
						<div class="row">
							<div class="col-md-3">
				  				<a href="{{ URL::Route('media-download', array($attachment->id)) }}"><span class="label label-info">{{ $attachment->name }}</span></a>
				  			</div>
				  			<div class="col-md-9">
				  				<span class="label label-info">{{ $attachment->pivot->comment }}</span>
				  			</div>
				  		</div>
				  	</div>
				@endforeach

			</p>

		</div>
	</div>
</div>
@stop


