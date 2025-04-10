<?php
session_start();
session_unset();
session_destroy();
header("Location: /ZIG-CUSTOMIZE-PROJECT/admin/admin_login.php");
exit();
?>