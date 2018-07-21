<?php
class View {

    public $index_view = '/views/web/index.php';

    public function assign($template, $data=null) {

        include dirname(dirname(__FILE__)).$this->index_view;

    }
}