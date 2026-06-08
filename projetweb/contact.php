<?php
// 如果表单通过 POST 提交，则读取并处理表单数据
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");      // 获取用户输入的邮箱，去掉首尾空格
    $message = trim($_POST["message"] ?? "");  // 获取用户输入的消息，去掉首尾空格

    // 只有当邮箱和消息都填写时，才进行下一步处理
    if ($email !== "" && $message !== "") {
        $to = "contact@artistrooms.fr";  // 收件人地址
        $subject = "Message depuis le site Artist Rooms";  // 邮件主题

        // 构建邮件正文内容
        $body = "E-mail : " . $email . "\n\n";
        $body .= "Message :\n" . $message;

        // 生成 mailto 链接，并对标题和正文进行 URL 编码
        $mailto = "mailto:" . $to
            . "?subject=" . rawurlencode($subject)
            . "&body=" . rawurlencode($body);

        // 重定向到 mailto 链接，打开用户的邮件客户端
        header("Location: " . $mailto);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact - Artist Rooms Paris</title>
  <link rel="stylesheet" href="main.css">
</head>

<body class="homepage">

  <!-- 顶部菜单 -->
  <header class="topbar">
    <a class="brand" href="index.html">
      <img class="brand-logo" src="images/logo.jpg" alt="Logo Artist Rooms">
    </a>

        <button class="menu-btn" aria-label="Toggle navigation menu">☰</button>

    <nav class="topnav">
      <a href="index.html">Home</a>
      <a href="galeries.html">Galleries</a>
      <a href="artistes.php">Artists</a>
      <a href="contact.php">Contact</a>
    </nav>

    <div class="lang">
      <a href="contact-en.php" class="lang-btn">En</a>
    </div>
  </header>

  <!-- 主体 -->
  <main class="contact-main">
    <h1>Contact</h1>

    <section class="contact-section">

      <!-- 左侧信息 -->
      <div class="contact-info">
        <h2>Contactez-nous</h2>

        <p>
          <strong>57 RUE AU MAIRE</strong><br>
          PARIS, 75003<br>
          France<br><br>

          mail: <a href="mailto:contact@artistrooms.fr">contact@artistrooms.fr</a><br>
          Tél: 0170226631
        </p>

        <p>Suivez-nous !</p>

        <div class="social-icons">
          <a href="https://www.instagram.com/artist.rooms/" target="_blank" rel="noopener">
            <img src="images/instagram.png" alt="Instagram">
          </a>
          <a href="https://www.facebook.com/" target="_blank" rel="noopener">
            <img src="images/facebook.png" alt="Facebook">
          </a>
          <a href="https://www.linkedin.com/" target="_blank" rel="noopener">
            <img src="images/linkedin.png" alt="LinkedIn">
          </a>
        </div>
      </div>

      <!-- 右侧表单 -->
      <div class="contact-form-box">
        <h2>Envoyez-nous un message</h2>

        <form method="post" action="contact.php">

          <!-- 必填字段：电子邮箱 -->
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" required>

          <!-- 必填字段：留言内容 -->
          <label for="message">Message</label>
          <textarea id="message" name="message" required></textarea>

          <button type="submit">Envoyer</button>

        </form>
      </div>

    </section>

  </main>

  <!-- footer -->
  <footer class="footer-homepage">

    <div class="footer-top">

      <div class="footer-logo">
        <img src="images/logo.jpg" alt="Logo Artist Rooms">
      </div>

      <div class="footer-info">
        <p>ARTIST ROOMS PARIS</p>
        <p>Paris, France</p>
      </div>

      <div class="footer-contact">
        <p><strong>57 RUE AU MAIRE, 75003 PARIS</strong></p>
        <p>0170226631</p>
        <p>contact@artistrooms.fr</p>
      </div>

      <div class="social-icons">
        <a href="https://www.instagram.com/artist.rooms/" target="_blank" rel="noopener">
          <img src="images/instagram.png" alt="Instagram">
        </a>
        <a href="https://www.facebook.com/" target="_blank" rel="noopener">
          <img src="images/facebook.png" alt="Facebook">
        </a>
        <a href="https://www.linkedin.com/" target="_blank" rel="noopener">
          <img src="images/linkedin.png" alt="LinkedIn">
        </a>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© 2026 Artist Rooms Paris</p>
      <a href="mentions-legales.html">Mentions légales</a>
    </div>

  </footer>

  <script src="script.js"></script>
</body>
</html>