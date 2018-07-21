<?php
include_once dirname(__FILE__) . '/functions.php';
    class Model {

        public function __construct(){
            $this->db = DataBase::getDB();
        }

    }