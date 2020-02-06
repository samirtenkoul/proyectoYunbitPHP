
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Consultas con PDO</title>
        <link rel='stylesheet' type='text/css' href='css/estilos_2.css' />
    </head>
    <body>
        <div class="contacto">
            <form action="" method="post"">
                <label>Name: </label><input type="text" name="name" id="name"/>
                <label>Address: </label><input type="text" name="address" id="address"/><br/>
                <label>Foto: </label><input type="text" name="foto" id="foto"/>
                <label>Telephone: </label><input type="text" name="telf" id="telf"/><br/>
                <label>Type: </label><input type="text" name="type" id="type"/><br/><br/>

                <input type="submit" name="enviar" value="Nuevo Cliente" /><br/><br/> 
            </form>
        </div>  
        
        <table>
            <?php
                if ( isset($_POST['enviar']) ) {
                    insertar_datos($_POST);
                }
                $clientes = obtener_datos(); 
                if ( count($clientes) > 0 ) {
                   echo '<tr><th>Name</th><th>Direction</th><th>Telephone</th></tr>'; 
                }
                foreach ( $clientes as $cliente ) {
                    if ( $cliente['tipo'] == 'P' )
                        echo '<tr style="font-weight: bold">';
                    else
                        echo '<tr>';
                   
                    echo "<td>".$cliente['nombre']."</td><td>".$cliente['direccion'].
                         "</td><td>".$cliente['telf'];
                    echo "</tr>";
                }
            ?>          
      </table>
      <br/>
      <?php echo 'Número de clientes: ' . count($clientes); ?>
        
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

function insertar_datos($datos) {
    
    include_once 'claseConexionBD.php';

    $BD = new ConectarBD();   
    $conn = $BD->getConexion();
   
    $stmt = $conn->prepare('INSERT INTO clients (id, name, address, foto, telf, tipo) '
              . 'VALUES (0, :name, :address, :foto, :telf, :type)');
    
    try {
        $stmt->execute( array( ':name' => $datos['name'],
                               ':address' => $datos['address'],
                               ':foto' => $datos['foto'],
                               ':telf' => $datos['telf'],
                               ':tipo' => $datos['tipo'])
                      );
    }
    catch (PDOException $ex) {
        print "¡Error!: " . $ex->getMessage() . "<br/>";
        die();
    }
    $BD->cerrarConexion(); 
}



?>




