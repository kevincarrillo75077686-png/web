<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel - Mi Tienda</title>
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
  <header>
    <h1>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?> 👋</h1>
    <button id="logoutBtn">Cerrar sesión</button>
  </header>

  <main class="dash">
    <section>
      <h2>Tus compras</h2>
      <div id="purchaseCount" class="contador">0</div>
      <button id="addBtn">Registrar compra</button>
      <p id="reward" class="hidden">🎉 ¡Has alcanzado 9 compras! Tienes un premio.</p>
    </section>

    <section>
      <h2>Actualizar nombre</h2>
      <input id="nombreInput" placeholder="Nuevo nombre" />
      <button id="saveBtn">Guardar</button>
    </section>
  </main>

  <script src="assets/script.js"></script>
</body>
</html>
