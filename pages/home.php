<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/styles/style.css">
  <title><?php echo isset($page_title) ? $page_title : 'Wikipedia'; ?></title>
  <link rel="shortcut icon" href="/img/Wikipedia.png" type="image/x-icon">
</head>
<body>
  <header>
    <img src="/img/wikipedia_word.png">
    <h2>Вільна енциклопедія</h2>
    <img class="Logo" src="/img/Wikipedia.png" alt="Wikipedia Logo" />
    <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
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
    <form class="form" action="https://en.wikipedia.org/wiki/" method="get">
      <input type="text" name="search" />
      <button type="submit"><img src="/img/search.svg" alt=""></button>
    </form>
  </header>

  <div class="languages">
    <button class="lang1"><a href="https://uk.wikipedia.org/wiki/Головна_сторінка">Українська</a>
      <span>1,371,000+ статей</span>
    </button>
    <button class="lang2"><a href="https://en.wikipedia.org/wiki/Main_Page">English</a><span>6,974,000+ articles</span></button>
    <button class="lang3"><a href="https://ru.wikipedia.org/wiki/Заглавная_страница">Русский</a>
      <span>2,036,000+ статей</span>
    </button>
    <button class="lang4"><a href="https://es.wikipedia.org/wiki/Wikipedia:Portada">Español</a>
      <span>2,021,000+ artículos</span>
    </button>
    <button class="lang5"><a href="https://zh.wikipedia.org/wiki/Wikipedia:首页">中文</a>
      <span>1,470,000+ 条目</span>
    </button>
    <button class="lang6"><a href="https://pt.wikipedia.org/wiki/Wikipédia:Página_principal">Português</a>
      <span>1,146,000+ artigos</span>
    </button>
    <button class="lang7"><a href="https://it.wikipedia.org/wiki/Pagina_principale">Italiano</a>
      <span>1,910,000+ voci</span>
    </button>
    <button class="lang8"><a href="https://de.wikipedia.org/wiki/Wikipedia:Hauptseite">Deutsch</a>
      <span>3,001,000+ Artikel</span>
    </button>
  </div>
  <hr>
  <div id="images-container" style="padding: 20px; text-align: center; background: #f8f9fa; margin: 20px 0;">
  </div>
  <hr>
  <div class="otherpj">
    <div>
      <img src="/img/Wikimedia-logo_black.svg">
      <p>Вікіпедія перебуває на серверах Фонду Вікімедіа — неприбуткової організації, що також опікується рядом інших проєктів.</p>
      <a href="https://donate.wikimedia.org/w/index.php?title=Special:LandingPage&country=UA&uselang=uk&wmf_medium=portal&wmf_source=portalFooter&wmf_campaign=portalFooter">Ви можете підтримати нашу роботу пожертвою.</a>
    </div>

    <div>
      <img src="/img/W.png">
      <p>За допомогою офіційного мобільного додатку Вікіпедії ви зможете зберегти статті до списків читання офлайн, синхронізувати списки на різних пристроях та ін.</p>
      <a href="https://play.google.com/store/apps/details?id=org.wikipedia&referrer=utm_source%3Dportal%26utm_medium%3Dbutton%26anid%3Dadmob&pli=1"><img class="footimg" src="/img/pl.png">
      </a><a href="https://apps.apple.com/us/app/wikipedia/id324715238"><img class="footimg" src="/img/ap.png">
      </a>
    </div>
  </div>
  <hr>
  <script src="/scripts/script.js"></script>
  <footer>
    Ця сторінка доступна на умовах ліцензії <a href="https://creativecommons.org/licenses/by-sa/4.0/"> Creative Commons Attribution-ShareAlike</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Terms_of_Use">Умови використання</a> <a href="https://foundation.wikimedia.org/wiki/Policy:Privacy_policy/uk">Політика конфіденційності</a>
  </footer>
</body>
</html>

