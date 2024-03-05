<?php
class Student {
    public $dbconn;

    public function __construct($dbconn) {
        $this->dbconn = $dbconn;
    }
    public function getStudent($id)
    {
        $qry_student = "SELECT *
                        FROM student
                        WHERE id = :id
                        ORDER BY achternaam, voornaam;";

        $qry = $this->dbconn->prepare($qry_student);
        $qry->bindParam(':id', $id);

        try {
            $qry->execute();

            return $qry->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo "foutje: ". $e->getMessage();

            echo "<script>alert('studenten niet gevonden');</script>";
        }
    }
    public function updateToken($gebruikersnaam, $token) {
        $query1 = "UPDATE GEBRUIKER SET token = :token WHERE gebruikersnaam = :user";
        $result = $this->dbconn->prepare($query1);

        $result->bindParam(':token', $token);
        $result->bindParam(':user', $gebruikersnaam);

        $result->execute();
        return $result;
}
public function tokenChecker($gebruikersnaam, $token) {
    $query1 = "SELECT gebruikersnaam FROM GEBRUIKER WHERE gebruikersnaam = :user AND token = :token";
    $result = $this->dbconn->prepare($query1);

    $result->bindParam(':token', $token);
    $result->bindParam(':user', $gebruikersnaam);
    $result->execute();
    return ($result->rowCount() >= 1);
}

public function checkEmail($gebruikersnaam, $email){
    $query1 = "SELECT email FROM GEBRUIKER WHERE gebruikersnaam = :user AND email = :email";
    $result = $this->dbconn->prepare($query1);

    $result->bindParam(':email', $email);
    $result->bindParam(':user', $gebruikersnaam);
    $result->execute();
    return ($result->rowCount() >= 1);
}

    public function editPassword($gebruikersnaam, $token, $wachtwoord) {
        // Hash the password
        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);

        $query = "UPDATE GEBRUIKER SET hashed_wachtwoord = :wachtwoord WHERE gebruikersnaam = :user AND token = :token";
        $result = $this->dbconn->prepare($query);

        $result->bindParam(':token', $token);
        $result->bindParam(':user', $gebruikersnaam);
        $result->bindParam(':wachtwoord', $hashedPassword);

        $result->execute();
    }

    public function editStudent() {

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $voornaam = $_POST['voornaam'];
            $achternaam = $_POST['achternaam'];
            $tussenvoegsel = $_POST['tussenvoegsel'];
            $straat = $_POST['straat'];
            $postcode = $_POST['postcode'];
            $woonplaats = $_POST['woonplaats'];
            $email = $_POST['email'];
            $klas = $_POST['klas'];
            $geboortedatum = $_POST['geboortedatum'];
            $id = $_POST['id'];

        }

        $qry_student = "
                        UPDATE student
                        SET voornaam = :voornaam,
                            tussenvoegsel = :tussenvoegsel,
                            achternaam = :achternaam,
                            straat = :straat,
                            postcode = :postcode,
                            woonplaats = :woonplaats,
                            email = :email,
                            klas = :klas,
                            geboortedatum = :geboortedatum,
                            id = :id
                        WHERE id = :selected_id;";
        $qry = $this->dbconn->prepare($qry_student);
        $qry->bindParam(':selected_id', $id);
        $qry->bindParam(':voornaam', $voornaam);
        $qry->bindParam(':tussenvoegsel', $tussenvoegsel);
        $qry->bindParam(':achternaam', $achternaam);
        $qry->bindParam(':straat', $straat);
        $qry->bindParam(':postcode', $postcode);
        $qry->bindParam(':woonplaats', $woonplaats);
        $qry->bindParam(':email', $email);
        $qry->bindParam(':klas', $klas);
        $qry->bindParam(':id', $id);
        $qry->bindParam(':geboortedatum', $geboortedatum);

        try {
            $qry->execute();
            if ($qry->rowCount() > 0) {
                echo "<script>alert('Aanpassen van studentgegevens gelukt!');</script>";
                echo "<meta http-equiv='refresh' content='0;url=studenten.php'>";
            } else {
                echo "<script>alert('Geen gegevens gewijzigd.');</script>";
                echo "<meta http-equiv='refresh' content='0;url=studenten.php'>";
            }
        }
        catch (PDOException $e)
        {
            echo "foutje: ". $e->getMessage();

            echo "<script>alert('Aanpassen van studentgegevens gefaald!');</script>";
            echo "<meta http-equiv='refresh' content='0;url=studenten.php'>";
        }

    }
}