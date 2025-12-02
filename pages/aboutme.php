<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title><?php echo isset($page_title) ? $page_title : 'Про мене'; ?></title>
    <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
</head>
<body>
  <header>
    <a href="/">
      <button class="login-btn" style="background-color: #244992;">Головна</button>
    </a>
    <img src="/img/wikipedia_word.png">
    <h2>Вільна енциклопедія</h2>
    <img class="Logo" src="/img/Wikipedia.png" alt="Wikipedia Logo" />
  </header>
  
  <section class="section" style="padding: 40px 20px;">
    <div class="container" style="max-width: 800px; margin: 0 auto;">
      <h1 style="text-align: center; color: white; margin-bottom: 30px;">Про мене</h1>
      
      <?php if (!isset($data)): ?>
        <div style="background: white; padding: 30px; border-radius: 10px; text-align: center;">
          <p style="color: red;">Помилка: дані не передані</p>
        </div>
      <?php else: ?>
      <div style="background: white; padding: 30px; border-radius: 10px; margin-bottom: 20px;">
        <h2 style="color: #244992; margin-bottom: 10px;"><?php echo htmlspecialchars($data['name']); ?></h2>
        <p style="color: #666; margin-bottom: 20px;"><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
        <p style="color: #333; line-height: 1.6;"><?php echo htmlspecialchars($data['bio']); ?></p>
      </div>

      <div style="background: white; padding: 30px; border-radius: 10px; margin-bottom: 20px;">
        <h3 style="color: #244992; margin-bottom: 15px;">Навички</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
          <?php foreach ($data['skills'] as $skill): ?>
            <span style="background: #244992; color: white; padding: 8px 15px; border-radius: 5px; display: inline-block;">
              <?php echo htmlspecialchars($skill); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div style="background: white; padding: 30px; border-radius: 10px; margin-bottom: 20px;">
        <h3 style="color: #244992; margin-bottom: 15px;">Освіта</h3>
        <ul style="list-style: none; padding: 0;">
          <?php foreach ($data['education'] as $key => $value): ?>
            <li style="padding: 8px 0; border-bottom: 1px solid #eee;">
              <strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div style="background: white; padding: 30px; border-radius: 10px;">
        <h3 style="color: #244992; margin-bottom: 15px;">Досвід</h3>
        <?php foreach ($data['experience'] as $exp): ?>
          <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
            <h4 style="color: #244992; margin-bottom: 5px;"><?php echo htmlspecialchars($exp['position']); ?></h4>
            <p style="color: #666; margin-bottom: 5px;"><strong>Організація:</strong> <?php echo htmlspecialchars($exp['company']); ?></p>
            <p style="color: #666; margin-bottom: 5px;"><strong>Період:</strong> <?php echo htmlspecialchars($exp['period']); ?></p>
            <p style="color: #333; margin-top: 10px;"><?php echo htmlspecialchars($exp['description']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>
        
  <hr>
  <footer>
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/"> Creative Commons Attribution-ShareAlike</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Terms_of_Use">Умови використання</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Privacy_policy/uk">Політика конфіденційності</a>
  </footer>
</body>
</html>

