<?php

session_start();

unset($_SESSION["usuario_email"]);

header("Location:index.php");

die();