<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name'))</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    $bootstrapCss = public_path('vendor/bootstrap/css/bootstrap.min.css');
  @endphp

  @if (file_exists($bootstrapCss))
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}?v={{ filemtime($bootstrapCss) }}" rel="stylesheet">
  @else
    {{-- Fallback CDN si aún no copiaste los assets locales --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
  @endif

  @php
    $appCss = public_path('css/app.css');
  @endphp
  @if (file_exists($appCss))
    <link href="{{ asset('css/app.css') }}?v={{ filemtime($appCss) }}" rel="stylesheet">
  @endif

  @stack('styles')
</head>
<body class="@yield('body.class','bg-light')">
  <header class="py-3 bg-white shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:48px; margin-right:12px;">
        <div>
          <h5 class="mb-0">@yield('portal.nombre', 'Portal Cautivo')</h5>
          <small class="text-muted">@yield('portal.sub', 'Conéctate a la red')</small>
        </div>
      </div>
      <div>
        @yield('header.actions')
      </div>
    </div>
  </header>

  <main class="py-5">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="py-3 text-center text-muted small">
    © {{ date('Y') }} {{ config('app.name') }}
  </footer>

  @php
    $bootstrapJs = public_path('vendor/bootstrap/js/bootstrap.bundle.min.js');
  @endphp

  @if (file_exists($bootstrapJs))
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ filemtime($bootstrapJs) }}"></script>
  @else
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
  @endif

  @php
    $appJs = public_path('js/app.js');
  @endphp
  @if (file_exists($appJs))
    <script src="{{ asset('js/app.js') }}?v={{ filemtime($appJs) }}"></script>
  @endif

  @stack('scripts')
</body>
</html>
