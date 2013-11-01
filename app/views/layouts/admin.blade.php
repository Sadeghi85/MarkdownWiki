<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">

  {{-- <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png"> --}}

  <title>
    @section('title')
          {{ Config::get('site.title') }}
    @show
  </title>

    <!-- Bootstrap -->
    <link href="{{ asset('/assets/css/bootstrap.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('/assets/css/bootstrap-theme.css') }}" rel="stylesheet" media="screen">
    
    @if (Config::get('app.locale') == 'fa')
    <link href="{{ asset('/assets/css/bootstrap-rtl.css') }}" rel="stylesheet" media="screen">
    @endif

    <link href="{{ asset('/assets/css/highlight.js/styles/vs.css') }}" rel="stylesheet">
 
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
    .sidebar-nav {
     padding: 9px 0;
    }

    @media (max-width: 980px) {
     /* Enable use of floated navbar text */
     .navbar-text.pull-right {
       float: none;
       padding-left: 5px;
       padding-right: 5px;
     }
    }
   </style>
  @show
  
 <link href="{{ asset('/assets/css/bootstrap-markdown.min.css') }}" rel="stylesheet">
 <link href="{{ asset('/assets/css/bootstrap-tag.css') }}" rel="stylesheet">
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="{{ asset('/assets/js/html5shiv.js') }}"></script>
      <script src="{{ asset('/assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body>

@section('navbar')
 <div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ Config::get('site.title') }}</a>
    </div>

    <div class="navbar-header navbar-right">
      <p class="navbar-text">
       {{ Lang::get('site.logged-in-as', array('name' => sprintf('<a href="#" class="navbar-link">%s</a>', Auth::user()->username))) }}  (<a href="{{ URL::Route('logout') }}">{{ Lang::get('site.logout') }}</a>)
      </p>
    </div>
    
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="{{ URL::to('') }}">Front</a></li>
      </ul>
    </div><!--/.nav-collapse -->
   </div>
 </div>
@show

 <div class="container-fluid">
 <div class="row-fluid">
 <div class="span2">
 <div class="well sidebar-nav">
 <ul class="nav nav-list">
 <li class="nav-header">Tasks</li>

<?php
  $nav = array();
  $nav1 = array(
      array('label' => 'Home', 'routes' => array('default'=>'dashboard')),
      array('label' => 'New', 'routes' => array('default'=>'new')),
      array('label' => 'Posts', 'routes' => array('default'=>'posts', 'edit')),
      array('label' => 'Lists', 'routes' => array('default'=>'lists')),
  );
?>
@foreach ($nav as $n)
  @if (in_array(Route::currentRouteName(), $n['routes']))
    <li class="active"><a href="{{ URL::Route($n['routes']['default']) }}">{{{ $n['label'] }}}</a></li>
  @else
    <li><a href="{{ URL::Route($n['routes']['default']) }}">{{{ $n['label'] }}}</a></li>
  @endif
@endforeach

   </ul>
   </div><!--/.well -->
   </div><!--/span-->

   <div class="span10">
 
   <div class="row-fluid">
   <div class="span12">
   @yield('content')
   </div>
   </div>

    </div><!--/span-->
    </div><!--/row-->

    </div><!--/.fluid-container-->

@section('javascript')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('/assets/js/jquery-1.10.2.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('/assets/js/bootstrap-markdown.js') }}"></script>
    <script src="{{ asset('/assets/js/markdown.js') }}"></script>
    <script src="{{ asset('/assets/js/to-markdown.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-tag.js') }}"></script>

    <script src="{{ asset('/assets/js/highlight.js/highlight.pack.js') }}"></script>
    <script>
      hljs.tabReplace = '    ';
      hljs.initHighlightingOnLoad();
    </script>
@show

</body>
</html>