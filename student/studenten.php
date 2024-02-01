<?php
include 'inc/header.php';
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./login.php");
    exit();
}
if(!isset($_SESSION['verify'])) header("refresh:0, url=./login.php");
// initialiseren/declareren
$contentTable = "";
//tabelkop samenstellen
$table_header = '<table id="students">
                    <tr>
                        <th>studentnr</th>
                        <th>voornaam</th>
                        <th>tussenvoegsel</th>
                        <th>achternaam</th>
                        <th>straat</th>
                        <th>postcode</th>
                        <th>woonplaats</th>
                        <th>email</th>
                        <th>klas</th>
                        <th>geboortedatum</th>
                    </tr>';
$qry_student = "SELECT 
                        id, 
                        voornaam, 
                        tussenvoegsel, 
                        achternaam,
                        straat,
                        postcode,
                        woonplaats,
                        email,
                        klas,
                        geboortedatum
                        FROM student
                        ORDER BY achternaam, voornaam;";

// gegevens ophalen met pdo
$result=$dbconn->prepare($qry_student);

try {
    $result->execute();
    $result->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($result as $row)
        {
                    $contentTable .= "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['voornaam'] . "</td>
                            <td>" . $row['tussenvoegsel'] . "</td>
                            <td>" . $row['achternaam'] . "</td>
                            <td>" . $row['straat'] . "</td>
                            <td>" . $row['postcode'] . "</td>
                            <td>" . $row['woonplaats'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['klas'] . "</td>
                            <td>" . $row['geboortedatum'] . "</td>
                        </tr>";
        }


}
catch (PDOException $e)
{
    echo "foutje: ". $e->getMessage();

    echo "<script>alert('studenten niet gevonden');</script>";
}
$table_student = $table_header . $contentTable . "</table>";

echo $table_student;
echo '<h1 class="hallo">Hallo ' . $_SESSION['gebruikersnaam'] . '!</h1>';
echo '<form action="?logout" method="post">';
echo '<button type="submit" class="btn"><h2>logout</h2></button>';
echo '</form>';
include 'inc/footer.php'
?>