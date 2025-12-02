<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    
    
    <title><?php echo isset($page_title) ? $page_title : 'Авторизація'; ?></title>
    <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
</head>
<body>
  <header>
    <a href="/" style="position: absolute; top: 10px; left: 10px;">
      <button class="login-btn" style="background-color: #244992;">Головна</button>
    </a>
    <img src="/img/wikipedia_word.png">
    <h2>Вільна енциклопедія</h2>
    <img class="Logo" src="/img/Wikipedia.png" alt="Wikipedia Logo" />
  </header>
  <section class="section has-text-justified">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-6">
          <h3 class="title has-text-centered has-text-white">Авторизація</h3>
          <form action="https://uk.wikipedia.org" method="post" class="box">
            <div class="field">
              <label class="label has-text-dark">Ім'я користувача (Login)</label>
              <div class="control">
                <input class="input has-text-black" name="username" placeholder="Введіть логін (3-20 символів, латиниця, цифри, _)" required>
              </div>
            </div>
            <div class="field">
              <label class="label has-text-dark">Email</label>
              <div class="control">
                <input class="input has-text-black" type="email" name="email" placeholder="Введіть email" required>
              </div>
            </div>
            <div class="field">
              <label class="label has-text-dark">Телефон</label>
              <div class="control">
                <input class="input has-text-black" type="tel" name="phone" placeholder="+380XXXXXXXXX або 0XXXXXXXXX" required>
              </div>
            </div>
            <div class="field">
              <label class="label has-text-dark">Пароль</label>
              <div class="control">
                <input class="input" type="password" name="password" placeholder="Введіть пароль" required>
              </div>
            </div>
            <div class="field">
                <div class="control is-flex is-justify-content-center">
                <button class="button is-primary">Увійти</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="section has-text-justified">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-8">
          <h3 class="title has-text-centered has-text-white">Порівняння текстів (Set)</h3>
          <div class="box">
            <div class="field">
              <label class="label has-text-dark">Текст 1</label>
              <div class="control">
                <input class="input has-text-black" type="text" id="text-input-1" placeholder="Введіть перший текст" value="Привіт, світ!">
              </div>
            </div>
            <div class="field">
              <label class="label has-text-dark">Текст 2</label>
              <div class="control">
                <input class="input has-text-black" type="text" id="text-input-2" placeholder="Введіть другий текст" value="Привіт, як справи?">
              </div>
            </div>
            <div class="field">
              <div id="common-words-result" class="notification">
                <p class="has-text-grey">Введіть текст в обидва поля для порівняння</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
        
  <script src="/scripts/validation.js"></script>
  <script src="/scripts/set-comparison.js"></script>
  <hr>
  <footer>
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/"> Creative Commons Attribution-ShareAlike</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Terms_of_Use">Умови використання</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Privacy_policy/uk">Політика конфіденційності</a>
  </footer>
</body>
</html>

