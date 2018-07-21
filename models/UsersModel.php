<?php
    class UsersModel extends Model {

        protected $login;
        protected $password;
        private $salt = '8e86a279d6e182b3c811c559e6b15484';

        public function __construct() {
            parent::__construct();
        }

        public function login() {
            $data = array();
            if ($_POST['login']) {
                $this->login = $_POST['login'];
            }
            if ($_POST['password']) {
                $this->password = $_POST['password'];
            }
            $id = $this->check_password($this->login, $this->password);
            if (!empty($id)) {
                $_SESSION['admin'] = $this->login;
            } else {
                $data['errors'][] = 'error_login';
                $data['login'] = $this->login;
            }
            return $data;
        }

        public function check_password($login, $password)
        {
            $encpassword = md5($this->salt.$password.md5($password));
            $query = "SELECT `id` FROM `t_managers` WHERE `login`='$login' AND password='$encpassword' LIMIT 1";
            foreach ($this->db->query($query) as $res){
                $id = $res['id'];
            };
            if(!empty($id)){
                return $id;
            } else {
                return false;
            }
        }

        public function logout() {
            unset($_SESSION['admin']);
        }
    }
?>