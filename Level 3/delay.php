<?php

require_once ('Database.php');
require_once ('Registration.php');

$conn = Database::getConnection();
$reg = new Registration($conn);
$url = $_POST['referer'];
$regId = $_POST['registrationId'];

$registration = $reg->getRegistration($regId);
$specId = $registration['specialist_id'];
$position = $reg->getIndexOfClientAtSpecialist($specId, $registration['client_id']);
$regToSwap = $reg->getRegistrationByPlaceInQue($specId, $position+1);

$reg->updateRegistrationDate($registration['id'], $regToSwap['registered_at']);
$reg->updateRegistrationDate($regToSwap['id'], $registration['registered_at']);

header("Location: view.php?url=$url&delayed=1");
