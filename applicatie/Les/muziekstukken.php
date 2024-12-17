<?php
require_once 'db_connectie.php'

// 1. Ophalen van de data
// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding()
if (isset($_GET('genrenaam'))){
  $genrenaam = $_GET['genrenaam'];
}
else{
  $genrenaam = "jazz";
}

$html = "<h1>" . $genrenaam . "</h1>"

$sql = "SELECT * FROM  stuk WHERE genrenaam = :genrenaam";


function getGenreSelectBox($selection)
{
  global $db

$sql = "SELECT * FROM Genre";
$query = $db->prepare($sql);
$query->execute([]);

$select "<select name='genrenaam'>";
while ($rij = $query->fetch()) {
  $select .= "<option value'";
  $select = .$rij['genrenaam'];
  $select .="";

  if ($rij['genrenaam'] ==  $genrenaam) {
    $select .= " selected";
  }
  $select .=">";
  $select = .$rij['genrenaam'];
  $select .= "</option>";
}

    // Toevoegen: geef het geselecteerde genre `selected`

$select .= "</select>";
$select .= "<imput type = 'submit' value ='Verstuur'>";
$select .= "</form>";

return $select;
}


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
  <?= getGenreSelectBox ($db, $genrenaam) ;?>
</body>
</html>
