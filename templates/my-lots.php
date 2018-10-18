<nav class="nav">
    <ul class="nav__list container">
        <!--заполните этот список из массива категорий-->
        <?php foreach($categories as $value):?>
            <li class="nav__item">
                <a href="/?category=" . <?=$value['category_id']?>><?=$value['cat_name'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="rates container">
  <h2>Мои ставки</h2>
  <table class="rates__list">
    <?php foreach ($my_bets as $val):?>
      <tr class="rates__item <?=(!empty($val['winner_id']) && time()>strtotime($val['end_date'])) ? ' rates__item--win' : ''?> <?=strtotime($val['end_date']) < time() ? ' rates__item--end' : ''?>">
      <td class="rates__info">
        <div class="rates__img">
          <img src="<?=!empty($val['img']) ? $val['img'] : ''?>" width="54" height="40" alt="<?=!empty($val['cat_name']) ? $val['cat_name'] : ''?>">
        </div>
        <h3 class="rates__title"><a href="lot.php?lot_id=<?=$val['lot_id']?>"><?=$val['name']?></a></h3>
        <?php if(!empty($val['winner_id'])&& time()>strtotime($val['end_date'])):?>
        <p><?=$val['contacts'];?></p>
      <? endif ?>
      </td>
      <td class="rates__category">
        <?=$val['cat_name']?>
      </td>
      <td class="rates__timer">
        <?php if(!empty($val['winner_id'])&& time()>strtotime($val['end_date'])): ?>
        <div class="timer timer--win">Ставка выиграла</div>
    <?php elseif (strtotime($val['end_date']) < time()): ?>
          <div class="timer timer--end">Торги окончены</div>
        <?php else: ?>
        <div class="timer timer--finishing"><?=get_formatted_time($val['end_date']);?></div>
        <?php endif?>
      </td>
      <td class="rates__price">
        <?=$val['sum'];?>
      </td>
      <td class="rates__time">
        <?=get_formatted_time_bet($val['init_date']);?>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</section>
