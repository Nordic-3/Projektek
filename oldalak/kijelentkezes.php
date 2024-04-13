<?php
session_start();
echo "<script>alert('Sikeres kijelentkezés!'); window.location.href = 'index.php';</script>";
session_unset();
session_destroy();
exit();
