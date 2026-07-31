<?php

session_start();

if (!isset($_SESSION['id'])) {

    $_SESSION['redirect_after_login'] = "/MegaStore/cliente/checkout.php";

    header("Location: /MegaStore/auth/login.php");

    exit;
}

require_once __DIR__ . '/../includes/cliente/header.php';
require_once __DIR__ . '/../includes/cliente/navbar.php';

?>

<div class="container mt-5">

    <div class="alert alert-success">

        <h3>✅ Ya puedes realizar tu compra.</h3>

        <p>Bienvenido <?= $_SESSION['nombre']; ?></p>

    </div>

</div>

<?php

require_once __DIR__ . '/../includes/cliente/footer.php';

?>