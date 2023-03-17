<?php
include("header.html");
require("config.php");

echo("<h2>Listado de pedidos - consultar</h2>");

try {
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th scope='col'> Id </th>";
    echo "<th scope='col'> Fecha del pedido </th>";
    echo "<th scope='col'> Producto </th>";
    echo "<th scope='col'> unidades </th>";
    echo "<th scope='col'> Eliminar </th>";
    echo "</tr>";
    foreach($conn->query('SELECT * from pedidos') as $row) {
        echo "<tr><td>".$row["id"]."</td>";
        echo "<td>".$row["fecha_pedido"]."</td>";
        echo "<td>".$row["producto"]."</td>";
        echo "<td>".$row["unidades"]."</td>";
        echo '<td><a href="eliminar.php?codigo='.$row["id"].'"><ion-icon name="trash-outline"></ion-icon></a></td></tr>';
    }
    echo "</table>";
    echo("<form method='post'><button type='submit' class='btn btn-primary'>Eliminar definitivamente</button></form>");
    $coon = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $statement = $conn->prepare('DELETE FROM pedidos where id=:id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    header('Location: consultar.php');
    exit();

}



?>
<?php
include("footer.html");
?>
