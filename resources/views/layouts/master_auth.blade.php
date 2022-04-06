<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- bootstrap -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/ajax.js') }}"></script>
</head>

<body>
  <header>
    @include('header')
  </header>
  @yield('content')
  <footer class="footer bg-dark  fixed-bottom">
    @include('footer')
  </footer>
  
</body>

</html>