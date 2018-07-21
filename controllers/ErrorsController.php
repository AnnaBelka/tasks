<?php

class ErrorsController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function page_not_found() {
        $this->view->assign('404');
    }

}