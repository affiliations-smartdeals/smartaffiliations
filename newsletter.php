<?php
// Début du script PHP

// Fonction pour afficher la page HTML d’inscription
function afficher_formulaire() {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Inscription Newsletter | Smartaffiliations</title>

      <!-- SEO -->
      <meta name="description" content="Inscrivez-vous à la newsletter Smartaffiliations pour recevoir les meilleures offres et nouveautés des grandes marques comme Amazon, Zara, Nike, H&M, AliExpress et plus." />
      <meta name="keywords" content="newsletter, inscription, affiliation, deals, promotions, Amazon, Zara, Nike, H&M, AliExpress, mode, e-commerce" />
      <meta name="robots" content="index, follow" />
      <meta name="author" content="Smartaffiliations" />

      <!-- Open Graph / Facebook -->
      <meta property="og:type" content="website" />
      <meta property="og:title" content="Inscription Newsletter | Smartaffiliations" />
      <meta property="og:description" content="Recevez les meilleures offres et nouveautés des grandes marques grâce à la newsletter Smartaffiliations." />
      <meta property="og:image" content="https://cdn.pixabay.com/photo/affiliate-marketing-7147115_1280.png" />
      <meta property="og:url" content="https://github.com/affiliations-smartdeals/newsletter.php" />
      <meta property="og:site_name" content="Smartaffiliations" />

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="Inscription Newsletter | Smartaffiliations" />
      <meta name="twitter:description" content="Recevez les meilleures offres et nouveautés des grandes marques grâce à la newsletter Smartaffiliations." />
      <meta name="twitter:image" content="https://cdn.pixabay.com/photo/affiliate-marketing-7147115_1280.png" />

      <link rel="stylesheet" href="style.css" />
    </head>
    <body>
      <header>
        <h1>Smartaffiliations - Newsletter</h1>
      </header>

      <main>
        <section style="text-align: center; padding: 2rem;">
          <h2>Inscris-toi à notre newsletter !</h2>

          <form action="" method="POST" novalidate>
            <input
              type="email"
              name="email"
              placeholder="Votre adresse email"
              required
              style="padding: 0.5rem 1rem; margin: 1rem;"
              aria-label="Adresse email"
            />
            <br />
            <button type="submit" style="padding: 0.5rem 1rem;">S'inscrire</button>
          </form>
        </section>
      </main>

      <footer>
        <p>&copy; 2025 Smartaffiliations. Tous droits réservés.</p>
      </footer>
    </body>
    </html>
    <?php
}

// Fonction pour afficher la page de remerciement
function afficher_remerciement() {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Merci pour votre inscription | Affiliations SmartDeals</title>

      <meta name="description" content="Merci pour votre inscription à la newsletter Affiliations SmartDeals. Recevez les meilleures offres et promotions des marques comme Amazon, Nike, Zara, H&M, AliExpress, et plus encore !" />
      <meta name="keywords" content="newsletter, inscription, affiliation, promotions, offres, Amazon, Nike, Zara, H&M, AliExpress" />
      <meta name="robots" content="index, follow" />

      <!-- Open Graph -->
      <meta property="og:title" content="Merci pour votre inscription | Affiliations SmartDeals" />
      <meta property="og:description" content="Recevez les meilleures offres et promotions grâce à la newsletter Affiliations SmartDeals." />
      <meta property="og:image" content="https://cdn.pixabay.com/photo/affiliate-marketing-7147115_1280.png" />
      <meta property="og:url" content="https://github.com/affiliations-smartdeals/newsletter.php" />
      <meta property="og:site_name" content="Affiliations SmartDeals" />

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="Merci pour votre inscription | Affiliations SmartDeals" />
      <meta name="twitter:description" content="Recevez les meilleures offres et promotions grâce à la newsletter Affiliations SmartDeals." />
      <meta name="twitter:image" content="https://cdn.pixabay.com/photo/affiliate-marketing-7147115_1280.png" />

      <link rel="stylesheet" href="style.css" />
    </head>
    <body>
      <header>
        <h1>Merci pour votre inscription !</h1>
      </header>

      <main>
        <p style="text-align:center; padding: 2rem;">
          Votre adresse email a bien été enregistrée. À bientôt pour les meilleures offres des grandes marques comme Amazon, Nike, Zara, H&M, AliExpress et bien plus encore !
        </p>
        <p style="text-align:center;">
          <a href="newsletter.php">Retour à l'inscription</a>
        </p>
      </main>
    </body>
    </html>
    <?php
}

// Gestion de la requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $db = new SQLite3("newsletter.db");

        // Création de la table si nécessaire
        $db->exec("CREATE TABLE IF NOT EXISTS emails (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT UNIQUE NOT NULL,
            date TEXT
        )");

        $date = date("Y-m-d H:i:s");

        $stmt = $db->prepare("INSERT OR IGNORE INTO emails (email, date) VALUES (:email, :date)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':date', $date, SQLITE3_TEXT);
        $stmt->execute();

        // Affiche la page de remerciement
        afficher_remerciement();
    } else {
        // Email invalide : réaffiche formulaire avec un message d'erreur simple
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Inscription Newsletter | Smartaffiliations</title>
          <link rel="stylesheet" href="style.css" />
        </head>
        <body>
          <header><h1>Smartaffiliations - Newsletter</h1></header>
          <main>
            <section style="text-align: center; padding: 2rem;">
              <h2>Inscris-toi à notre newsletter !</h2>
              <p style="color: red;">Adresse email invalide, veuillez réessayer.</p>
              <form action="" method="POST" novalidate>
                <input
                  type="email"
                  name="email"
                  placeholder="Votre adresse email"
                  required
                  style="padding: 0.5rem 1rem; margin: 1rem;"
                  aria-label="Adresse email"
                />
                <br />
                <button type="submit" style="padding: 0.5rem 1rem;">S'inscrire</button>
              </form>
            </section>
          </main>
          <footer>
            <p>&copy; 2025 Smartaffiliations. Tous droits réservés.</p>
          </footer>
        </body>
        </html>
        <?php
    }
} else {
    // Affiche le formulaire si GET
    afficher_formulaire();
}
?>
