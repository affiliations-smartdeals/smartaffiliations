<?php
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
  <meta charset='UTF-8'>
  <title>Inscrits Newsletter – Amazon, Shein, Supersmart | Smartaffiliations</title>
  <meta name='description' content='Consultez la liste des emails inscrits à la newsletter Smartaffiliations. Offres Amazon, Shein, Supersmart, AliExpress.'>
  <meta name='keywords' content='newsletter, email marketing, Amazon, Supersmart, AliExpress, Shein, abonnés newsletter, marketing digital'>
  <meta name='author' content='Smartaffiliations'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      padding: 20px;
    }
    h2 {
      color: #2e7d32;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #4caf50;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
";

try {
    $db = new PDO("sqlite:newsletter.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $db->query("SELECT * FROM emails ORDER BY id DESC");

    echo "<h2>Liste des inscrits à la newsletter</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Email</th><th>Date d'inscription</th></tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "</body></html>";
?>
