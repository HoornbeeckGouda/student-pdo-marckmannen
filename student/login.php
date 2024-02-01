<?php
include 'inc/header.php';
?>
<div class="achterinlog">
    <div class="inlogformulier">
        <h1>INLOGGEN</h1>
        <form method="POST">
            <input type="text" name="inloggen" size="25" class="gebruikersnaam" placeholder="Gebruikersnaam"><br>
            <input type="password" name="password" size="25" class="wachtwoord" placeholder="Wachtwoord"><br>
            <input type="submit" name="submit" class="loggin" value="Log In">
        </form>
    </div>
</div>

<?php
session_reset();

// inlogvariables toekennen
if (isset($_POST['submit'])) {
    $inlognaam = strtolower($_POST['inloggen']);
    $wachtwoord = $_POST['password'];

    // checken of inloggegevens kloppen
    $query1 = "SELECT id, gebruikersnaam, hashed_wachtwoord, id FROM gebruiker WHERE gebruikersnaam = :user";
    $result = $dbconn->prepare($query1);

    $result->bindParam(':user', $user);
    $user = $inlognaam;

    try {
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        //checken of user bestaat
        if ($result->rowCount() == 1) {
            $row = $result->fetch();
            $hashedPassword = $row['hashed_wachtwoord'];

            // Verify the entered password against the hashed password
            if (password_verify($wachtwoord, $hashedPassword)) {
                $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['verify'] = 'verify';
                header("refresh:0, url=./studenten.php");
            } else {
                echo "<h2  class='loginError'>Helaas! Foute gegevens</h2>";
                session_unset();
            }
        } else {
            echo "<h2  class='loginError'>Helaas! Foute gegevens</h2>";
            session_unset();
        }
    } catch (PDOException $e) {
        echo "foutje: " . $e->getMessage();
        echo "<script>alert('Oeps! Er is iets fout gegaan...');</script>";
    }
}

include 'inc/footer.php';
?>
