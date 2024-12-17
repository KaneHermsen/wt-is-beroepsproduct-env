<?php
require_once 'db_connectie.php';

// 1. Ophalen van de data
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

// haal alle componisten op en tel het aantal stukken
$query = 'select c.componistId as id, c.naam as naam, count(S.stuknr) as aantal
          from Componist C left outer join Stuk S on C.componistId = S.componistId
          group by C.componistId, C.naam
          order by naam';
// voer de query uit op de database
$data = $db->query($query);

// 2. Renderen van de data
// Begin van de "table"
$componisten_table = '<table>';
// De "table heads"
$componisten_table = $componisten_table . '<tr><th>Id</th><th>Naam</th><th>Aantal stukken</th></tr>';

// Elke rij als een "table row"
foreach($data as $rij) {
  $id = $rij['id'];
  $naam = $rij['naam'];
  $aantal = $rij['aantal'];
  $componisten_table = $componisten_table . "<tr><td>$id</td><td>$naam</td><td>$aantal</td></tr>";
}

// Eind van de "table"
$componisten_table = $componisten_table . "</table>";

?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Componisten stukken</title>
</head>
<body>
  <h1>Componisten met aantal geschreven stukken</h1>
  <!-- 3. Weergeven van de data -->
  <?= $componisten_table ?>
</body>
</html>
