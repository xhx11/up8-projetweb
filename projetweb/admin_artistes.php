<?php
session_start();
require 'pdo.php';

/* 未登录不能进入后台 */
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit;
}

$message = "";
$erreur = "";

/* 删除艺术家 */
if (isset($_GET["delete"])) {
    $id = (int) $_GET["delete"];

    if ($id > 0) {
        $sql = $pdo->prepare("DELETE FROM artistes WHERE id = ?");
        $sql->execute([$id]);
        $message = "Artiste supprimé avec succès.";
    }
}

/* 添加艺术家 */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $description_en = trim($_POST["description_en"] ?? "");
    $page = trim($_POST["page"] ?? "");
    $page_en = trim($_POST["page_en"] ?? "");

    if ($nom === "" || $description === "" || $description_en === "" || $page === "" || $page_en === "") {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $erreur = "Veuillez ajouter une image.";
    } else {

        $uploadDir = __DIR__ . "/uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp = $_FILES["image"]["tmp_name"];
        $fileName = basename($_FILES["image"]["name"]);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ["jpg", "jpeg", "png", "webp", "gif"];

        if (!in_array($fileExtension, $allowedExtensions)) {
            $erreur = "Format d’image non autorisé. Utilisez jpg, jpeg, png, webp ou gif.";
        } else {

            $newFileName = time() . "_" . uniqid() . "." . $fileExtension;

            $imagePathServer = $uploadDir . $newFileName;
            $imagePathDb = "uploads/" . $newFileName;

            if (move_uploaded_file($fileTmp, $imagePathServer)) {
                $sql = $pdo->prepare(
                    "INSERT INTO artistes (nom, description, description_en, image, page, page_en)
                     VALUES (?, ?, ?, ?, ?, ?)"
                );
                $sql->execute([
                    $nom,
                    $description,
                    $description_en,
                    $imagePathDb,
                    $page,
                    $page_en
                ]);

                $message = "Artiste ajouté avec succès.";
            } else {
                $erreur = "Erreur lors du téléchargement de l’image. Vérifiez les droits du dossier uploads.";
            }
        }
    }
}

/* Récupérer les artistes */
$sql = $pdo->query(
    "SELECT id, nom, description, description_en, image, page, page_en
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
  <title>Gestion des artistes — Artist Rooms Paris</title>
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
    <h1>Gestion des artistes</h1>
    <p class="contact-intro">
      Cette interface permet d’ajouter ou de supprimer les artistes affichés sur le site.
    </p>
  </section>

  <div class="contact">
    <form class="contact-body" method="post" action="admin_artistes.php" enctype="multipart/form-data">

      <?php if ($message): ?>
        <div class="form-success">
          <?php echo htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>

      <?php if ($erreur): ?>
        <div class="form-error">
          <?php echo htmlspecialchars($erreur); ?>
        </div>
      <?php endif; ?>

      <label>
        Nom de l’artiste <span class="required">(obligatoire)</span>
        <input type="text" name="nom" required>
      </label>

      <label>
        Description française <span class="required">(obligatoire)</span>
        <textarea name="description" rows="5" required></textarea>
      </label>

      <label>
        Description anglaise <span class="required">(obligatoire)</span>
        <textarea name="description_en" rows="5" required></textarea>
      </label>

      <label>
        Lien de la page “Voir plus” FR <span class="required">(obligatoire)</span>
        <input type="text" name="page" required placeholder="Pierre-Dupont.html">
      </label>

      <label>
        Lien de la page “Voir plus” EN <span class="required">(obligatoire)</span>
        <input type="text" name="page_en" required placeholder="Pierre-Dupont-en.html">
      </label>

      <label>
        Image de l’artiste <span class="required">(obligatoire)</span>
        <input type="file" name="image" accept="image/*" required>
      </label>

      <button type="submit" class="btn-submit">
        Ajouter l’artiste
      </button>

    </form>
  </div>

  <section class="contact-hero">
    <h2>Artistes enregistrés</h2>
  </section>

  <div class="contact">
    <div class="contact-body">

      <?php if (empty($artistes)): ?>
        <p>Aucun artiste enregistré pour le moment.</p>
      <?php else: ?>

        <?php foreach ($artistes as $artiste): ?>
          <div class="admin-artist-card">

            <img src="<?php echo htmlspecialchars($artiste["image"]); ?>"
                 alt="Image de <?php echo htmlspecialchars($artiste["nom"]); ?>"
                 style="max-width: 180px; height: auto; display: block; margin-bottom: 15px;">

            <h3><?php echo htmlspecialchars($artiste["nom"]); ?></h3>

            <p>
              <strong>Description FR :</strong><br>
              <?php echo nl2br(htmlspecialchars($artiste["description"])); ?>
            </p>

            <p>
              <strong>Description EN :</strong><br>
              <?php echo nl2br(htmlspecialchars($artiste["description_en"])); ?>
            </p>

            <p>
              <strong>Page Voir plus FR :</strong>
              <?php echo htmlspecialchars($artiste["page"]); ?>
            </p>

            <p>
              <strong>Page Voir plus EN :</strong>
              <?php echo htmlspecialchars($artiste["page_en"]); ?>
            </p>

            <a class="btn-submit"
               href="admin_artistes.php?delete=<?php echo $artiste["id"]; ?>"
               onclick="return confirm('Voulez-vous vraiment supprimer cet artiste ?');">
              Supprimer
            </a>

          </div>
        <?php endforeach; ?>

      <?php endif; ?>

    </div>
  </div>

</main>

<footer class="footer">
  <p>© 2026 Artist Rooms Paris</p>
</footer>

</body>
</html>