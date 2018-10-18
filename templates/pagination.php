<?php if ($pages_count > 1): ?>
<ul class="pagination-list">
    <?php if ($cur_page > 1) : ?><li class="pagination-item pagination-item-prev"><a href="<?=$page_name?>?page=<?=$cur_page-1?>">Назад</a></li><?php endif;?>
    <?php foreach ($pages as $page): ?>
        <li class="pagination-item <?= ($cur_page === $page) ? 'pagination-item-active' : '';?>">
            <? if($page_name ==='index.php'):?>
            <a href="<?=$page_name?>?<?=(!empty($category)) ? "category=$category&" : '';?>page=<?=$page?>"><?=$page?></a>
            <?else:?>
            <a href="<?=$page_name?>?<?="search=$search&";?>page=<?=$page?>"><?=$page?></a>
            <?endif;?>
        </li>
    <?php endforeach; ?>
    <?php if ($cur_page < $pages_count) : ?><li class="pagination-item pagination-item-next"><a href="<?=$page_name?><?=$cur_page+1?>">Вперед</a></li><?php endif;?>
</ul>
<?php endif; ?>
