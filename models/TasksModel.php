<?php
    class TasksModel extends Model {

        protected $name;
        protected $email;
        protected $body;
        protected $image;
        protected $status;
        public    $width_image = 320;
        public    $height_image = 240;
        public    $limit = 3;

        public function __construct() {
            parent::__construct();
        }

        /*Создание задачи*/
        public function create_task() {
            $data = array();
            if ($_POST['name']){
                $this->name = trim($_POST['name']);
            } else {
                $data['errors'][] = 'empty_name';
            }
            if (!empty($_POST['email'])) {
                $validate_email = validate_email($_POST['email']);
                if ($validate_email == 'error') {
                    $data['errors'][] = 'error_email';
                } else {
                    $this->email = $validate_email;
                }
            }
            if (!empty($_POST['body'])) {
                $this->body = trim($_POST['body']);
            } else {
                $data['errors'][] = 'empty_body';
            }

            if ($_POST['status']){
                $this->status = $_POST['status'] == 'on' ? 1 : 0;
            }

            if (empty($data['errors'])) {
                $query = "INSERT INTO `t_tasks`(`name`, `email`, `body`, `status`) VALUES ('$this->name','$this->email','$this->body', '$this->status')";
                $this->db->query($query);
                $task_id = $this->db->lastInsertId();

                // Загрузка изображения
                $image_file = $_FILES['image'];
                if (!empty($image_file['name']) && ($this->image = upload_image($image_file['tmp_name'], $image_file['name'], '/views/images/tasks/', $this->width_image, $this->height_image))) {
                    $query = "UPDATE `t_tasks` SET `image`='$this->image' WHERE `id`=".$task_id;
                    $this->db->query($query);

                }
                $data['task']['name'] = $this->name;
                $data['task']['email'] = $this->email;
                $data['task']['body'] = $this->body;
                $data['task']['image'] = $this->image;
            }
            return $data;

        }

        /*Обновление задачи*/
        public function update_task($id) {
            if (is_int($id) && !empty($id)) {
                if (!empty($_POST['body'])) {
                    $this->body = trim($_POST['body']);
                } else {
                    $data['errors'][] = 'empty_body';
                }
                if ($_POST['status']) {
                    $this->status = $_POST['status'] == 'on' ? 1 : 0;

                }
                if (empty($data['errors'])) {
                    $query = "UPDATE `t_tasks` SET `body`='$this->body', `status`='$this->status' WHERE `id`=".$id;
                    $this->db->query($query);
                }
                $task = $this->get_task($id);
                $data['task']=$task['task'];
                $data['flag_admin'] = 1;
                return $data;
            }
        }

        /*Выбрать одну задачу*/
        public function get_task($id) {
            $data = array();
            if (is_int($id) && !empty($id)) {
                $query = "SELECT `id`, `name`, `email`, `body`, `image`, `status` FROM t_tasks WHERE `id`=".$id;

                foreach ($this->db->query($query) as $task) {
                    $data['task']['id'] = $task['id'];
                    $data['task']['name'] = $task['name'];
                    $data['task']['email'] = $task["email"];
                    $data['task']['body'] = $task["body"];
                    $data['task']['image'] = $task['image'];
                    $data['task']['status'] = $task['status'];
                }

            }
            return $data;
        }

        /*Выборка всех задач*/
        public function get_tasks($sort, $page) {
            $data = array();
            $order = substr(strrchr($sort,'-'),1);
            $page = substr(strrchr($page,'-'),1);

            if (empty($page)) {
                $page = 1;
            }

            if (empty($order)) {
                $order = 'name_asc';
            }
            $sort = $order;
            if (!empty($order)){
                switch ($order) {
                    case 'name_asc':
                        $order = 'name ASC';
                        break;
                    case 'name_desc':
                        $order = 'name DESC';
                        break;
                    case 'email_asc':
                        $order = 'email ASC';
                        break;
                    case 'email_desc':
                        $order = 'email DESC';
                        break;
                    case 'status_asc':
                        $order = 'status ASC';
                        break;
                    case 'status_desc':
                        $order = 'status DESC';
                        break;
                }
            }

            $tasks_count = $this->count_tasks();


            if(!empty($page)) {

                if ($page == 'all') {
                    $this->limit = $tasks_count;
                }

                $page = max(1, intval($page));
            }

            $sql_limit = ' LIMIT '.($page-1)*$this->limit.', '.$this->limit;


            if ($this->limit > 0) {
                $pages_count = ceil($tasks_count/$this->limit);
            } else {
                $pages_count = 0;
            }

            $current_page = min($page, $pages_count);

            $query = 'SELECT `id`, `name`,  `email`, `body`, `image`, `status` FROM `t_tasks` ORDER BY '.$order.$sql_limit;

            $tasks = $this->db->query($query);

            foreach ($tasks as $task) {
                $result = array();
                $result['id'] = $task['id'];
                $result['name'] = $task['name'];
                $result['email'] = $task['email'];
                $result['body'] = $task['body'];
                $result['image'] = $task['image'];
                $result['status'] = $task['status'];
                $data['tasks'][] = $result;
            }
            $data['pages_count'] = $pages_count;
            $data['current_page'] = $current_page;
            $data['tasks_count'] = $tasks_count;
            $data['sort'] = $sort;

            return $data;
        }

        /*Количество задач*/
        public function count_tasks() {

            $result = $this->db->query('SELECT count(distinct `id`) as count  FROM `t_tasks` ');
            foreach ($result as $res) {
                $data = $res['count'];
            }
            return $data;
        }
    }