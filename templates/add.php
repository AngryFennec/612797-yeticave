<?php var_dump($errors);?>
<form class="form form--add-lot container <?php if(!empty($errors)) echo "form--invalid";?>" action="add.php" method="post"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?php isset($errors['lot-name']) ? "form__item--invalid" : ""?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" required>
      <span class="form__error"><?=$errors['lot-name'];?></span>
      </div>
    <div class="form__item  <?php echo isset($errors['category']) ? "form__item--invalid" : "";?>">
      <label for="category">Категория</label>
      <select id="category" name="category" required>
        <?php foreach ($categories as $key => $val):?>
            <option><?=$val["cat_name"];?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
  </div>
  <div class="form__item form__item--wide">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота" required></textarea>
    <span class="form__error"><?=$errors['message'];?></span>
  </div>
  <div class="form__item form__item--file <?php echo isset(!$errors['photo']) ? "form__item--uploaded" : "";?>"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo" value="" name="photo">
      <label for="photo">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small <?php echo isset($errors['lot-rate']) ? "form__item--invalid" : "";?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" required>
      <span class="form__error"><?=$errors['lot-rate'];?></span>
      <span class="form__error"><?=$errors['lot_rate'];?></span>
    </div>
    <div class="form__item form__item--small  <?php echo isset($errors['lot-step']) ? "form__item--invalid" : "";?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" required>
      <span class="form__error"><?=$errors['lot-step'];?></span>
      <span class="form__error"><?=$errors['lot_step'];?></span>
    </div>
    <div class="form__item <?php echo isset($errors['lot-date']) ? "form__item--invalid" : "";?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" required>
      <span class="form__error"><?=$errors['lot-date'];?></span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
