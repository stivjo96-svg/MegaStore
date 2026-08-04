<?php

session_start();

if (!isset($_SESSION['id'])) {

    $_SESSION['redirect_after_login'] = "/MegaStore/cliente/checkout.php";

    header("Location: /MegaStore/auth/login.php");

    exit;
}

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../includes/cliente/header.php';
require_once __DIR__ . '/../includes/cliente/navbar.php';

$modelo = new Producto();

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {

    echo '<div class="container mt-5">
            <div class="alert alert-warning">
                Tu carrito está vacío.
            </div>
          </div>';

    require_once __DIR__ . '/../includes/cliente/footer.php';
    exit;
}

$subtotal = 0;

?>

<div class="container mt-5">

    <div class="row">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4>Resumen del pedido</h4>

                </div>

                <div class="card-body">

                    <table class="table">

                        <thead>

                        <tr>

                            <th>Producto</th>

                            <th>Precio</th>

                            <th>Cantidad</th>

                            <th>Subtotal</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php

                        foreach ($carrito as $id => $cantidad) {

                            $producto = $modelo->obtenerPorId($id);

                            $sub = $producto['precio'] * $cantidad;

                            $subtotal += $sub;

                        ?>

                        <tr>

                            <td><?= $producto['nombre']; ?></td>

                            <td>$<?= number_format($producto['precio'],2); ?></td>

                            <td><?= $cantidad; ?></td>

                            <td>$<?= number_format($sub,2); ?></td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

<?php

$iva = $subtotal * 0.15;
$total = $subtotal + $iva;

?>

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4>Total a pagar</h4>

                </div>

                <div class="card-body">

                    <p>

                        <strong>Subtotal:</strong>

                        $<?= number_format($subtotal,2); ?>

                    </p>

                    <p>

                        <strong>IVA (15%):</strong>

                        $<?= number_format($iva,2); ?>

                    </p>

                    <hr>

                    <h3>

                        Total

                        $<?= number_format($total,2); ?>

                    </h3>

                    <hr>

                    <form action="/MegaStore/controllers/PedidoController.php"
                          method="POST">

                        <input
                            type="hidden"
                            name="accion"
                            value="guardar">

                        <div class="mb-3">

                            <label>

                                Método de pago

                            </label>

                            <select
                                class="form-select"
                                name="metodo_pago"
                                required>

                                <option value="Efectivo">

                                    Efectivo

                                </option>

                                <option value="Transferencia">

                                    Transferencia

                                </option>

                                <option value="Tarjeta">

                                    Tarjeta

                                </option>

                            </select>

                        </div>

                        <button
                            class="btn btn-success w-100">

                            Confirmar compra

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

require_once __DIR__ . '/../includes/cliente/footer.php';

?>