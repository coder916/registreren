<?php
session_start();

if(!empty($_SESSION['Gebruikersnaam'])) {
    header('location:index.php');
}

require 'connect.php';

$message = '';

if (isset ($_POST['naam']) && isset($_POST['email']) && isset($_POST['Gebruikersnaam']) && isset($_POST['Wachtwoord']) && isset($_POST['leeftijd']) ){


    $name = $_POST['naam'];
    $email = $_POST['email'];
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
    $leeftijd = $_POST['leeftijd'];

    $passwordHash = password_hash($wachtwoord, PASSWORD_BCRYPT, array("cost" => 12));

    $sql = 'INSERT INTO mensen(naam, email, Gebruikersnaam, Wachtwoord, leeftijd) VALUES(:naam, :email, :gebruikersnaam, :wachtwoord, :leeftijd)';
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':naam', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':gebruikersnaam', $gebruikersnaam);
    $statement->bindValue(':wachtwoord', $passwordHash);
    $statement->bindValue(':leeftijd', $leeftijd);

    $result = $statement->execute();

    if($result){
        //What you do here is up to you!
        $message = 'Thank you for registering with our website.';
        header('location:login.php');
    }

    /*if ($statement->execute([':naam' => $name, ':email' => $email, ':gebruikersnaam' => $gebruikersnaam, ':wachtwoord' => $wachtwoord, ':leeftijd' => $leeftijd])) {

        $message = 'data inserted successfully';
    }*/
}

?>


<!doctype html>

<html lang="en">

<head>

    <title>Registreer</title>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body class="bg-info" style="background: #0c6739!important;">



<div class="container">

    <div class="card mt-5">

        <div class="card-header">

            <h2>Registreer</h2>

        </div>

        <div class="card-body">

            <?php if(!empty($message)): ?>

                <div class="alert alert-success">
                    <?= $message; ?>
                </div>

            <?php endif; ?>

            <form method="post">

                <div class="form-group">

                    <label for="naam">Naam</label>
                    <input type="text" name="naam" id="naam" class="form-control">

                </div>

                <div class="form-group">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">

                </div>

                <div class="form-group">

                    <label for="Gebruikersnaam">Gebruikersnaam</label>
                    <input type="text" name="Gebruikersnaam" id="Gebruikersnaam" class="form-control">

                </div>

                <div class="form-group">

                    <label for="Wachtwoord">Wachtwoord</label>
                    <input type="password" name="Wachtwoord" id="Wachtwoord" class="form-control">

                </div>

                <div class="form-group">

                    <label for="leeftijd">Leeftijd</label>
                    <input type="number" name="leeftijd" id="leeftijd" class="form-control">

                </div>

                <div class="form-group">

                    <button style="background-color: #129221!important" type="submit" class="btn btn-info">Registreer</button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>