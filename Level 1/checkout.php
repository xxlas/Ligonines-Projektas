<?php
session_start();
require_once('Database.php');
require_once('Registration.php');
require_once('Client.php');


$specialistId = $_SESSION['specialistId'];

if (!isset($specialistId) || $specialistId != $_GET['user']) {
    header('Location: signin.php');
}


$conn = Database::getConnection();
$reg = new Registration($conn);

$regList = $reg->getRegistrationsByUser($specialistId);
$client = new Client($conn);
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">
    <div class="row justify-content-center pt-5">
        <table class="table table-sm">
            <thead>
            <tr>
                <th> Kliento Nr.</th>
                <th> Kliento vardas</th>
                <th> Registracijos data</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($regList as $reg) {
                echo '
                        <tr>
                            <td>' . $reg['id'] . '</td>
                            <td>' . $client->getName($reg['client_id']) . '</td>
                            <td>' . $reg['registered_at'] . '</td>
                            <td> 
                                <form action="completeReg.php" method="POST">
                                    <input type="hidden" name="registrationId" value="' . $reg['id'] . '">
                                    <button type="submit" class="btn btn-sm btn-dark"> Baigta </button>
                                </form> 
                            </td>
                        </tr>
                    ';
            } ?>
            </tbody>
        </table>
    </div>
</div>

