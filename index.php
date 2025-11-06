<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Tienda - Login</title>
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
  <main class="container">
    <section class="left">
      <h1>Mi Tienda</h1>
      <p>Ventas exclusivas SHEIN & TEMU</p>
    </section>

    <section class="right">
      <div class="form login active">
        <h2>Bienvenido</h2>
        <input id="loginEmail" type="email" placeholder="Correo" />
        <input id="loginPass" type="password" placeholder="Contraseña" />
        <button id="btnLogin">Iniciar Sesión</button>
        <p>¿No tienes cuenta? <a id="linkSignup" href="#">Regístrate</a></p>
      </div>

      <div class="form signup">
        <h2>Crear cuenta</h2>
        <input id="signupNombre" placeholder="Nombre" />
        <input id="signupEmail" type="email" placeholder="Correo" />
        <input id="signupPass" type="password" placeholder="Contraseña" />
        <button id="btnSignup">Registrarse</button>
        <p>¿Ya tienes cuenta? <a id="linkLogin" href="#">Inicia sesión</a></p>
      </div>
    </section>
  </main>

  <script src="assets/script.js"></script>
</body>
</html>
