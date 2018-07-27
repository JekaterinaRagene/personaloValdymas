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

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
//    $id = $_POST['id'];
    $query = "DELETE FROM pareigos WHERE id = '$id'";
    $result = mysqli_query($connection, $query);
}
?>

<div class="col-md-6">
    <h2>Baziniai darbo užmokesčiai:</h2>

    <table class="table">
        <tr>
            <th>Pareigos</th>
            <th>Bazinis darbo užmokestis</th>
            <th>Darbuotojų skaičius</th>
            <th></th>
        </tr>
        <?php        
        $query = "SELECT * FROM pareigos";
        $result = mysqli_query($connection, $query);
        $pareigos = [];
        if (mysqli_num_rows($result) > 0) {
            while ($pareiga = mysqli_fetch_assoc($result)) {
                $query = "SELECT COUNT(*) FROM darbuotojai WHERE pareigu_id = " . $pareiga['id'];
                $result2 = mysqli_query($connection, $query);
                
                if (mysqli_num_rows($result2) == 0) {
                    $pareiga['darbuotojuSkaicius'] = 0;
                } else {                    
                    $darbuotojuSkaicius = mysqli_fetch_row($result2);
                    $pareiga['darbuotojuSkaicius'] = $darbuotojuSkaicius[0];
                }

                $pareigos[] = $pareiga;
                ?>
        <tr>
            <td><?php echo $pareiga['name'] ?></td>
            <td><?php echo round($pareiga['base_salary'] /100, 2); ?> Eur</td>
            <td><?php echo ($pareiga['darbuotojuSkaicius']) ?></td>
           
            <td><a href="darbuotojas.php?id=<?php echo $darbuotojas['id']; ?>" class="btn btn-primary">Rodyti darbuotojus</a></td>
            
            <td><a href="pareigos_redaguoti.php?id=<?php echo $pareiga['id'] ?>" class="btn btn-warning">Redaguoti</a></td>
            <td><form method="post">
            <input type="hidden" name="id" value="<?php echo $pareiga['name'];?>">
            <input type="submit" class="btn btn-danger" value="Trinti" name="delete">
                </form>
            </td>
        </tr>
        
        <?php 
                }
        }
                ?>
    </table>
</div>
<?php
footer();
?>


