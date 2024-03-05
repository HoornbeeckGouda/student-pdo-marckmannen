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
            <div class="g-recaptcha" data-sitekey="6LdsnIopAAAAAPVVIovEInNSm8c4RZPJ7sLKUamE"></div>
            <input type="text" name="gebruikersnaam" size="25" class="gebruikersnaam" placeholder="Gebruikersnaam"><br>
            <input type="email" name="email" size="25" class="email" placeholder="Email"><br>
            <input type="submit" name="submit" class="loggin" value="Stuur email">
        </form>
    </div>
</div>


<?php
if (isset($_POST['submit'])) {
    $secretKey = "6LdsnIopAAAAAAgqfChsdDeNJftuP6tRkANVje0I";
    $responseKey = $_POST['g-recaptcha-response'];
//    $userIP= $_SERVER['REMOTE_ADDR'];
    //aanroepen api:
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response = file_get_contents($url);
//    echo $response.'<br>';
    $response = json_decode($response);
    if ($response->success == false) {
        echo "<script>alert('Verification failed!')</script>";
    } else {
        $gebruikersnaam = strtolower($_POST['gebruikersnaam']);
        $email = $_POST['email'];
        $token  = bin2hex(random_bytes(32));
        $student = new Student($dbconn);
        $student->updateToken($gebruikersnaam, $token);
        if($student->checkEmail($gebruikersnaam, $email)) {
            $onderwerp = "Reset wachtwoord studenten applicatie";
            $bericht = "Geachte $gebruikersnaam, hierbij de link om uw wachtwoord te resetten: http://localhost/student-pdo-marckmannen/student/newpassword.php?token=$token&user=$gebruikersnaam";
            mailen($email, $gebruikersnaam, $onderwerp, $bericht );
        } else {
            echo "<script>alert('Gebruikersnaam en email komen niet overeen!')</script>";
        }
    }






}

include 'inc/footer.php'
?>