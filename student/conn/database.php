<?php
//STAP 1 - Initialisatie
define('HOST', 'localhost');
define('DATABASE', 'student');
define('USER', 'docent');
define('PASSWORD','docent');

//connectie maken

try {

    //methode met charset

    $dbconn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8mb4", USER,PASSWORD);

    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch (PDOException $e) {

    echo $e->getMessage();

    echo "verbinding NIET gemaakt<br>";

}

?>