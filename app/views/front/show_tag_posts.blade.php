@extends('layouts.front')

@section('style')
	@parent
  
@stop

@section('content')
	<div class="row box">
  <div class="col-md-offset-1 col-md-10">
    @foreach ($posts as $post)
    <?php
      $href = SlugHistories::lastSlug($post->id);
    ?>
    <div>
      <div class="row">
        <div class="col-md-12">
          <h2><a href="{{ $href }}" target="_blank">{{ $post->title }}</a></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">      
          <p>
            <?php
              $md = new dflydev\markdown\MarkdownExtraParser();
            ?>
            {{ $md->transformMarkdown(html_entity_decode(Sadeghi85\Utility::getAbstract($post->content), ENT_QUOTES, 'UTF-8')) }}
            
          </p>
          <p><a class="btn" href="{{ $href }}" target="_blank">Read more</a></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
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

    </div>

    <hr>

    @endforeach

    {{ $posts->links() }}
</div>
</div>

@stop