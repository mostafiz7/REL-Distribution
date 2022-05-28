<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  {{--CSRF-Token--}}
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  {{--<title>@yield('title')</title>--}}
  <title>{{ config('app.name', 'REL-Vehicle Management') }}</title>
  
  {{--Styles--}}
  {{--<link href="{{ asset('css/spacer.css') }}" rel="stylesheet" type="text/css" />--}}
  {{--<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />--}}
  {{--<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />--}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

  @yield( 'backend-style' )

  <script>
    window.User = @json( auth()->user() );
    {{--window.NotificationLogo = '{{ asset('assets/img/logo/logo-white.png') }}';--}}
    
    // To load css & js resource from laravel asset
		window.asset = function(path){
			let base_path = window._asset || '';
			return base_path + path;
		};
  </script>
</head>
<body class="layout-fixed {{$viewName}} {{Auth::check() ? "user-logged" : "guest"}}">

  {{--App--}}
  <div id="app">

    {{--Site-Sidebar--}}
    @section('sidebar')
      @include('layouts.includes.sidebar')
    @show


    {{--Site-Wrapper--}}
    <div id="SiteWrapper" class="site-wrapper transition">
      {{--Site-Header--}}
      @section('header')
        @include('layouts.includes.header')
      @show


      {{--Main-Content--}}
      <main id="MainContent" class="main-content">
        @yield('content')
      </main>


      {{--Site-Footer--}}
      @section('footer')
        @include('layouts.includes.footer')
      @show
    </div>

  </div>{{-- #/app --}}

  
  {{--Scripts--}}
  {{--<script src="{{ asset('js/main.js') }}"></script>--}}
  <script src="{{ asset('js/app.js') }}"></script>

  {{--Custom-Script--}}
  @yield('custom-script')

</body>

</html>