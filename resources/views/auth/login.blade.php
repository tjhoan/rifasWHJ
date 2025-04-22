<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        @if ($errors->has('login_error'))
            <div class="error-message">
                {{ $errors->first('login_error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf
            <div class="input-field">
                <input type="email" id="correo" name="correo" placeholder=" " required>
                <label for="correo">Correo</label>
            </div>
            <div class="input-field password-container">
                <input type="password" id="contrasena" name="contrasena" placeholder=" " required>
                <label for="contrasena">Contraseña</label>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
            </div>
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('contrasena');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>