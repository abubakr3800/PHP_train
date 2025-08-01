<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'Laravel App')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    @include('layouts.navbar')

    @yield('content')

  <footer>
    <p>&copy; {{ date('Y') }} Laravel App</p>
  </footer>
</body>
</html>