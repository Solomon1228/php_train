<!-- Сообщение которое будем показывать при успешной отправки формы -->
<div class="form-result d-none">Форма успешно отправлена!</div>

<!-- Форма -->
<form id="form" action="/assets/php/process-form.php" method="post">
  <!-- Капча -->
  <div class="captcha">
      <img src="/generate_captcha.php"><br>
    <div class="captcha__group">
      <label for="captcha">Код, изображенный на картинке</label>
      <input type="text" name="captcha" id="captcha">
      <div class="invalid-feedback"></div>
    </div>
  </div>
  <!-- Кнопка "Отправить" -->
  <button type="submit">Отправить</button>
</form>