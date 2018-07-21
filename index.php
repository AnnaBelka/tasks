<?PHP

session_start();

if($_SERVER['REQUEST_URI'] == "/") {
 header("Location: /tasks",TRUE,301);
 exit();
}
require_once('database/DataBase.php');
require_once('components/Model.php');
require_once('components/View.php');
require_once('components/Controller.php');
require_once('components/Routes.php');

$router = new Routes();
$router->run();

