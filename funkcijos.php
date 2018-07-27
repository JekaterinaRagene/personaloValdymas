<?php

function head($title)
{
   ?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <title><?php echo $title; ?></title>
    </head>
    <body>
        <main role="main" class="container">
    <?php
}

function footer()
{
    ?>
    </main>      

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}

function pervedimasIEurus($a)
{
  round($a / 100, 2);
}

function prisijungimas()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "projektas1";

    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $database);
    //mysqli_ser_charset($connection, 'UTF8');
    mysqli_set_charset($connection, "utf8");
    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
}

function isjungimasDombaze()
{
    mysqli_close($connection);
}

function menu()
{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">
                   Pagrindinis
                </a>
                <a class="nav-item nav-link active" href="darbuotojai_pareigos.php">
                   Įmonės statistika
                </a>
                <a class="nav-item nav-link" href="darbuotojai_statistika.php">
                    Darbuotojų statistika
                </a>
                <a class="nav-item nav-link" href="darbuotojas_prideti.php">
                    Pridėti nauja darbuotoją
                </a>
                <a class="nav-item nav-link" href="pareigos_prideti.php">
                    Pridėti naują pareigą
                </a>   
                <a class="nav-item nav-link" href="prideti_projekta.php">
                    Pridėti naują projekta
                </a> 
            </div>
        </div>
    </nav>
    <?php
}


