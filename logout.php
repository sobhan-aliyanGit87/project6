<?php
// logout.php

// شروع جلسه
session_start();

// حذف تمام داده‌های جلسه
session_unset();
session_destroy();

// هدایت کاربر به صفحه index.php
header("Location: index.php");
exit();
?>