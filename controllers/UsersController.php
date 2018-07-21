<?php
require_once(dirname(dirname(__FILE__)) . '/models/UsersModel.php');

    class UsersController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->model = new UsersModel();
        }


        public function login() {
            if ($_POST) {
                $result = $this->model->login();

                if ($result['errors']) {
                    $this->view->assign('login', $result);
                } else {
                    header('Location: /tasks');
                }
            } else {
                $this->view->assign('login');
            }
        }

        public function logout(){
            $this->model->logout();
            header('Location: /tasks');
        }

    }
?>