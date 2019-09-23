<?php
require_once('Database.php');
require_once('Client.php');
require_once('Registration.php');
require_once('Specialist.php');

$conn = Database::getConnection();

if (isset($_POST['name']) && isset($_POST['spec_id'])) {
    $client = new Client($conn);
    $clientId = $client->addClient($_POST['name']);
    $reg = new Registration($conn);
    $url = $reg->addRegistration($clientId, $_POST['spec_id']);
    header("Location: view.php?url=$url");
    die();
}

$spec = new Specialist($conn);
$specList = $spec->getSpecialistList();
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="container">
    <form action="register.php" method="POST">
        <div class="row justify-content-center pt-5">
            <div class="col-md-4">
                <label for="name-fld"> Įveskite vardą </label>
                <input type="text" class="form-control" id="name-fld" name="name">
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <div class="col-md-4">
                <label for="name-fld"> Pasirinkite specialistą </label>
                <select class="form-control" id="spec-fld" name="spec_id">
                    <?php foreach ($specList as $specialist) {
                        echo '<option value="' . $specialist['id'] . '">' . $specialist['name'] . ' </option>';
                    } ?>
                </select>
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <button type="submit" class="btn btn-dark"> Registruotis</button>
        </div>
    </form>
</div>

