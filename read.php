<?php
// Maak een verbiendeing met mysql-server en database
require('config.php');
// Maak een database sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "De verbiending is gelukt";
    } else {
        echo "Interne server-error";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
// Maak een select query die alle records uit de tabel persoon haalt
$sql = "SELECT * FROM DureAuto";
// maak via de sql-query gereed om te worden uitgevoerd op de database
$statement = $pdo->prepare($sql);
// voer de sql-query uit op de database
$statement->execute();
//zet het resultaat in een array met daarin de objecten(records ui de tabel persoon)
$result = $statement->fetchAll(PDO::FETCH_OBJ);
// even checken war we treugkrijgen
// var_dump($result);
$rows = "";
foreach ($result as $info) {
    $rows .= "<tr>
                <td>$info->Merk</td> 
                <td>$info->Model</td>
                <td>$info->Topsnelheid</td>
                <td>$info->Prijs</td>
                <td>
                    <a href='delete.php?Id=$info->Id'>
                        <img src='img/b_drop.png' alt='kruis'>
                    </a>
                </td>
            </tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>De Vijf duurste auto's ter wereld</h1>
    <br>
    <br>
    <table border="1">
        <thead>
            <th>Merk</th>
            <th>Model</th>
            <th>Topsnelheid</th>
            <th>Prijs</th>
            <th>Delete</th>
            <!-- <th></th>
            <th></th> -->
        </thead>
        <tbody>
            <?= $rows; ?>
        </tbody>
    </table>
</body>

</html>