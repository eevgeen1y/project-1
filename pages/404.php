<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title><?php echo isset($page_title) ? $page_title : '404 - Сторінку не знайдено'; ?></title>
    <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
</head>
<body>
  <header>
    <img src="/img/wikipedia_word.png">
    <h2>Вільна енциклопедія</h2>
    <img class="Logo" src="/img/Wikipedia.png" alt="Wikipedia Logo" />
    <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
      <a href="/">
        <button class="login-btn">Головна</button>
      </a>
      <a href="/login">
        <button class="login-btn">Увійти</button>
      </a>
      <a href="/api">
        <button class="login-btn">API</button>
      </a>
      <a href="/game">
        <button class="login-btn">🎮 Гра</button>
      </a>
    </div>
  </header>
  
  <section style="text-align: center; margin: 100px 0;">
    <h1 style="font-size: 4rem; margin-bottom: 20px;">404</h1>
    <h2 style="font-size: 2rem; margin-bottom: 30px;">Сторінку не знайдено</h2>
    <p style="font-size: 1.2rem; margin-bottom: 40px; color: #a2a9b1;">
      Вибачте, але сторінка, яку ви шукаєте, не існує або була переміщена.
    </p>
    <a href="/" style="display: inline-block; padding: 15px 30px; background-color: #3366cc; color: white; text-decoration: none; border-radius: 5px; font-size: 1.1rem;">
      Повернутися на головну сторінку
    </a>
  </section>
  
  <hr>
  <footer>
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/"> Creative Commons Attribution-ShareAlike</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Terms_of_Use">Умови використання</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Privacy_policy/uk">Політика конфіденційності</a>
  </footer>
</body>
</html>

