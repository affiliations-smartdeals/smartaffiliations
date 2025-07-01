<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    if (!empty($email)) {
        $db = new SQLite3("newsletter.db");

        // Créer la table si elle n'existe pas
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
    }

    // Redirection après l'inscription
    header("Location: merci.html");
    exit;
}
?>
