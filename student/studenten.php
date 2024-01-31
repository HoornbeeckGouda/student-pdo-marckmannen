<?php
include 'inc/header.php';

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
// gegevens query ophalen uit db student
//$result = mysqli_query($dbconn, $qry_student);

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
//if ($count_records>0) { // wel studenten ophalen
//    while ($row=mysqli_fetch_array($result)) {
//        $contentTable .= "<tr>
//                            <td>" . $row['id'] . "</td>
//                            <td>" . $row['voornaam'] . "</td>
//                            <td>" . $row['tussenvoegsel'] . "</td>
//                            <td>" . $row['achternaam'] . "</td>
//                            <td>" . $row['straat'] . "</td>
//                            <td>" . $row['postcode'] . "</td>
//                            <td>" . $row['woonplaats'] . "</td>
//                            <td>" . $row['email'] . "</td>
//                            <td>" . $row['klas'] . "</td>
//                            <td>" . $row['geboortedatum'] . "</td>
//                        </tr>";
//    }
//}
$table_student = $table_header . $contentTable . "</table>";

echo $table_student;


include 'inc/footer.php'
?>