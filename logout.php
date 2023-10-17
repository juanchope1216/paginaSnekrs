<?php
session_start();

require "app/lib/mod004_presentacion (1).php";
require "app/config/constans.php";

mod004_logout();
header('Location: ' . PRINCIPAL_PAGE);
