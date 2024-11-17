<?php
session_destroy();

unset($_COOKIE['remember_user']);
setcookie("LOGIN_USER_ID", null, -1, "/");

//require files
require 'require/modules.php';

header("location: " . DOMAIN);
