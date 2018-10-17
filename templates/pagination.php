
<?php if ($pages_count > 1): ?>
<div class="pagination">
    <ul class="pagination__control">
    <?php foreach ($pages as $page): ?>
        <li class="pagination-item <?php if($cur_page === $page){
            print('pagination-item-active');
        } else { ''; };?>">
            <a href="index.php?<?=(!empty($category)) ? "category=$category&" : '';?>page=<?=$page?>"><?=$page?></a>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
