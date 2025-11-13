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
    <h1 class="text-white" href="">Restricciones</h1>
    <div class="d-flex align-items-center">
      <form method="POST" action="{{ route('administrador.logout') }}" class="d-flex align-items-center">
        @csrf

        @if(auth()->check() && (int) auth()->user()->roles_id === 1)
            <a href="{{ route('administrador.register') }}" class="btn btn-dark me-2">Registrar administrador</a>
        @endif

        <a href="{{ route('administrador.dashboard') }}" class="btn btn-dark me-2">Estadísticas</a>

        <button type="submit" class="btn btn-dark" aria-label="Cerrar sesión">
          Cerrar sesión
        </button>
      </form>
    </div>
  </div>
</nav>

<main class="container py-4">
  <div class="row gy-4">
   
    {{-- CARD: Correos/Dominios --}}
    <div class="col-12 col-md-4">
      <div class="card h-100">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Correos / Dominios</h5>
            <a href="{{ route('administrador.restriccion.correo') }}" class="btn btn-sm btn-outline-primary" title="Agregar correo/dominio"> + </a>
          </div>

          <div class="table-responsive mb-3">
            <table class="table table-borderless table-striped align-middle mb-0">
              <thead class="table-secondary">
                <tr>
                  <th>Restricción</th>
                  <th style="width:110px">Acción</th>
                </tr>
              </thead>
              <tbody>
                @forelse($correos as $item)
                  <tr>
                    <td>{{ $item->restriccion }}</td>
                    <td>
                      <a href="{{ route('administrador.restriccion.correo.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                      </a>

                      <form action="{{ route('correos.destroy', $item->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('¿Eliminar esta restricción de correo/dominio?');"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                          </svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="2" class="text-muted">No hay restricciones de correos/dominios.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-auto">
            @if(method_exists($correos, 'links'))
              {{ $correos->links() }}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
