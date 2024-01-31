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
include 'inc/footer.php';
?>