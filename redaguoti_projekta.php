<?php
require 'funkcijos.php';
head('Projektu redagavimas'); 
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
    $id = $_POST['projekto_id'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $program = $_POST['program'];
    $price = $_POST['price'];
    
    $query = "UPDATE projects SET name = '$name', year = '$year', program = '$program', price = '$price' WHERE projekto_id = $id";
    $result = mysqli_query($connection, $query);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];    
    $query = "SELECT * FROM projects WHERE projekto_id = " . $id;
    $result = mysqli_query($connection, $query);
    $projektoInfo = mysqli_fetch_assoc($result);
    //print_r($projektoInfo);
} else {
    echo 'Klaidos pranesimas';
    exit;
}
?>
<div class="col-md-6">
    <h2>Pareigų redagavimas:</h2>

    <form action="" method="post">
        <input name="id" type="hidden" value="<?php echo $projektoInfo['projekto_id']; ?>">
        <div class="form-group">
            <label>Pavadinimas</label>
            <input name="name" type="text" class="form-control" value="<?php echo $projektoInfo['name']; ?>">
        </div>
        <div class="form-group">
            <label>Metai</label>
            <input name="year" type="text" class="form-control"  value="<?php echo $projektoInfo['year']; ?>">
        </div>
        <div class="form-group">
            <label>Programa</label>
            <input name="pragram" type="text" class="form-control" value="<?php echo $projektoInfo['program']; ?>">
        </div>
        <div class="form-group">
            <label>Kaina, Eur</label>
            <input name="price" type="text" class="form-control" value="<?php echo $projektoInfo['price']; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Išsaugoti">
    </form>
</div>

<?php footer(); ?>


