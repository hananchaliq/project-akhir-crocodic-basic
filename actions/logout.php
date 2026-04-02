<?php
session_start();
session_destroy();
header("Location: " . DB_URL . "page/login.php");
exit;
