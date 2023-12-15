<?php

require_once 'jongeren.php';

if (isset($_POST["submit"]) == "POST")
{
    Jongere::processForm($pdo, $_POST);
}

header("Location: ../../jongeren.php");
exit();
?>