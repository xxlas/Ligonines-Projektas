<?php

session_start();
require_once('Database.php');
require_once('Registration.php');
$conn = Database::getConnection();
$reg = new Registration($conn);
$regId = $_POST['registrationId'];
$specId = $_SESSION['specialistId'];
if (isset($specId) && isset($regId) && $reg->doesRegBelongToSpecialist($specId, $regId)) {
    $reg->deleteRegistration($regId);
}
header("Location: checkout.php?user=$specId");

