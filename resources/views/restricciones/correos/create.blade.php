<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — Administrador</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid px-5 py-3">
    <h1 class="text-white" href="">Estadísticas</h1>
    <div class="d-flex align-items-center">
      <form method="POST" action="{{ route('administrador.logout') }}" class="d-flex align-items-center">
        @csrf

        @if(auth()->check() && (int) auth()->user()->roles_id === 1)
            <a href="{{ route('administrador.register') }}" class="btn btn-dark me-2">Registrar administrador</a>
        @endif

        <a href="{{ route('administrador.restriccion') }}" class="btn btn-dark me-2">Restricciones</a>
        <a href="" class="btn btn-dark me-2">Descargar</a>

        <button type="submit" class="btn btn-dark" aria-label="Cerrar sesión">
          Cerrar sesión
        </button>
      </form>
    </div>
  </div>
</nav>

<main class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h4 class="mb-0">Agregar Restricción de Correo</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="restriccion" class="form-label">Restricción</label>
                    <input type="text" name="restriccion" id="restriccion"
                        class="form-control @error('restriccion') is-invalid @enderror"
                        placeholder="Escribe la restricción "
                        value="{{ old('restriccion') }}">
                    @error('restriccion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('administrador.restriccion') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>  
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>