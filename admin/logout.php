<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Anda telah keluar');document.
location='../login.php'</script>";
?>