<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/styles/style.css">
  <title><?php echo isset($page_title) ? $page_title : 'Гонка - Wikipedia'; ?></title>
  <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .game-header {
      text-align: center;
      color: white;
      margin-bottom: 20px;
    }

    .game-container {
      position: relative;
      background: #2c3e50;
      border: 5px solid #34495e;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    #gameCanvas {
      display: block;
      background: #34495e;
    }

    .game-ui {
      position: absolute;
      top: 10px;
      left: 10px;
      color: white;
      font-size: 20px;
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
      z-index: 10;
    }

    .game-over {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, 0.9);
      color: white;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      display: none;
      z-index: 100;
    }

    .game-over h2 {
      font-size: 36px;
      margin-bottom: 20px;
      color: #e74c3c;
    }

    .game-over p {
      font-size: 24px;
      margin: 10px 0;
    }

    .btn {
      background: #3498db;
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 18px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #2980b9;
    }

    .instructions {
      background: rgba(255, 255, 255, 0.9);
      padding: 15px;
      border-radius: 5px;
      margin-top: 20px;
      max-width: 600px;
      text-align: center;
    }

    .instructions h3 {
      color: #2c3e50;
      margin-bottom: 10px;
    }

    .instructions p {
      color: #34495e;
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <header style="position: relative; width: 100%; text-align: center; padding: 20px 0;">
    <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
      <a href="/">
        <button class="login-btn" style="position: static;">Головна</button>
      </a>
      <a href="/login">
        <button class="login-btn" style="position: static;">Увійти</button>
      </a>
      <a href="/api">
        <button class="login-btn" style="position: static;">API</button>
      </a>
    </div>
  </header>
  <div class="game-header">
    <h1>🏎️ Гонка з перешкодами</h1>
  </div>

  <div class="game-container">
    <div class="game-ui">
      <div>Очки: <span id="score">0</span></div>
      <div>Швидкість: <span id="speed">1</span></div>
    </div>
    <canvas id="gameCanvas" width="600" height="800"></canvas>
    <div class="game-over" id="gameOver">
      <h2>Гра закінчена!</h2>
      <p>Ваш рахунок: <span id="finalScore">0</span></p>
      <p>Рекорд: <span id="highScore">0</span></p>
      <button class="btn" onclick="restartGame()">Грати знову</button>
    </div>
  </div>

  <div class="instructions">
    <h3>Як грати:</h3>
    <p>⬅️ ➡️ Стрілки вліво/вправо - рух машинки</p>
    <p>🎯 Об'їжджайте перешкоди та набирайте очки!</p>
    <p>⚡ Швидкість збільшується з часом</p>
  </div>

  <script src="/scripts/game.js"></script>
</body>
</html>

