<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') : 'Авторизація'; ?></title>
    <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
    <style>
        .tabs {
            margin-bottom: 20px;
        }
        .message {
            margin-top: 20px;
        }
    </style>
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
      <a href="/aboutme">
        <button class="login-btn">Про мене</button>
      </a>
    </div>
  </header>
  <section class="section has-text-justified">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-6">
          <div class="tabs is-centered">
            <ul>
              <li class="<?php echo (!isset($_GET['tab']) || htmlspecialchars($_GET['tab'] ?? '', ENT_QUOTES, 'UTF-8') == 'login') ? 'is-active' : ''; ?>">
                <a href="?tab=login">Увійти</a>
              </li>
              <li class="<?php echo (isset($_GET['tab']) && htmlspecialchars($_GET['tab'], ENT_QUOTES, 'UTF-8') == 'register') ? 'is-active' : ''; ?>">
                <a href="?tab=register">Реєстрація</a>
              </li>
            </ul>
          </div>

          <?php if (isset($error_message)): ?>
            <div class="message is-danger">
              <div class="message-body"><?php echo htmlspecialchars($error_message); ?></div>
            </div>
          <?php endif; ?>

          <?php if (isset($success_message)): ?>
            <div class="message is-success">
              <div class="message-body"><?php echo htmlspecialchars($success_message); ?></div>
            </div>
          <?php endif; ?>

          <?php if (!isset($_GET['tab']) || $_GET['tab'] == 'login'): ?>
            <h3 class="title has-text-centered has-text-white">Авторизація</h3>
            <form action="/login" method="post" class="box">
              <input type="hidden" name="action" value="login">
              <div class="field">
                <label class="label has-text-dark">Ім'я користувача</label>
                <div class="control">
                  <input class="input has-text-black" name="username" placeholder="Введіть ім'я користувача" required>
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
                  <button class="button is-primary" type="submit">Увійти</button>
                </div>
              </div>
            </form>
          <?php else: ?>
            <h3 class="title has-text-centered has-text-white">Реєстрація</h3>
            <form action="/login?tab=register" method="post" class="box">
              <input type="hidden" name="action" value="register">
              <div class="field">
                <label class="label has-text-dark">Ім'я користувача</label>
                <div class="control">
                  <input class="input has-text-black" name="username" placeholder="Введіть ім'я користувача" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                </div>
              </div>
              <div class="field">
                <label class="label has-text-dark">Email</label>
                <div class="control">
                  <input class="input has-text-black" type="email" name="email" placeholder="Введіть email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
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
                  <button class="button is-primary" type="submit">Зареєструватися</button>
                </div>
              </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
        
  <hr>
  <footer>
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/"> Creative Commons Attribution-ShareAlike</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Terms_of_Use">Умови використання</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Privacy_policy/uk">Політика конфіденційності</a>
  </footer>
</body>
</html>
