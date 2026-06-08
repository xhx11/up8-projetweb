<?php
require 'pdo.php';

$sql = $pdo->query(
    "SELECT id, nom, description_en, image, page_en
     FROM artistes
     ORDER BY id DESC"
);
$artistes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Artistes - Artist Rooms Paris</title>
  <link rel="stylesheet" href="main.css">
</head>

<body class="homepage">

  <!-- 顶部菜单 Barre supérieure -->
  <header class="topbar">
    <a class="brand" href="index-en.html" aria-label="Home Artist Rooms">
      <img class="brand-logo" src="images/logo.jpg" alt="Logo Artist Rooms">
    </a>

        <button class="menu-btn" aria-label="Toggle navigation menu">☰</button>

    <nav class="topnav">
      <a href="index-en.html">Home</a>
      <a href="galeries-en.html">Galleries</a>
      <a href="artistes-en.php">Artists</a>
      <a href="contact-en.php">Contact</a>
    </nav>

    <!-- Language -->
    <div class="lang">
      <a href="artistes.php" class="lang-btn">Fr</a>
    </div>
  </header>


 <!-- Contenu principal -->
<main class="artists-main">
    <h1 class="artists-title">ARTISTS</h1>

  <div class="artists-list">

    <article class="artist-card">
      <img src="images/aurelien-portrait.jpg" alt="Aurélien Baudoin">

      <h2 class="artist-name">Aurélien Baudoin</h2>
      <div class="artist-info">
        <p>Designer</p>
      </div>

      <a class="artist-btn" href="Aurélien-Baudoin-en.html" aria-label="See more about Aurélien Baudoin">See more</a>
    </article>

    <article class="artist-card">
      <img src="images/remi-2.jpg" alt="Rémi Thouzeau">

      <h2 class="artist-name">Rémi Thouzeau</h2>
      <div class="artist-info">
        <p>Painter</p>
      </div>

      <a class="artist-btn" href="remi-thouzeau-en.html" aria-label="See more about Rémi Thouzeau">See more</a>
    </article>


    <?php foreach ($artistes as $artiste): ?>
  <article class="artist-card">

    <img src="<?php echo htmlspecialchars($artiste['image']); ?>"
         alt="Portrait or artwork of <?php echo htmlspecialchars($artiste['nom']); ?>">

    <h2 class="artist-name">
      <?php echo htmlspecialchars($artiste['nom']); ?>
    </h2>

    <div class="artist-info">
      <p>
        <?php echo nl2br(htmlspecialchars($artiste['description_en'])); ?>
      </p>
    </div>

    <a class="artist-btn"
       href="<?php echo htmlspecialchars($artiste['page_en']); ?>"
       aria-label="See more about <?php echo htmlspecialchars($artiste['nom']); ?>">
      See more
    </a>

  </article>
<?php endforeach; ?>

  </div>

</main>


  <!-- Pied de page -->
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
      <a href="mentions-legales.html">Legal Notices</a>
    </div>

  </footer>

  <script src="script.js"></script>
</body>
</html>