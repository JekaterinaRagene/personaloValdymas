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

function darbuot()
{
    $servername = "localhost";
$username = "root";
$password = "";
$database = 'projektas1';

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);
//mysqli_ser_charset($connection, 'UTF8');
mysqli_set_charset($connection, "utf8");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM darbuotojai";
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)){
        $darbuotojai[] = $darbuotojas;
        $query = "SELECT * FROM pareigos WHERE id = " . $darbuotojas['pareigu_id'];
        $result = mysqli_query($connection, $query);
        $pareiguPavadinimas = mysqli_fetch_assoc($result);    
        //print_r($pareiguPavadinimas);       
    }
} 

$query = "SELECT * FROM pareigos";
$result = mysqli_query($connection, $query);
$pareigos = [];
if (mysqli_num_rows($result) > 0) {
    while ($pareiga = mysqli_fetch_assoc($result)) {
        $pareigos[] = $pareiga;
        $qury = "SELECT * FROM darbuotojai WHERE pereigu_id =" . $pareiga['base_salary'];
        $result = mysqli_query($connection, $query);
        $baseSalary = mysqli_fetch_assoc($result);
       //print_r($baseSalary);
       break;//jeigu nuimti break tada krauna begalybe 
    }
}

}



