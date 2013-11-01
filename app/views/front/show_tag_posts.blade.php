@extends('layouts.front')

{{--  @section('sidebar')
     @parent

    <p>This is appended to the master sidebar.</p> 
 @stop
--}}

@section('style')
	@parent
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

@section('content')

	<div class="row-fluid home-posts">
  <div class="offset1 span10">
    @foreach ($posts as $post)
      <div class="row-fluid">
        <div class="span12">
          <h4><strong><a href="{{ Sadeghi85\Utility::getSlug($post->id) }}" target="_blank">{{ $post->title }}</a></strong></h4>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12">      
          <p>
            <?php
              $md = new dflydev\markdown\MarkdownExtraParser();
            ?>
            {{ $md->transformMarkdown(html_entity_decode(Sadeghi85\Utility::getAbstract($post->content), ENT_QUOTES, 'UTF-8')); }}
            
          </p>
          <p><a class="btn" href="{{ Sadeghi85\Utility::getSlug($post->id) }}" target="_blank">Read more</a></p>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <p></p>
          <p>
            {{-- <i class="icon-user"></i> by <a href="#">John</a> 
            | <i class="icon-calendar"></i> Sept 16th, 2012
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | --}}
            <?php
              $tags = $post->tags()->get();
            ?>

            <i class="icon-tags"></i> Tags :
            @foreach ($tags as $tag)
              <a href="{{ '/tag/'.$tag->tag }}"><span class="label label-info">{{ str_replace('-', ' ', $tag->tag) }}</span></a> 
            @endforeach
            
          </p>
        </div>
      </div>

      <hr>

    @endforeach

    {{ $posts->links() }}
</div>
</div>

@stop