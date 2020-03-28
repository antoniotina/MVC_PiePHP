
<?php

// include_once("./src/View/User/register.php");

// var_dump($_POST, $_GET, $_SERVER);

define("BASE_URI", str_replace(DIRECTORY_SEPARATOR, "/", substr(__DIR__, strlen($_SERVER["DOCUMENT_ROOT"]))));
require_once(implode(DIRECTORY_SEPARATOR, ["Core", "autoload.php"]));
$app = new Core\Core();
$app->run();
