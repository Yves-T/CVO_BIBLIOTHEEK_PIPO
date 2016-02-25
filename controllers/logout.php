<?php
// if admin is logged in, log him out
if ($admin->isLoggedIn()) {
    $admin->logout();
}

header("Location: index.php");
die();