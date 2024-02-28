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

$user = $_GET['user'];
$token = $_GET['token'];
$student = new Student($dbconn);
if (!$student->tokenChecker($user, $token)) {
    echo "<script>alert('Tokens komen niet overeen')</script>";
}

?>


    <div class="achterinlog">
        <div class="inlogformulier">
            <h1>Verander wachtwoord</h1>
            <form method="POST">
                <input type="text" name="wachtwoord" size="25" class="wachtwoord" placeholder="Nieuw wachtwoord"><br>
                <input type="submit" name="submit" class="loggin" value="Verander wachtwoord">
            </form>
        </div>
    </div>


<?php
if (isset($_POST['submit'])) {
    $password = $_POST['wachtwoord'];
    $newToken  = bin2hex(random_bytes(33));
    $student->editPassword($user, $token, $password);

    $student->updateToken($user, $newToken);
    echo "<script>alert('Wachtwoord gewijzigd')</script>";
    header("Location: ./login.php");

}

include 'inc/footer.php'
?>