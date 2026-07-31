<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

<div class="container">

<a class="navbar-brand fw-bold" href="/MegaStore">

🔨 MegaFerre

</a>

<button
class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div
class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav me-auto">

<li class="nav-item">

<a class="nav-link" href="#">

Inicio

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">

Herramientas

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">

Eléctricos

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">

Plomería

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#">

Pinturas

</a>

</li>

</ul>

<form class="d-flex me-3">

<input
class="form-control"
type="search"
placeholder="Buscar productos">

</form>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if(isset($_SESSION['id'])){ ?>

<div class="dropdown me-2">

    <button
        class="btn btn-light dropdown-toggle"
        data-bs-toggle="dropdown">

        <i class="bi bi-person-circle"></i>

        Hola, <?= $_SESSION['nombre']; ?>

    </button>

    <ul class="dropdown-menu dropdown-menu-end">

        <?php if($_SESSION['rol']==1){ ?>

        <li>

            <a class="dropdown-item"
                href="/MegaStore/admin/dashboard/index.php">

                Panel Administrativo

            </a>

        </li>

        <?php } ?>

        <li>

            <a class="dropdown-item"
                href="/MegaStore/cliente/mis_pedidos.php">

                Mis pedidos

            </a>

        </li>

        <li><hr class="dropdown-divider"></li>

        <li>

            <form
                action="/MegaStore/controllers/UsuarioController.php"
                method="POST">

                <input
                    type="hidden"
                    name="accion"
                    value="logout">

                <button
                    class="dropdown-item text-danger">

                    Cerrar sesión

                </button>

            </form>

        </li>

    </ul>

</div>

<?php }else{ ?>

<a href="/MegaStore/auth/login.php"
class="btn btn-light me-2">

<i class="bi bi-person"></i>

Ingresar

</a>

<?php } ?>

<a href="#"
class="btn btn-success">

<i class="bi bi-cart"></i>

Carrito

<span class="badge bg-danger">

0

</span>

</a>

</div>

</div>

</nav>