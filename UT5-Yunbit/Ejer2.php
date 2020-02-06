
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Consultas con PDO</title>
        <link rel='stylesheet' type='text/css' href='css/estilos_2.css' />
    </head>
    <body>
        <div class="contacto">
            <form action="" method="post" enctype="multipart/form-data">
                <label>Nombre: </label><input type="text" name="nombre" id="name"/>
                <label>Dirección: </label><input type="text" name="direccion" id="address"/><br/>
                <label>Descripción: </label><input type="text" name="descripcion" id="description"/>
                <label>Teléfono: </label><input type="text" name="telf" id="telf"/><br/>
                <label>Foto: </label><input type="text" name="foto" id="telf"/><br/>
                <label>Tipo: </label><input type="text" name="tipo" id="type"/><br/><br/>
                
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
                   echo '<tr><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Foto</th></tr>'; 
                }
                foreach ( $clientes as $cliente ) {
                    if ( $cliente['tipo'] == 'P' )
                        echo '<tr style="font-weight: bold">';
                    else
                        echo '<tr>';
                   
                    echo "<td>".$cliente['nombre']."</td><td>".$cliente['direccion'].
                         "</td><td>".$cliente['telf']."</td><td>".$cliente['foto']."</td>";
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
   
    $stmt = $conn->prepare('INSERT INTO clientes (id, nombre, direccion, telf, foto, tipo) '
              . 'VALUES (0, :name, :address, :telf, :foto, :tipo)');
    
    try {
        $stmt->execute( array( ':name' => $datos['nombre'],
                               ':address' => $datos['direccion'],
                               
                               'telf' => $datos['telf'],
                               'foto' => $datos['foto'],
                               'tipo' => $datos['tipo'])
                      );
    }
    catch (PDOException $ex) {
        print "¡Error!: " . $ex->getMessage() . "<br/>";
        die();
    }
    $BD->cerrarConexion(); 
}

?>




