<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($email !== "" && $message !== "") {
        $to = "contact@artistrooms.fr";
        $subject = "Message depuis le site Artist Rooms";

        $body = "E-mail : " . $email . "\n\n";
        $body .= "Message :\n" . $message;

        $mailto = "mailto:" . $to
            . "?subject=" . rawurlencode($subject)
            . "&body=" . rawurlencode($body);

        header("Location: " . $mailto);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact - Artist Rooms Paris</title>
  <link rel="stylesheet" href="main.css">
</head>

<body class="homepage">

  <!-- 顶部菜单 -->
  <header class="topbar">
    <a class="brand" href="index-en.html">
      <img class="brand-logo" src="images/logo.jpg" alt="Logo Artist Rooms">
    </a>

        <button class="menu-btn" aria-label="Toggle navigation menu">☰</button>

    <nav class="topnav">
      <a href="index-en.html">Home</a>
      <a href="galeries-en.html">Galleries</a>
      <a href="artistes-en.php">Artists</a>
      <a href="contact-en.php">Contact</a>
    </nav>

    <div class="lang">
      <a href="contact.php" class="lang-btn">Fr</a>
    </div>
  </header>

  <!-- 主体 -->
  <main class="contact-main">
    <h1>Contact</h1>

    <section class="contact-section">

      <!-- 左侧信息 -->
      <div class="contact-info">
        <h2>Contact us</h2>

        <p>
          <strong>57 RUE AU MAIRE</strong><br>
          PARIS, 75003<br>
          France<br><br>

          Email: <a href="mailto:contact@artistrooms.fr">contact@artistrooms.fr</a><br>
          Tel: 0170226631
        </p>

        <p>Follow us!</p>

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
        <h2>Send us a message</h2>

        <form method="post" action="contact-en.php">

          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" required>

          <label for="message">Message</label>
          <textarea id="message" name="message" required></textarea>

          <button type="submit">Send</button>

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
      <a href="mentions-legales-en.html">Legal notice</a>
    </div>

  </footer>

  <script src="script.js"></script>
</body>
</html>