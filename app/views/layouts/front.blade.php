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
    
  @if (Config::get('app.locale') == 'fa')
    <link href="{{ asset('/assets/css/bootstrap-rtl.css') }}" rel="stylesheet" media="screen">
  @endif

    <link href="{{ asset('/assets/css/bootstrap-theme.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('/assets/css/bootstrap-extra.css') }}" rel="stylesheet" media="screen">

    <link href="{{ asset('/assets/css/highlight.js/styles/vs.css') }}" rel="stylesheet">

  @section('style')
    <style type="text/css">
      
    </style>
  @show

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="{{ asset('/assets/js/html5shiv.js') }}"></script>
      <script src="{{ asset('/assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body>

@section('navbar')
  <!-- Fixed navbar -->
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
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">{{Lang::get('site.home')}}</a></li>
            <li><a href="/about">{{Lang::get('site.about')}}</a></li>
            <li><a href="/contact">{{Lang::get('site.contact')}}</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Lang::get('site.more')}} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">{{Lang::get('site.more')}}</li>
                <li><a href="{{-- URL::Route('zip') --}}" target="_blank">{{Lang::get('site.zip')}}</a></li>
                <li><a href="{{-- URL::Route('dashboard') --}}" target="_blank">{{Lang::get('site.dashboard')}}</a></li>

                <li class="divider"></li>

                @if (Auth::check())
                  <li><a href="{{-- URL::route('logout') --}}">{{Lang::get('site.logout')}}</a></li>
                @else
                  <li><a href="{{ URL::route('login') }}">{{Lang::get('site.login')}}</a></li>
                @endif
              </ul>
            </li>
          </ul>

          
          {{ Form::open(array('route' => 'search', 'method' => 'get', 'class' => 'navbar-form navbar-right')) }}
            <div class="form-group">
                {{ Form::text('s', '', array('class'=>'form-control', 'placeholder'=> Lang::get('site.search').'...', 'style' => 'width:250px;')) }}
            </div>
            
            <button class="btn btn-default btn-md" type="submit"><span class="glyphicon glyphicon-search"></button>
          {{ Form::close() }}
         

      </div><!--/.navbar-collapse -->
    </div>
  </div>
@show

@section('container')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @yield('content')
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          {{ Config::get('site.copyright') }}
        </div>
      </div>
    </div>
  </div> <!-- /container -->
@show
    
@section('javascript')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('/assets/js/jquery-1.10.2.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('/assets/js/highlight.js/highlight.pack.js') }}"></script>
    <script>
      hljs.tabReplace = '    ';
      hljs.initHighlightingOnLoad();
    </script>
@show
</body>
</html>