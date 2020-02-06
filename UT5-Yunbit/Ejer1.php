<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Consultas con PDO</title>
        <link rel='stylesheet' type='text/css' href='css/estilos_2.css' />
    </head>
    <body>
        <h3>Relación de Clientes</h3>
        <table border=1>
           <tr><th>Name</th><th>Address</th><th>Telephone</th></tr>
            <?php
            $clientes = obtener_datos();
            foreach ( $clientes as $cliente ) {
                echo "<tr>";
                echo "<td>".$cliente['nombre']."</td><td>".$cliente['direccion'].
                     "</td><td>".$cliente['telf'];
                echo "</tr>";
            }
            ?>
           
        </table>

        <?php echo 'Número de filas: ' . count($clientes); ?>
        
    </body>
</html> 
    

<?php

function obtener_datos() {
    
    include_once 'claseConexionBD.php';

    $BD = new ConectarBD();   
    $conn = $BD->getConexion();
   
    $stmt = $conn->prepare('SELECT * FROM clientes');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);  
    $stmt->execute();
    $datos = $stmt->fetchAll();
    
    $BD->cerrarConexion();
    
    return $datos;   
}

?>




