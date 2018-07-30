<?php
require 'funkcijos.php';
head('Priskirti projekta'); 
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];    
    $query = "SELECT * FROM projects WHERE projekto_id = " . $id;
    $result = mysqli_query($connection, $query);
    $pareigosInfo = mysqli_fetch_assoc($result);
    
} else {
    echo 'Klaidos pranesimas';
    exit;
}

$query = "SELECT * FROM darbuotojai LEFT JOIN darbuotojai_projektai ON darbuotojai . id = darbuotojai_projektai . darbuotojo_id ";
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)) {        
        $query = "SELECT * FROM projects WHERE projekto_id = " . $darbuotojas['projekto_id'];
        $row = mysqli_query($connection, $query);
        $priskirtiProjektai = mysqli_fetch_assoc($row);
        
        if (mysqli_num_rows($row) == 0) {
            $priskirtiProjektai = [];
        }        
        $darbuotojas['priskirtiProjektai'] = $priskirtiProjektai;
        
        $darbuotojai[] = $darbuotojas;
        echo '<pre>';
        print_r($darbuotojas);
        echo '</pre>';
    }
}


?>
<div class="col-md-6">
    <h2>Projektu priskirimas</h2>

    <form action="" method="post">
        <input name="id" type="hidden" value="<?php echo $pareigosInfo['id']; ?>">                
         <?php
         if (count($darbuotojai) == 0) {
            echo 'Projektu nera priskirta';
        } else {
            foreach ($darbuotojai as $darbuotojas) {
        ?>
        <div class="form-group">
            <label for="sel1">Projektai</label>
            <select class="form-control" id="sel1">
              <option><?php echo $darbuotojas['priskirtiProjektai']['name']; ?></option>              
            </select>
          </div> 
        <?php }} ?>   
        </div>
        <input type="submit" class="btn btn-primary" value="Išsaugoti">
    </form>
</div>
<?php

mysqli_close($connection);
footer();
?>


