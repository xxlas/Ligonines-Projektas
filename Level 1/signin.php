<?php
session_start();
require_once('Database.php');
require_once('Login.php');
require_once('Specialist.php');
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && isset($password)) {
    $conn = Database::getConnection();
    $login = new Login($conn);
    $dbPassword = $login->getPassword($username);
    if (password_verify($password, $dbPassword)) {


        $specialist = new Specialist($conn);
        $loginId = $login->getId($username);
        $specialistId = $specialist->getIdFromLoginId($loginId);

        $_SESSION['specialistId'] = $specialistId;
        header("Location: checkout.php?user=$specialistId");
        die();
    }
} else {
    // return error
}
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">
    <div class="row pt-5 justify-content-center">
        <h3> Įveskite prisijungimus </h3>
    </div>
    <form action="signin.php" method="POST">
        <div class="row pt-5">
            <div class="col-md-4 offset-4">
                <label for="username"> Vartotojo vardas </label>
                <input type="text" class="form-control" name="username" placeholder="285748">
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-4 offset-4">
                <label for="password"> Slaptažodis </label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="row pt-5 justify-content-center">
            <button type="submit" class="btn btn-dark btn-lg"> Prisijungti</button>
        </div>
    </form>
</div>