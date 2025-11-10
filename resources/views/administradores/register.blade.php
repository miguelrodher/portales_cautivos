<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Administrador</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light vh-100 d-flex align-items-center justify-content-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-lg rounded-3">
          <div class="card-body">
            <div class="d-flex align-content-end flex-wrap justify-content-center mt-4 mb-5">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
              </svg>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <form method="POST" action="{{ route('administrador.register.post') }}">
              @csrf

              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su nombre">
              </div>

              <div class="mb-3">
                <label class="form-label">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" required placeholder="Ingrese su apellido paterno"> 
              </div>

              <div class="mb-3">
                <label class="form-label">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" required placeholder="Ingrese su apellido materno">
              </div>

              <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo_electronico" class="form-control" required placeholder="Ingrese su correo">
              </div>

              <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required placeholder="Ingrese su contraseña">
              </div>

              <div class="mb-3">
				<label class="form-label">Confirmar contraseña</label>
				<input type="password" name="contraseña_confirmation" class="form-control" required placeholder="Confirme su contraseña">
			  </div>


              <div class="d-grid mt-4 pt-3">
                <button type="submit" class="btn btn-primary">Registrarse</button>
              </div>
            </form>

            <div class="text-center mt-3">
              <small class="text-muted">¿Ya tienes cuenta? <a href="{{ route('administrador.login') }}">Inicia sesión</a></small>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
