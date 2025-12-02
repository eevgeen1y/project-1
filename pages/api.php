<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/styles/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <title><?php echo isset($page_title) ? $page_title : 'API Demo - Wikipedia'; ?></title>
  <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
  <style>
    .api-section {
      padding: 40px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    .api-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    .api-header {
      text-align: center;
      color: white;
      margin-bottom: 30px;
    }
    .api-box {
      background: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    #users-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 30px;
    }
    .loading-spinner {
      text-align: center;
      padding: 20px;
      display: none;
    }
    .spinner {
      border: 4px solid #f3f3f3;
      border-top: 4px solid #244992;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .error-message {
      background: #fee;
      color: #c33;
      padding: 15px;
      border-radius: 5px;
      margin: 15px 0;
      display: none;
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
      <a href="/login">
        <button class="login-btn">Увійти</button>
      </a>
      <a href="/game">
        <button class="login-btn">🎮 Гра</button>
      </a>
    </div>
  </header>

  <section class="api-section">
    <div class="api-container">
      <div class="api-header">
        <h1 class="title is-2 has-text-white">API Demo - Random Users</h1>
        <p class="subtitle is-5 has-text-white">Використання fetch, async/await, try/catch, Promises</p>
      </div>

      <div class="api-box">
        <div class="field has-text-centered">
          <button id="load-users-btn" class="button is-primary is-large">
            Завантажити користувачів
          </button>
        </div>

        <div id="loading" class="loading-spinner">
          <div class="spinner"></div>
          <p style="margin-top: 10px;">Завантаження даних...</p>
        </div>

        <div id="error-message" class="error-message"></div>

        <div id="users-container"></div>
      </div>

      <div class="api-box" style="margin-top: 30px; background: #f8f9fa;">
        <h3 class="title is-4">Про API:</h3>
        <p><strong>API:</strong> <a href="https://randomuser.me/api/" target="_blank">Random User API</a></p>
        <p><strong>Метод:</strong> GET</p>
        <p><strong>Endpoint:</strong> <code>https://randomuser.me/api/?results=6&nat=us,gb,ua</code></p>
        <p><strong>Використані технології:</strong></p>
        <ul>
          <li>✅ <code>fetch()</code> - для HTTP запитів</li>
          <li>✅ <code>async/await</code> - для асинхронного коду</li>
          <li>✅ <code>try/catch</code> - для обробки помилок</li>
          <li>✅ <code>Promises</code> - для асинхронних операцій</li>
        </ul>
      </div>
    </div>
  </section>

  <script src="/scripts/api-fetch.js"></script>
  <footer style="background: #244992; color: white; padding: 20px; text-align: center;">
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/" style="color: #fff;"> Creative Commons Attribution-ShareAlike</a>
  </footer>
</body>
</html>

