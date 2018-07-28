<?php
include 'funkcijos.php';
head('Darbuotojai pagal pareigas'); 
menu();

$servername = "localhost";
$username = "root";
$password = "";
$database = "projektas1";

$connection = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($connection, "utf8");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $id = $_POST['id'];
    $query = "DELETE FROM darbuotojai WHERE id = '$id'";
    $result2 = mysqli_query($connection, $query);
}
$query = "SELECT * FROM darbuotojai";
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)) {        
        $query = "SELECT * FROM pareigos WHERE id = " . $darbuotojas['pareigu_id'];
        $row = mysqli_query($connection, $query);
        $pareigos = mysqli_fetch_assoc($row);
        
        if (mysqli_num_rows($row) == 0) {
            $pareigos = [];
        }        
        $darbuotojas['pareigos'] = $pareigos;
        
        $darbuotojai[] = $darbuotojas;
//        echo '<pre>';
//        print_r($darbuotojas);
//        echo '</pre>';
    }
}

mysqli_close($connection);
?>
<h2>Darbuotojų sąrašas:</h2>
<?php
if(count($darbuotojai) == 0) {
    echo 'Tokiu darbuotoju nera';
} else {
    foreach ($darbuotojai as $darbuotojas) {
?>
<div class="col-md-12">    
    <h1>Darbuotojai pagal pareigas: <b><?php echo $darbuotojas['pareigos']['name']; ?></b></h1>
</div>
<div class="col-md-12">    
        <table class="table">
        <tr>
            <th></th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Tel. nr.</th>
            <th>Išsilavinimas</th>
            <th>Alga, Eur</th>
            <th></th>
        </tr>        
         <tr>
            <td><strong><?php echo $darbuotojas['id'];?></strong></td>
            <td><?php echo $darbuotojas['name'];?></td>
            <td><?php echo $darbuotojas['surname'];?></td>
            <td><?php echo $darbuotojas['phone'];?></td>
            <td><?php echo $darbuotojas['education'];?></td>
            <td><?php echo round($darbuotojas['salary'] / 100, 2); ?></td>
            <td><a href="darbuotojas.php?id=<?php echo $darbuotojas['id'];?>" class="btn btn-primary">Plačiau</a></td>
            <td><a href="darbuotojas_redaguoti.php?id=<?php echo $darbuotojas['id']; ?>" class="btn btn-warning">Redaguoti</a></td>
            <td><form method="post">
            <input type="hidden" name="id" value="<?php echo $darbuotojas['id']; ?>">
            <input type="submit" class="btn btn-danger" value="Trinti" name="delete">
                </form>
            </td>
            <td><a href="priskirti_projekta.php?id=<?php echo $darbuotojas['id'];?>" class="btn btn-primary">Priskirti projekta</a></td>
        </tr>            
        </table>  
</div>

<?php
}
}
require 'darbuotojai_pareigos.php';
require 'projektai.php';
footer();
?>