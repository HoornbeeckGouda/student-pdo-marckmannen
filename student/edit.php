<?php
include 'inc/header.php';
include 'Student.php';
if(!isset($_SESSION['verify']))
    echo "<meta http-equiv='refresh' content='0;url=studenten.php'>";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = isset($_GET["edit_id"]) ? $_GET["edit_id"] : '';
    $student = new Student($dbconn);
    $studentInfo = $student->getStudent($id);
}
if (isset($_POST['submitEdit'])) {
    $id = isset($_GET["edit_id"]) ? $_GET["edit_id"] : '';
    $student = new Student($dbconn);
    $studentInfo = $student->getStudent($id);
    $student->editStudent();
}
foreach ($studentInfo as $info) {


?>
    <div>
        <form action="edit.php" method="POST" class="editForm">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

            <label for="fklantnr">Student ID:</label>
            <input type="text" name="student_id" value="<?php echo $info['id']; ?>"><br>

            <label for="fklantnr">Voornaam:</label>
            <input type="text" name="voornaam" value="<?php echo $info['voornaam']; ?>" id="voornaam"><br>

            <label for="fklantnr">Tussenvoegsel:</label>
            <input type="text" name="tussenvoegsel" value="<?php echo $info['tussenvoegsel']; ?>" id="tussenvoegsel"><br>
            <label for="fklantnr">Achternaam:</label>
            <input type="text" name="achternaam" value="<?php echo $info['achternaam']; ?>" id="achternaam"><br>
            <label for="fklantnr">Straat:</label>
            <input type="text" name="straat" value="<?php echo $info['straat']; ?>" id="straat"><br>
            <label for="fklantnr">Postcode:</label>
            <input type="text" name="postcode" value="<?php echo $info['postcode']; ?>" id="postcode"><br>
            <label for="fklantnr">Woonplaats:</label>
            <input type="text" name="woonplaats" value="<?php echo $info['woonplaats']; ?>" id="woonplaats"><br>
            <label for="fklantnr">Email:</label>
            <input type="email" name="email" value="<?php echo $info['email']; ?>" id="email"><br>
            <label for="fklantnr">Klas:</label>
            <input type="text" name="klas" value="<?php echo $info['klas']; ?>" id="klas"><br>
            <label for="fklantnr">Geboortedatum:</label>
            <input type="date" name="geboortedatum" value="<?php echo $info['geboortedatum']; ?>" id="geboortedatum"><br>
            <input type="submit" name="submitEdit" value="Aanpassen" class="btnDetailSubmit">
        </form>
</div>


<?php
}
include 'inc/footer.php';