<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['loggedin'] == 'f') {
        echo '<script>window.location.href = "users.php";</script>';
    } else {
        if ($_SESSION['loggedin'] == 'a') {
            echo '<script>window.location.href="admin.php";</script>';
        } else {
            if ($_SESSION['loggedin'] == 'y') {
                echo '<script>window.location.href="miniproject.php";</script>';
            }
        }
    }
} else {
    echo '<script>window.location.href = "users.php";</script>';
}
?>
