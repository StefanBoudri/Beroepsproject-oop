<?php

require_once 'jongeren.php';

if (isset($_POST["submit"]) == "POST") {
    $jongere = new Jongere($pdo);

    if (isset($_POST['id'])) {
        $jongere->id = intval($_POST['id']);
    }

    $jongere->firstName = $_POST['firstName'];
    $jongere->lastName = $_POST['lastName'];
    $jongere->birthDate = $_POST['birthDate'];

    $jongere->Save();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $jongere = new Jongere($pdo);
    
    $jongere->id = $id;

    $jongere->Delete();
} 

header("Location: ../../jongeren.php");
exit();
