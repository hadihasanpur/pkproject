<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.head')
</head>
<body>
    <div id="app">
      @include('includes.header')
      @include ('inc.messages')
        <main class="container py-4 w-100">
            @yield('content')
        </main>
        <footer class="row">
          @include('includes.footer')
        </footer>
    </div>
</body>
</html>
