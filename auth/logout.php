<?php

session_start();

session_unset();

session_destroy();

header("Location: /MegaStore/views/login.php");
exit;