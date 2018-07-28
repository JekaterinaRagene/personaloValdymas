<?php
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

if (isset($_POST['istrintiProjekta']) && isset($_POST['id'])) {      
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    //$id = $_POST['projekto_id'];
    $query = "DELETE FROM projects WHERE projekto_id = " .$id;
    $result = mysqli_query($connection, $query);
}
?>

<div class="col-md-6">
    <h2>Projektu sarašas:</h2>

    <table class="table">
        <tr>
            <th>Projekto Nr.</th>
            <th>Pavadinimas</th>
            <th>Metai</th>
            <th>Programa</th>
            <th>Kaina, Eur</th>            
            <th></th>
        </tr>
        <?php        
        $query = "SELECT * FROM projects";
        $result = mysqli_query($connection, $query);
        $projektas = [];
        if (mysqli_num_rows($result) > 0) {
            while ($projektai = mysqli_fetch_assoc($result)) {
                $query = "SELECT * FROM projektai";
                $result2 = mysqli_query($connection, $query);               
                $projektas = $projektai;
                //print_r($projektai);
        ?>
        <tr>
            <td><?php echo $projektai['projekto_id']; ?></td>
            <td><?php echo $projektai['name'];?></td>
            <td><?php echo $projektai['year'];?></td>  
            <td><?php echo $projektai['program'];?></td>
            <td><?php echo round($projektai['price'] /100, 2);?></td>
            <td><a href="darbuotojas.php?id=<?php echo $darbuotojas['id']; ?>" class="btn btn-primary">Rodyti projektus</a></td>
            <td><a href="redaguoti_projekta.php?id=<?php echo $projektai['projekto_id']; ?>" class="btn btn-warning">Redaguoti</a></td>
            <td><form method="post">
            <input type="hidden" name="id" value="<?php echo $projektai['projekto_id'];?>">
            <input type="submit" class="btn btn-danger" value="Trinti" name="istrintiProjekta">
                </form>
            </td>
        </tr> 
        <?php
        }}
        ?>
      </table>
</div>


