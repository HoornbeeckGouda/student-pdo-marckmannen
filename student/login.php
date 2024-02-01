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
    $query1 = "SELECT id, gebruikersnaam, wachtwoord, functie_id FROM gebruiker WHERE gebruikersnaam = :?; AND wachtwoord = :?";
    $result=$dbconn->prepare($query1);

    $stmt = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt, "ss", $inlognaam, $wachtwoord);
    mysqli_stmt_execute($stmt);
    $uitvoer = mysqli_stmt_get_result($stmt);

    //checken of user bestaat
    $aantal = mysqli_num_rows($uitvoer);
    if ($aantal == 1) {
        // de data fetchen van de uitgevoerde query
        $row = mysqli_fetch_assoc($uitvoer);
        $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
        $_SESSION['functie_id'] = $row['functie_id'];
        $_SESSION['user_id'] = $row['id'];
        header("refresh:0, url=./homepage.php");
    } else {
        echo "<h2 class='foutegegevens'>Helaas! Foute gegevens</h2>";
        session_unset();
    }
}

include 'inc/footer.php';
?>