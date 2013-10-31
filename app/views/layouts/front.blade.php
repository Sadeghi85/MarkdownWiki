<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
	@section('title')
        {{ Config::get('site.title') }}
  @show
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/bootstrap-responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/css/highlight.js/styles/vs.css') }}" rel="stylesheet">
    

  @section('style')
    <style type="text/css">
  		body {
  			padding-top: 60px;
  			padding-bottom: 40px;
        background-color: #eee;

        font-family: "Trebuchet MS",Arial,sans-serif;
        font-size: 14px;
        line-height: 20px;
        color: #333;
  		}

      .footer {
        padding: 10px 10px;
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
  @show
    


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="{{ asset('/assets/js/html5shiv.js') }}"></script>
    <![endif]-->

    <!-- Fav icon -->
    <!-- <link rel="shortcut icon" href="../assets/ico/favicon.png"> -->
  </head>

  <body>

	@section('navbar')
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">{{ Config::get('site.title') }}</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="/about">About</a></li>
              <li><a href="/contact">Contact</a></li>
			  
			  
			  
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="nav-header">More</li>
                  <li><a href="{{ URL::Route('zip') }}" target="_blank">Zip contents</a></li>
                  <li><a href="{{ URL::Route('dashboard') }}" target="_blank">Dashboard</a></li>
                  

                  <li class="divider"></li>
                  

                  @if (Auth::check())
                    <li><a href="{{ URL::route('signout') }}">Sign out</a></li>
                  @else
                    <li><a href="{{ URL::route('signin') }}">Sign in</a></li>
                  @endif
                </ul>
              </li>
            </ul>
			
      {{ Form::open(array('route' => 'search', 'method' => 'get', 'class' => 'navbar-form pull-right')) }}
        {{ Form::text('s', '', array('class'=>'span3', 'placeholder'=>'Search...')) }}
        {{ Form::token() }}
        {{ Form::submit('Search', array('class' => 'btn')) }}
      {{ Form::close() }}

			{{--
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
			--}}
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	@show
	
    <div class="container-fluid">
@section('container')
  {{--
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
      </div>
  --}}

		<div class="row-fluid">
			<div class="span12">
				@yield('content')
			</div>
		</div>

	{{--
      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
        </div>
      </div>
	  --}}

      <hr>

      <footer>
        <div class="footer">
          &copy; {{ Config::get('site.copyright') }}
        </div>
      </footer>

    </div> <!-- /container -->
@show
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
@section('javascript')
    <script src="{{ asset('/assets/js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('/assets/js/highlight.js/highlight.pack.js') }}"></script>
    <script>
      hljs.tabReplace = '    ';
      hljs.initHighlightingOnLoad();
    </script>
@show
  </body>
</html>
