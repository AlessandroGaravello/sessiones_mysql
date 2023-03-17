<?php
include("header.html");
require("config.php");
echo "<h2>Eliminar</h2>";
if (isset($_GET["codigo"]) == TRUE){
    try {
        foreach($conn->query('SELECT * from pedidos where id='.$_GET["codigo"].'') as $row) {
           echo("<div class='card' style='width: 18rem;'>");
           echo("<div class='card-body'>");
           echo("<h5 class='card-title'>".$row['producto']."</h5>");
           echo(" <p class='card-text'>".$row['fecha_pedido']."</p>");
           echo(" <p class='card-text'>".$row['unidades']."</p>");
           echo(" <p class='card-text'>".$row['id']."</p>");
           echo("<form method='post'><button type='submit' class='btn btn-primary'>Eliminar definitivamente</button></form>");
           echo("</div>");
           echo("</div>");
        }

        $coon = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $statement = $conn->prepare('DELETE FROM pedidos where id='.$_GET["codigo"].'');
        $statement->execute();
        header("HTTP/1.1 200 OK");
        header('Location: consultar.php');
        exit();

    }
    }
include("footer.html");
?>