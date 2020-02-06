<?php
   session_start();
   
   if (!isset($_SESSION['nombre']))
      header('Location: login.php');
   else {
       $nombre = $_SESSION['nombre'];
       $apellidos = $_SESSION['apellidos'];
       
   }
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Consultas con PDO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' type='text/css' href='css/estilos_2.css' />          
    </head>
    <body>
        <?php echo 'Conectado como <b>' . $nombre . ' ' . $apellidos ?>
        <br/><br/>
        <div>
            <form action="" method="post" enctype="multipart/form-data" 
                                             onsubmit="return validarForm();">           
                <label>Nombre: </label><input type="text" name="nombre" id="nombre" />
                <label>Dirección: </label><input type="text" name="direccion" id="direccion" /><br/>
                <label>Teléfono: </label><input type="text" name="telf" id="telf"/><br/>
                <label>Descripción: </label><input type="text" name="descripcion" id="descripcion" /><br/>
                <label>Tipo: <select name="tipo">
                        <option value="N">Normal</option>
                        <option value="V">VIP</option>
                    </select>
                             
                <br/><br/> 
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
                   echo '<tr><th>Nombre</th><th>Direccion</th><th>Teléfono</th><th>Descripcion</th><th>Acciones</th></tr>'; 
                }
                foreach ( $clientes as $cliente ) {
                    if ( $cliente['tipo'] == 'V' )
                        echo '<tr style="font-weight: bold">';
                    else
                        echo '<tr>';
                   
                    echo "<td>".$cliente['nombre']."</td><td>".$cliente['direccion'].
                         "</td><td>".$cliente['telf']."</td>".
                         "<td>".$cliente['foto']."</td>";
                    echo "<td><a href='detalle.php?id=".$cliente['id']."'>Detalle</a></td>";
                    echo "</tr>";
                }
            ?>          
        </table>
     
        <?php echo 'Número de clientes: ' . count($clientes); ?><br/>
     
        <a href="desconectar.php">Cerrar Sesión</a>
        
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
              . 'VALUES (0, :name, :address, :telf, :descripcion, :tipo)');
    
    try {
        $stmt->execute( array( ':name' => $datos['nombre'],
                               ':address' => $datos['direccion'],
                               ':telf' => $datos['telf'],
                               ':descripcion' => $datos['descripcion'],
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

