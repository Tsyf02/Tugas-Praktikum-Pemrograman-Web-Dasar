<?php
// index.php — redirect to beranda (main dashboard after login)
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
} else {
    header("Location: beranda.php");
}
exit;
?>
