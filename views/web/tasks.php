<table class="table">
    <?php
    $sort = $data['sort'];
    $page = $data['current_page'];
    $tasks = $data['tasks'];
    $pages_count = $data['pages_count'];
    $current_page = $data['current_page'];
    $tasks_count = $data['tasks_count'];

    ?>
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">
                Имя
                <a class="<?if ($sort == 'name_asc' ){?>active<?}?>" href="/tasks/sort-name_asc/page-<?=$current_page?>">&uarr;</a>
                <a class="<?if ($sort == 'name_desc'){?>active<?}?>" href="/tasks/sort-name_desc/page-<?=$current_page?>">&darr;</a>
            </th>
            <th scope="col">
                Email
                <a class="<?if ($sort == 'email_asc' ){?>active<?}?>" href="/tasks/sort-email_asc/page-<?=$current_page?>">&uarr;</a>
                <a class="<?if ($sort == 'email_desc'){?>active<?}?>" href="/tasks/sort-email_desc/page-<?=$current_page?>">&darr;</a>
            </th>
            <th scope="col">Текст задачи</th>
            <th scope="col">
                Статус
                <a class="<?if ($sort == 'status_asc' ){?>active<?}?>" href="/tasks/sort-status_asc/page-<?=$current_page?>">&uarr;</a>
                <a class="<?if ($sort == 'status_desc'){?>active<?}?>" href="/tasks/sort-status_desc/page-<?=$current_page?>">&darr;</a>

            </th>
            <?php
            if ($_SESSION['admin']) {?>

                <th scope="col">Редактировать</th>
            <?}?>
        </tr>
    </thead>
    <?foreach ($tasks as $task) {
        ?>
        <tr>
            <td>
                <span class="border border-primary">
                    <?if ($task['image']) {?>
                        <img class="img-thumbnail" src="/views/images/tasks/<?=$task['image']?>" width="40" height="40">
                    <?}?>
                </span>
            </td>
            <td><?=$task['name']?></td>
            <td><?=$task['email']?></td>
            <td><?=$task['body']?></td>
            <td><?if ($task['status']){?><a class="badge badge-pill badge-success">Выполнено</a><?}else{?><a class="badge badge-info">Не выполнено</a><?}?></td>
            <?php
            if ($_SESSION['admin']) {?>
                <td><a href="/task/<?=$task['id']?>">Редактировать</a> </td>
            <?}?>
        </tr>

        <?
    }
    ?>
</table>

<?php
include 'pagination.php';
?>