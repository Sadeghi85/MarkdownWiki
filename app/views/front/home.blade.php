@extends('layouts.front')

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

      .home-box {
          
          background-color: #fff;
          border: 1px solid #e5e5e5;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
          -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
          box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
  		
      .zend-tag-cloud {
        /*padding: 2px;*/
        line-height: 3em;
        text-align: center;
        margin: 0;
        word-break: break-all;
      }

      .zend-tag-cloud a {
        padding: 0px;
      }

      .zend-tag-cloud li {
        display: inline;
        margin-left: 18px;
      }

    </style>
 @stop

@section('content')


<div class="col-md-7">
  <div class="row home-box">
    <span style="text-align:center;"><h5>LISTS</h5></span>
    <div class="col-md-12">
      <?php
          $lists = Post::where('list', 1)->with('slugHistories')->paginate(10);
      ?>

      <ul>
          @foreach ($lists as $list)
            <?php
              $oSlug = $list->slugHistories()->orderBy('id', 'desc')->first();
            ?>
            <li><a href="{{ $oSlug->slug }}">{{ $list->title }}</a></li>
          @endforeach
      </ul>

      
        {{ $lists->links() }}
    </div>
  </div>

</div>

<div class="col-md-4 col-md-offset-1">
  <div class="row home-box">
    <span style="text-align:center;"><h5>TAGS</h5></span>
    <div class="col-md-12">
      <?php
          $tags = Tag::has('posts')->get();

          // $tags = Tag::whereIn('id', function($query) {
          //             $query->select('tag_id')->from('post_tag');
          //          })->get();

          //$tags = Tag::all();

          $cloud = array();

          foreach ($tags as $tag)
          {
            if ($tag->posts()->where('published', 1)->count() > 0)
            {
              $cloud[] = array('title'=>str_replace('-', ' ', $tag->tag), 'weight'=>$tag->posts->count(), 'params'=>array('url'=>'/tag/'.$tag->tag));
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