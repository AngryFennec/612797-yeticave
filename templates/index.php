<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $key => $val):?>
            <li class="promo__item promo__item--<?=$val["class"];?>">
                <a class="promo__link" href="/?category=<?=$val['category_id']?>"><?=$val['cat_name'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php foreach ($lots as $key => $val): ?>
        <li class="lots__item lot">
            <div class="lot__image">
                <img src=<?=$val['img']; ?> width="350" height="260" alt="">
            </div>
            <div class="lot__info">
                <span class="lot__category"><?=$val['cat_name']; ?></span>
                <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$val['lot_id']?>"><?=htmlspecialchars($val['name']); ?></a></h3>
                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount">Стартовая цена</span>
                        <span class="lot__cost"><?=format_sum($val['sum']); ?></span>
                    </div>
                    <div class="lot__timer timer">
                        <?=get_formatted_time($val['end_date']);?>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</section>
<?=$pagination?>
