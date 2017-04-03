<!DOCTYPE html>
<html lang="en">
  <head>

    <style>
        .underline {
            border-bottom: 1px solid #000;
            padding-bottom:3px;
        }

        ul.nav li.dropdown:hover > ul.dropdown-menu {
            display: block;    
        }

    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ETF Global - Business Intelligence</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="row" style="border-top: 3px solid #e86537;">
      <div class="col-md-1">

      </div>
      <div class="col-md-3">
        <a href="{{ route('homepage.index') }}"><img src="/img/logo.png" width="200" style="margin-top:15px;" /></a>
        <h5 class="text-left">Business Intelligence <i>Beta</i></h5>
      </div>
      <div class="col-md-4">
        <form method="get" action="{{ route('search.show') }}">
            <div class="input-group input-group" style="margin-top:30px;">
              <input name="q" type="search" class="form-control" placeholder="Search ETFs, Issuers, Firms, etc." @if($request->has('q')) value="{{ $request->q }}" @endif>
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              </div>
            </div>
        </form>

      </div>
      <div class="col-md-2">
        <p class="pull-right" style="margin-top:37px;">Hello, {{ Auth::user()->name }}</p>
      </div>
      <div class="col-md-1">
          <a class="btn btn-default pull-right" style="margin-top:30px;" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
         
           

      </div>
    </div>


      <nav class="navbar navbar-default" style="margin-bottom:0px;">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
          
          <!-- Collect the nav links, forms, and other content for toggling -->
          <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
            <ul class="nav navbar-nav" style="margin-left:-15px;">
              <li {{{ (Route::currentRouteName() == 'homepage.index' ? 'class=active' : '') }}}><a href="{{ route('homepage.index') }}">Dashboard </a></li>
             
                    <li class="dropdown {{{ (Route::currentRouteName() == 'product.index' ? 'active' : '') }}} ">
                <a href="{{ route('product.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li {{{ (Route::currentRouteName() == 'product.index' ? 'class=active' : '') }}}><a href="{{ route('product.index') }}">Directory</a></li>
                  <li role="separator" class="divider"></li>
                  <li {{{ (Route::currentRouteName() == 'assetClass.index' ? 'class=active' : '') }}}><a href="{{ route('assetClass.index') }}">Asset Classes</a></li>
                  <li {{{ (Route::currentRouteName() == 'issuer.index' ? 'class=active' : '') }}}><a href="{{ route('issuer.index') }}">Issuers</a></li>
                </ul>
              </li>
              
              <li {{{ (Route::currentRouteName() == 'firm.index' ? 'class=active' : '') }}}><a href="{{ route('firm.index') }}">Firms</a></li>
              <li {{{ (Route::currentRouteName() == 'country.index' ? 'class=active' : '') }}}><a href="{{ route('country.index') }}">Countries</a></li>
              
              
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="http://www.etfg.com/about">About Us</a></li>
              <li><a href="http://www.etfg.com">Main Website</a></li>
            </ul>
           
            
         <!--  </div>/.navbar-collapse -->
        </div>
        <div class="col-md-1"></div>
      </div>
        </div><!-- /.container-fluid -->
      </nav>



   <!--  <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Library</a></li>
          <li class="active">Data</li>
        </ol>
      </div>
      
      <div class="col-md-1">
        
      </div>
    </div> -->
