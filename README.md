# proyectoYunbitPHP
Prueba de conocimientos PHP Junior Offline
PRUEBA DE CONOCIMIENTOS PARA INTEGRACIÓN
El entorno de trabajo deberá incluir un servidor web capaz de ejecutar PHP, y una base de
datos. Se deberá crear una tabla llamada TEST_CLIENTS, con campos:
   ID - int AUTO_INCREMENT
   NAME – varchar(255)
   ADDRESS – varchar(255)
   DESCRIPTION - text
   TELF– varchar(255)
   TYPE – char(1)
Entregar el código SQL de creación de la tabla, o los pasos seguidos para crearla si no se
hace mediante código.
Los ejercicios propuestos son:
1) Crear una página PHP que se conecte a la base de datos descrita, obtenga el contenido de los
campos NAME, ADDRESS y TELF de todos los registros de la tabla TEST_CLIENTS y los muestre
en pantalla.
2) Modificar la página PHP anterior para que encima del listado de registros aparezca un
formulario que permita insertar nuevos registros.
3) Hacer que, en vez de mostrarse el valor del campo TYPE, se muestren destacados los clientes
de tipo Premium (campo TYPE con valor ‘P’).
4) Añadir validación JavaScript al formulario anterior, que no permita que se envíen los datos si
no se rellenan todos los campos (opcional: comprobar que el valor del campo TELF es
numérico, y que TYPE sólo admita los valores N y P).
5) Crear una página de detalle que reciba el identificador de un registro y muestre todos sus
campos; enlazar los registros desde el listado a esta página.
6) Modificar el código, e indicar las configuraciones especiales del servidor si fueran necesarias,
para acceder al detalle del registro con “URLs amigables”; es decir, que en vez de pasar el
identificador con un parámetro de query string, se acceda con una URL del estilo
/detalle/<nombre-del-registro>
