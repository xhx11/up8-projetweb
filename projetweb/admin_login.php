<?php
session_start();

$erreur = "";

/* 如果已经登录，直接进入管理页面 */
if (isset($_SESSION["admin"])) {
    header("Location: admin_artistes.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $adminEmail = "xxxx";
    $adminPassword = "xxx";

    if ($email === "" || $password === "") {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif ($email !== $adminEmail || $password !== $adminPassword) {
        $erreur = "Email ou mot de passe incorrect.";
    } else {
        $_SESSION["admin"] = $email;
        header("Location: admin_artistes.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion administrateur — Artist Rooms Paris</title>
  <link rel="stylesheet" href="main.css">
</head>

<body>

<header class="topbar">
  <a class="brand" href="index.html">
    <span class="brand-text">Artist Rooms Paris</span>
  </a>

  <nav class="topnav">
    <a href="index.html">Accueil</a>
    <a href="galeries.html">Galeries</a>
    <a href="artistes.php">Artists</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>

<main class="contact-page">

  <section class="contact-hero">
    <h1>Connexion administrateur</h1>
    <p class="contact-intro">
      Connectez-vous pour accéder à l’espace de gestion des artistes.
    </p>
  </section>

  <div class="contact">
    <form class="contact-body" method="post" action="admin_login.php">

      <?php if ($erreur): ?>
        <div class="form-error">
          <?php echo htmlspecialchars($erreur); ?>
        </div>
      <?php endif; ?>

      <label>
        Email <span class="required">(obligatoire)</span>
        <input type="email" name="email" required
               value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>">
      </label>

      <label>
        Mot de passe <span class="required">(obligatoire)</span>
        <input type="password" name="password" required>
      </label>

      <button type="submit" class="btn-submit">
        Se connecter
      </button>

    </form>
  </div>

</main>

<footer class="footer">
  <p>© 2026 Artist Rooms Paris</p>
</footer>

</body>
</html>