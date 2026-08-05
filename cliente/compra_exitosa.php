<?php

session_start();

require_once __DIR__ . '/../includes/cliente/header.php';
require_once __DIR__ . '/../includes/cliente/navbar.php';

$factura = $_SESSION['ultima_factura'] ?? null;

?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h2 class="text-success">

                🎉 Compra realizada correctamente

            </h2>

            <p class="mt-3">

                Gracias por comprar en <strong>MegaFerre</strong>

            </p>

            <hr>

            <p>

                ✅ Pedido registrado correctamente.

            </p>

            <p>

                ✅ Factura generada correctamente.

            </p>

            <?php if($factura){ ?>

                <a

                    href="/MegaStore/facturas/<?= $factura ?>"

                    target="_blank"

                    class="btn btn-danger">

                    📄 Descargar factura

                </a>

            <?php } ?>

            <a

                href="/MegaStore"

                class="btn btn-primary">

                🛒 Seguir comprando

            </a>

        </div>

    </div>

</div>

<?php

unset($_SESSION['ultima_factura']);

require_once __DIR__ . '/../includes/cliente/footer.php';

?>