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
// inlogvariables toekennen
if (isset($_POST['submit'])) {
    $inlognaam = strtolower($_POST['inloggen']);
    $wachtwoord = $_POST['password'];

    // checken of inloggegevens kloppen
    $query1 = "SELECT id, gebruikersnaam, wachtwoord, id FROM gebruiker WHERE gebruikersnaam = :user AND wachtwoord = :ww";
    $result=$dbconn->prepare($query1);

    $result->bindParam(':ww',$ww);
    $ww=$wachtwoord;

    $result->bindParam(':user',$user);
    $user=$inlognaam;


    try {

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);

        //checken of user bestaat
        if ($result->rowCount()==1) {

            $_SESSION['gebruikersnaam'] = $result->fetchColumn(2);
            $_SESSION['user_id'] = $result->fetchColumn(1);
            header("refresh:0, url=./studenten.php");
        }
         else {
            echo "<script>"<h2 class='foutegegevens'>Helaas! Foute gegevens</h2>"</script>";
            session_unset();
        }
    }

    catch (PDOException $e) {

        echo "foutje: " . $e->getMessage();

        echo "<script>alert('klanten niet gevonden');</script>";

    }


}

include 'inc/footer.php';
?>