
<!DOCTYPE html>

<html>
    <head>
        <title>Consultas con PDO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel='stylesheet' type='text/css' href='css/estilos_2.css' />           
    </head>
    <body>
       <div class="contacto">
            <form action="" method="post" onsubmit="return validarForm();">
                <label>Name: </label><input type="text" name="nombre" id="nombre"/>
                <label>Address: </label><input type="text" name="direccion" id="direccion"/><p id="errdir" class='alert-danger'></p> 
                <label>Description: </label><input type="text" name="descripcion" id="descripcion"/>
                <label>Telephone: </label><input type="text" name="telf" id="telf"/><br/>
                <label>Type: </label><input type="text" name="tipo" id="tipo"/><br/><br/>

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
                   echo '<tr><th>Name</th><th>Address</th><th>Telephone</th></tr>'; 
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
     
      <script type="text/javascript" src="js/funciones.js"></script> 
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
   
    $stmt = $conn->prepare('INSERT INTO clientes (id, nombre, direccion, telf, foto, tipo) '
              . 'VALUES (0, :nombre, :direccion, :telf, :foto, :tipo)');
    
    try {
        $stmt->execute( array( ':nombre' => $datos['nombre'],
                               ':direccion' => $datos['direccion'],
                               ':telf' => $datos['telf'],
                               ':foto' => $datos['descripcion'],
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




