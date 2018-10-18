
<?php if ($pages_count > 1): ?>
<div class="pagination">

    <ul class="pagination__control">
        <li class="pagination-item pagination-item-prev"><a href="index.php?page=<?=$cur_page-1?>">Назад</a></li>
    <?php foreach ($pages as $page): ?>
        <li class="pagination-item <?php if($cur_page === $page){
            print('pagination-item-active');
        } else { ''; };?>">
            <a href="index.php?<?=(!empty($category)) ? "category=$category&" : '';?>page=<?=$page?>"><?=$page?></a>
        </li>
    <?php endforeach; ?>
    <li class="pagination-item pagination-item-next"><a href="index.php?page=<?=$cur_page+1?>">Вперед</a></li>
    </ul>
</div>
<?php endif; ?>
