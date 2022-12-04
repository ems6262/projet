<?php

require 'config/config.php';

setcookie('sid', '', time() - 1);
header("location: index.php");

exit();
