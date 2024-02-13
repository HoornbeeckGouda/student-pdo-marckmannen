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

    public function editStudent($id) {

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $student_id = $_POST['id'];
            $voornaam = $_POST['voornaam'];
            $achternaam = $_POST['achternaam'];
            $tussenvoegsel = $_POST['tussenvoegsel'];
            $straat = $_POST['straat'];
            $postcode = $_POST['postcode'];
            $woonplaats = $_POST['woonplaats'];
            $email = $_POST['email'];
            $klas = $_POST['klas'];
            $geboortedatum = $_POST['geboortedatum'];
        }

        $qry_student = "INSERT INTO student
                        (id, voornaam, tussenvoegsel, achternaam, straat, postcode, woonplaats, email, klas, geboortedatum)
                        VALUES (:student_id, :voornaam, :tussenvoegsel, :achternaam, :straat, :postcode, :woonplaats, :email, :klas, :geboortedatum)
                        WHERE id = :selected_id;";
        $qry = $this->dbconn->prepare($qry_student);
        $qry->bindParam(':selected_id', $id);
        $qry->bindParam(':student_id', $student_id);
        $qry->bindParam(':voornaam', $voornaam);
        $qry->bindParam(':tussenvoegsel', $tussenvoegsel);
        $qry->bindParam(':achternaam', $achternaam);
        $qry->bindParam(':straat', $straat);
        $qry->bindParam(':postcode', $postcode);
        $qry->bindParam(':woonplaats', $woonplaats);
        $qry->bindParam(':email', $email);
        $qry->bindParam(':klas', $klas);
        $qry->bindParam(':geboortedatum', $geboortedatum);

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
}