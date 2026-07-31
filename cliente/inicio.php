<?php

require_once __DIR__ . '/../models/Producto.php';

$modelo = new Producto();

$productos = $modelo->obtenerActivos();

require_once __DIR__ . '/../includes/cliente/header.php';
require_once __DIR__ . '/../includes/cliente/navbar.php';

?>

<!-- BANNER -->

<section class="container mt-4">

<div class="row align-items-center bg-primary text-white rounded shadow p-5">

<div class="col-lg-6">

<h1 class="display-4 fw-bold">

Todo para tu hogar y construcción

</h1>

<p class="lead">

Encuentra herramientas, materiales eléctricos, plomería, pinturas y mucho más con la mejor calidad.

</p>

<a href="#productos" class="btn btn-success btn-lg">

Ver catálogo

</a>

</div>

<div class="col-lg-6 text-center">

<img
src="/MegaStore/assets/img/banner.png"
class="img-fluid"
style="max-height:350px;">

</div>

</div>

</section>

<section class="container mt-5">

<h2 class="text-center fw-bold mb-4">

Comprar por categoría

</h2>

<div class="row text-center">

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🛠</h1>

<h5>Herramientas</h5>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>⚡</h1>

<h5>Eléctricos</h5>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🚿</h1>

<h5>Plomería</h5>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🎨</h1>

<h5>Pinturas</h5>

</div>

</div>

</div>

</section>

<section id="productos" class="container mt-5">

<h2 class="text-center fw-bold">

Productos destacados

</h2>

<div class="row mt-4">

<?php foreach($productos as $producto){ ?>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card h-100 shadow producto-card">

    <img
        src="/MegaStore/assets/img/productos/default.png"
        class="card-img-top p-3"
        style="height:220px;object-fit:contain;">

    <div class="card-body">

        <span class="badge bg-primary">

            <?= $producto['categoria']; ?>

        </span>

        <h5 class="mt-3 fw-bold">

            <?= $producto['nombre']; ?>

        </h5>

        <p class="text-secondary">

            <?= $producto['marca']; ?>

        </p>

        <p>

            <?= $producto['descripcion']; ?>

        </p>

        <h3 class="text-success">

            $<?= number_format($producto['precio'],2); ?>

        </h3>

        <small class="text-muted">

            Stock disponible:
            <?= $producto['stock']; ?>

        </small>

    </div>

    <div class="card-footer bg-white border-0">

        <form action="/MegaStore/controllers/CarritoController.php" method="POST">

            <input
                type="hidden"
                name="accion"
                value="agregar">

            <input
                type="hidden"
                name="producto_id"
                value="<?= $producto['id']; ?>">

            <button
                type="submit"
                class="btn btn-success w-100">

                <i class="bi bi-cart-plus"></i>

                Agregar al carrito

            </button>

        </form>

    </div>

</div>

</div>

<?php } ?>

</div>

</section>

<section class="container mt-5 mb-5">

<div class="row">

<div class="col-md-3 text-center">

<h1>🚚</h1>

<h5>Envíos rápidos</h5>

</div>

<div class="col-md-3 text-center">

<h1>🛡️</h1>

<h5>Garantía</h5>

</div>

<div class="col-md-3 text-center">

<h1>💳</h1>

<h5>Pago seguro</h5>

</div>

<div class="col-md-3 text-center">

<h1>📞</h1>

<h5>Soporte</h5>

</div>

</div>

</section>

<div class="container mt-5">

<div class="p-5 bg-white rounded shadow text-center">

<h1 class="display-5">

🔨 Bienvenido a MegaFerre

</h1>

<p class="lead">

Todo lo que necesitas para construir, reparar y mejorar tu hogar.

</p>

<a href="#productos"
class="btn btn-primary btn-lg">

Ver productos

</a>

</div>

</div>

<footer class="text-center">

<h5>MegaFerre © 2026</h5>

<p>Ferretería online desarrollada en PHP y Bootstrap.</p>

</footer>

<?php

require_once __DIR__ . '/../includes/cliente/footer.php';

?>