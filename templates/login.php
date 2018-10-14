<form class="form container <?php if(!empty($errors)) echo "form--invalid";?>" action="login.php" enctype="multipart/form-data" method="post"> <!-- form--invalid -->
<h2>Вход</h2>
<div class="form__item <?=!empty($errors['email']) ? "form__item--invalid" : ""?>"> <!-- form__item--invalid -->
<label for="email">E-mail*</label>
<input id="email" type="text" name="email" placeholder="Введите e-mail" required <?=!empty($data['email']) ? " value='". $data['email'] ."'" : ''; ?>>
<span class="form__error"><?=!empty($errors['email']) ? $errors['email'] : " "?></span>
</div>
<div class="form__item <?=!empty($errors['password']) ? "form__item--invalid" : ""?>"> <!-- form__item--invalid -->
<label for="password">Пароль*</label>
<input id="password" type="password" name="password" placeholder="Введите пароль" required <?=!empty($data['password']) ? " value='". $data['password'] ."'" : ''; ?>>
<span class="form__error"><?=!empty($errors['password']) ? $errors['password'] : " "?></span>
</div>
<button type="submit" class="button">Войти</button>
</form>
