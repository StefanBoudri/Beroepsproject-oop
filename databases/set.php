<?php

require_once 'jongeren.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    Jongere::processForm($pdo, $_POST);
}

?>