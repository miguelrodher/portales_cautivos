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

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <form method="POST" action="{{ route('administrador.register.post') }}">
              @csrf


              <div class="mb-3">
                <label class="form-label uppercase'input">Nombre</label>
                <input value="{{ old('nombre') }}" style="text-transform: uppercase;" type="text" name="nombre" class="form-control" required placeholder="Ingrese su nombre">

                @if($errors->has('nombre'))
                  @foreach($errors->get('nombre') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>


              <div class="mb-3">
                <label class="form-label">Apellido Paterno</label>
                <input value="{{ old('apellido_paterno') }}" style="text-transform: uppercase;" type="text" name="apellido_paterno" class="form-control" required placeholder="Ingrese su apellido paterno"> 

                @if($errors->has('apellido_paterno'))
                  @foreach($errors->get('apellido_paterno') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>


              <div class="mb-3">
                <label class="form-label">Apellido Materno</label>
                <input value="{{ old('apellido_materno') }}" style="text-transform: uppercase;" type="text" name="apellido_materno" class="form-control" required placeholder="Ingrese su apellido materno">

                @if($errors->has('apellido_materno'))
                  @foreach($errors->get('apellido_materno') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>


              <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input value="{{ old('correo_electronico') }}" type="email" name="correo_electronico" class="form-control" required placeholder="INGRESE SU CORREO">

                @if($errors->has('correo_electronico'))
                  @foreach($errors->get('correo_electronico') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>


              <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input value="{{ old('contrasena') }}" type="password" name="contrasena" class="form-control" required placeholder="INGRESE SU CONTRASEÑA">

                @if($errors->has('contrasena'))
                  @foreach($errors->get('contrasena') as $message)
                    <div class="invalid-feedback d-block">
                      {{ $message }}
                    </div>
                  @endforeach
                @endif
              </div>


              <div class="mb-3">
        				<label class="form-label">Confirmar contraseña</label>
        				<input value="{{ old('contrasena_confirmation') }}" type="password" name="contrasena_confirmation" class="form-control" required placeholder="CONFIRME SU CONTRASEÑA">
      			  </div>


              <div class="mb-3">
                <label class="form-label">Rol del usuario</label>
                <select name="roles_id" class="form-select" required>
                  <option value="">SELECCIONE UN ROL</option>
                  @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('roles_id') == $rol->id ? 'selected' : '' }}>
                      {{ $rol->rol }}
                    </option>
                  @endforeach
                </select>

                @error('roles_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>


              <div class="d-flex justify-content-center row mt-4 pt-3 ps-3 pe-3 ">
                <a href="{{ route('administrador.dashboard') }}" class="btn btn-danger col-5 me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary col-5 ms-2">Registrar usuario</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
