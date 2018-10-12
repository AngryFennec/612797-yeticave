<form class="form form--add-lot container <?php if(!empty($errors)) echo "form--invalid";?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?=!empty($errors['lot-name']) ? "form__item--invalid" : ""?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" required <?=!empty($data['lot-name']) ? " value='". $data['lot-name'] ."'" : ''; ?>>
      <span class="form__error"><?=!empty($errors['lot-name']) ? $errors['lot-name'] : " "?></span>
      </div>
    <div class="form__item  <?php echo !empty($errors['category']) ? "form__item--invalid" : "";?>">
      <label for="category">Категория</label>
      <select id="category" name="category" required>
        <?php foreach ($categories as $key => $val):?>
            <option <?if ( !empty($data['category_id']) && $data['category_id'] == $val['category_id']) print(' selected') ?>
            value=<?= $val['category_id'] ?>><?=$val["cat_name"];?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
  </div>
  <div class="form__item form__item--wide">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота" required> <?=!empty($data['message']) ?  $data['message'] : ''; ?></textarea>
    <?=!empty($errors['message']) ? $errors['message'] : " "?>
  </div>
  <div class="form__item form__item--file <?php echo !empty($errors['photo']) ? "form__item--uploaded" : "";?>"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo" value="" name="photo">
      <label for="photo">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <span class="form__error"><?=!empty($errors['photo']) ? $errors['photo'] : " "?></span>
  <div class="form__container-three">
    <div class="form__item form__item--small <?php echo !empty($errors['lot-rate']) ? "form__item--invalid" : "";?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" required  <?=!empty($data['lot-rate']) ? " value='". $data['lot-rate'] ."'" : ''; ?>>
      <span class="form__error"><?=!empty($errors['lot-rate']) ? $errors['lot-rate'] : " "?></span>
    </div>
    <div class="form__item form__item--small  <?php echo !empty($errors['lot-step']) ? "form__item--invalid" : "";?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" required  <?=!empty($data['lot-step']) ? " value='". $data['lot-step'] ."'" : ''; ?>>
      <span class="form__error"><?=!empty($errors['lot-step']) ? $errors['lot-step'] : " "?></span>
    </div>
    <div class="form__item <?php echo !empty($errors['lot-date']) ? "form__item--invalid" : "";?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" required  <?=!empty($data['lot-date']) ? " value='". $data['lot-date'] ."'" : ''; ?>>
      <span class="form__error"><?=!empty($errors['lot-date']) ? $errors['lot-date'] : " "?></span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
