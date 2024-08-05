<?php

    session_start();

    session_destroy();
    unset($_SESSION['login_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['full_name']);
    unset($_SESSION['is_login']);
    header('Location: index.php');
?>
