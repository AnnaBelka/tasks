<?php
require_once(dirname(dirname(__FILE__)) . '/models/TasksModel.php');

    class TasksController extends Controller{

        public function __construct() {
            parent::__construct();
            $this->model = new TasksModel();
        }

        public function index($sort = 'name ASC', $page = 1) {
            $data = $this->model->get_tasks($sort, $page);
            $this->view->assign('tasks', $data);
        }

        public function create() {
            if ($_POST) {
                $data = $this->model->create_task();
                $this->view->assign('task', $data);

            } else {
                $this->view->assign('task');
            }
        }

        public function update($task_id) {
            if ($_POST) {
                $data = $this->model->update_task((int)$task_id);
                $this->view->assign('task', $data);
            } else {
                $data = $this->model->get_task((int)$task_id);
                $this->view->assign('task', $data);
            }
        }
    }