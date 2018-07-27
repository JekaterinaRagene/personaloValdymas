<?php
require 'funkcijos.php';
head('Pridėti pareiga'); 
menu();
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

if (isset($_POST['name']) && isset($_POST['year']) && isset($_POST['program']) && isset($_POST['price'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $year = mysqli_real_escape_string($connection, $_POST['year']);
    $program = mysqli_real_escape_string($connection, $_POST['program']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $query = "INSERT INTO projects (name, year, program, price) VALUES ('$name', '$year', '$program', '$price')";
    
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        echo "Klaida";
    }
}
?>
<?php head('Projekto pridėjimas'); ?>

<div class="col-md-12">
    <h2>Naujas projektsa:</h2>

    <form action="" method="post">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Pavadinimas">Pavadinimas</label> 
                <input name="name" type="text" class="form-control" id="pavadinimas" placeholder="Projekto pavadinimas">
            </div>
            <div class="form-group">
                <label for="year">Metai</label> 
                <input name="year" type="text" class="form-control" id="baseSalary" placeholder="Metai">
            </div>
            <div class="form-group">
                <label for="program">Programa</label> 
                <input name="program" type="text" class="form-control" id="baseSalary" placeholder="Programa">
            </div>
            <div class="form-group">
                <label for="price">Kaina</label> 
                <input name="price" type="text" class="form-control" id="baseSalary" placeholder="Kaina">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="Pridėti">
        </div>
    </form>
</div>

<?php footer(); ?>



