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
  <div class="container-fluid">
    <a class="navbar-brand" href="">Panel Administradores</a>
    <div class="d-flex align-items-center">
      <span class="text-white me-3">Administrador</span>
      <form method="POST" action="">
        @csrf
        <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
      </form>
    </div>
  </div>
</nav>

<main class="container py-4">
  <div class="row mb-4">
    <div class="col-12">
      <h3 class="mb-0">Dashboard</h3>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Usuarios (analíticos)</h6>
          <h3 class="card-text">30</h3>
          <small class="text-muted">Registros en tabla usuarios</small>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Sesiones de navegador</h6>
          <h3 class="card-text">150</h3>
          <small class="text-muted">Registros en sesiones_navegadores</small>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Portales cautivos</h6>
          <h3 class="card-text">15</h3>
          <small class="text-muted">Registros en portales_cautivos</small>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Administradores</h6>
          <h3 class="card-text">14</h3>
          <small class="text-muted">Cuentas administrativas</small>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Últimas sesiones</h5>

          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha inicio</th>
                  <th>IP</th>
                  <th>Dispositivo</th>
                  <th>Navegador</th>
                  <th>Usuario</th>
                  <th>Portal</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>10-12-2025</td>
                    <td>127.0.0.1</td>
                    <td>iPhone</td>
                    <td>Safari</td>
                    <td>iPhone de Carlos</td>
                    <td>Portal Ciudad de México</td>
                  </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card border-primary">
        <div class="card-body">
          <h6>Acciones rápidas</h6>
          <p class="mb-2">En esta vista demo, los botones son ilustrativos.</p>
          <a href="" class="btn btn-primary btn-sm">Crear administrador</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card border-secondary">
        <div class="card-body">
          <h6>Notas</h6>
          <p class="mb-0 text-muted">Esta interfaz es una maqueta; reemplaza datos por consultas reales cuando lo necesites.</p>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
