<?php
if ($pages_count>1) {

    /* Скрипт для листания через ctrl → */
    /* Ссылки на соседние страницы должны иметь id PrevLink и NextLink */
    ?>
    <script type="text/javascript" src="views/js/ctrlnavigate.js"></script>

    <!-- Листалка страниц -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        <?
        /* Количество выводимых ссылок на страницы */

        $visible_pages = 11;

        /* По умолчанию начинаем вывод со страницы 1 */
        $page_from = 1;

        /* Если выбранная пользователем страница дальше середины "окна" - начинаем вывод уже не с первой */
        if ($current_page > floor($visible_pages / 2)) {
            $page_from = max(1, $current_page - floor($visible_pages / 2) - 1);
        }

        /* Если выбранная пользователем страница близка к концу навигации - начинаем с "конца-окно" */
        if ($current_page > $pages_count - ceil($visible_pages / 2)){
            $page_from = max(1, $pages_count - $visible_pages - 1);
        }

        /* До какой страницы выводить - выводим всё окно, но не более ощего количества страниц */
        $page_to = min($page_from + $visible_pages, $pages_count - 1);

        /* Ссылка на 1 страницу отображается всегда */
        ?>
        <li class="page-item <?if ($current_page == 1) {?>active <?} else {?>droppable<?} ?>">
            <a class="page-link " href="/tasks/sort-<?=$sort?>/page-1">1</a>
        </li>
        <?
        $page_from = $page_from+1;
        /* Выводим страницы нашего "окна" */
        for ($page_from; $page_from<=$page_to; $page_from++) {

            /* Номер текущей выводимой страницы */
            $p = $page_from;

            /* Для крайних страниц "окна" выводим троеточие, если окно не возле границы навигации */
            if (($p == $page_from + 1 && $p != 2) || ($p == $page_to && $p != $pages_count - 1)) {
                ?>
                <li class="page-item <? if ($p == $current_page) {?>active<? } ?>">
                    <a class="page-link"  href="/tasks/sort-<?=$sort?>/page-<?= $p ?>">...</a>
                </li>
            <? } else { ?>
                <li class="page-item <? if ($p == $current_page) {?>active<? } ?>">
                    <a class="page-link" href="/tasks/sort-<?=$sort?>/page-<?= $p ?>"><?= $p ?></a>
                </li>

                <?
            }
        }

        /* Ссылка на последнююю страницу отображается всегда */
        ?>
        <li class="page-item <? if ($current_page == $pages_count) {?>active<? } ?>">
            <a class="page-link" href="/tasks/sort-<?=$sort?>/page-<?= $pages_count ?>"><?= $pages_count ?></a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/tasks/sort-<?=$sort?>/page-all">все сразу</a>
        </li>
        <?
        if ($current_page > 1) {
            ?>
            <li class="page-item">
                <a class="page-link" href="/tasks/sort-<?=$sort?>/page-<?= $current_page - 1 ?>">←назад</a>
            </li>
        <?
        }
        if ($current_page < $pages_count) {
            ?>
            <li class="page-item">
                <a class="page-link" href="/tasks/sort-<?=$sort?>/page-<?= $current_page + 1 ?>">вперед→</a>
            </li>
        <?
        } ?>

        </ul>
    </nav>
    <!-- Листалка страниц (The End) -->
    <?
    }
?>