<?php
include 'inc/header.php';
include 'Student.php';
include ('mailen.php');

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./login.php");
    exit();
}
?>


<div class="achterinlog">
    <div class="inlogformulier">
        <h1>Reset wachtwoord</h1>
        <form method="POST">
            <input type="text" name="gebruikersnaam" size="25" class="gebruikersnaam" placeholder="Gebruikersnaam"><br>
            <input type="email" name="email" size="25" class="email" placeholder="Email"><br>
            <input type="submit" name="submit" class="loggin" value="Stuur email">
        </form>
    </div>
</div>


<?php
if (isset($_POST['submit'])) {
    $gebruikersnaam = strtolower($_POST['gebruikersnaam']);
    $email = $_POST['email'];
    $token  = bin2hex(random_bytes(32));
    $student = new Student($dbconn);
    $student->updateToken($gebruikersnaam, $token);

    $onderwerp = "Reset wachtwoord studenten applicatie";
    $bericht = "Geachte $gebruikersnaam, hierbij de link om uw wachtwoord te resetten: http://localhost/student-pdo-marckmannen/student/newpassword.php?token=$token&user=$gebruikersnaam";
    mailen($email, $gebruikersnaam, $onderwerp, $bericht );
}

include 'inc/footer.php'
?>