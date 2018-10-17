<div class="container">
<section class="lots">
<h2>Результаты поиска по запросу «<span><?=$data['search']?></span>»</h2>
<ul class="lots__list">
<?php foreach ($lots_searched as $value):?>
    <li class="lots__item lot">
        <div class="lot__image">
            <img src="<?=$value['img']?>" width="350" height="260" alt="<?=$value['cat_name'] ?>">
        </div>
        <div class="lot__info">
            <span class="lot__category"><?=$value['cat_name'] ?></span>
            <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$value['lot_id'] ?>"><?=$value['name']?></a></h3>
            <div class="lot__state">
                <div class="lot__rate">
                    <span class="lot__amount">Стартовая цена</span>
                    <span class="lot__cost"><?=format_sum($value['sum']);?></span>
                </div>
                <div class="lot__timer timer">
                    <?=get_formatted_time($value['end_date']);?>
                </div>
            </div>
        </div>
    </li>
<?php endforeach;?>
</ul>
</section>
<?=$pagination?>
</div>
