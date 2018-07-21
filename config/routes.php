<?php
return array(
    'auth/login'=>'users/login',
    'auth/logout'=>'users/logout',
    'tasks'=>'tasks/index',
    'tasks/sort-([a-z]+)/page-([0-9])'=>'tasks/index/$1/$2',
    'task/create'=>'tasks/create',
    'task/([0-9]+)' => 'tasks/update/$1'
)
?>