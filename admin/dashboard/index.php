<?php

require_once '../../config/auth.php';

?>

<?php require_once '../../includes/header.php'; ?>

<?php require_once '../../includes/navbar.php'; ?>

<div class="d-flex">

    <?php require_once '../../includes/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <h2 class="mb-4">

            Bienvenido,
            <strong><?php echo $_SESSION['nombre']; ?></strong>

        </h2>

        <div class="row">

            <div class="col-md-3">

                <div class="card border-primary shadow">

                    <div class="card-body text-center">

                        <h5>Categorías</h5>

                        <h2>8</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-success shadow">

                    <div class="card-body text-center">

                        <h5>Productos</h5>

                        <h2>0</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-warning shadow">

                    <div class="card-body text-center">

                        <h5>Usuarios</h5>

                        <h2>1</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-danger shadow">

                    <div class="card-body text-center">

                        <h5>Pedidos</h5>

                        <h2>0</h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once '../../includes/footer.php'; ?>