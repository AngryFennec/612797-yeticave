<section class="lot-item container">
<h2><?=$lot['name']?></h2>
<div class="lot-item__content">
<div class="lot-item__left">
  <div class="lot-item__image">
    <img src="<?=$lot['img']?>" width="730" height="548" alt=<?=$lot['cat_name']?>>
  </div>
  <p class="lot-item__category">Категория: <span><?=$lot['cat_name']?></span></p>
  <p class="lot-item__description"><?=htmlspecialchars($lot['description'])?></p>
</div>
<div class="lot-item__right">
    <?php if (!empty($user) && ($lot['user_id'] !== $user['user_id']) && !is_already_bet($user, $bets) && time() < strtotime($lot['end_date'])): ?>
  <div class="lot-item__state">
    <div class="lot-item__timer timer">
      10:54:12
    </div>
    <div class="lot-item__cost-state">
      <div class="lot-item__rate">
        <span class="lot-item__amount">Текущая цена</span>
        <span class="lot-item__cost"><?=get_max_bet($bets, $lot)?></span>
      </div>
      <div class="lot-item__min-cost">
        Мин. ставка <span><?=get_max_bet($bets, $lot) + (empty($lot['bet_step'])? 1 : $lot['bet_step'])?></span>
      </div>
    </div>
    <form class="lot-item__form" action="lot.php?lot_id=<?=$lot['lot_id']?>" method="post">
      <p class="lot-item__form-item <?php if(!empty($errors)) echo "form__item--invalid";?>">
        <label for="cost">Ваша ставка</label>
        <input id="cost" type="number" name="cost" placeholder=<?=get_max_bet($bets, $lot) + (empty($lot['bet_step'])? 1 : $lot['bet_step'])?>>
      </p>
      <button type="submit" class="button">Сделать ставку</button>
      <span class="form__error"><?=!empty($errors['cost']) ? $errors['cost'] : " "?></span>
    </form>
  </div>
<?php endif; ?>
  <div class="history">
    <h3>История ставок (<span><?=count($bets)?></span>)</h3>
    <table class="history__list">
        <?php
        foreach ($bets as $val):?>
        <tr class="history__item">
          <td class="history__name"><?=htmlspecialchars($val['name'])?></td>
          <td class="history__price"><?=$val['sum']?></td>
          <td class="history__time"><?=get_formatted_time_bet($val['init_date'])?></td>
        </tr>
        <?php endforeach; ?>
    </table>
  </div>
</div>
</div>
</section>
