# A3.1 - Manejo de sesiones y cookies

Añade un nuevo repositorio a tu cuenta GitHub donde incorporarás el código fuente que has presentado en la actividad A2.2. Crea una nueva rama en la que implementarás las mejoras que se detallan a continuación:

- Añade a la base de datos una tabla donde registrarás la información relativa a los usuarios que podrán usar la aplicación:
  - Nombre y apellidos (en un único campo)
  - Nombre de usuario
  - Clave encriptada
  - Correo electrónico
  - Color de fondo favorito (por defecto, blanco)
  - Tipo de letra favorita (por defecto, Arial)

```SQL
create table usuarios(
  usuario varchar(20) primary key,
  clave varchar(64) not null,
  nombrecompleto varchar(200) not null,
  correo varchar(50) not null,
  colorfondo varchar(7) not null default 'EFF5F5',
  tipoletra varchar(30) not null default 'Arial'
);
```

- Crea una carpeta en el repositorio en la que incluirás el código SQL de la estructura de todas tus tablas. Si en el futuro realizas alguna modificación en ellas, deberás actualizar dichos ficheros.

- Crea el fichero login.php para mostrar una pantalla que te permita validar a cualquier usuario que intente acceder a la aplicación. Si el usuario intenta acceder directamente a cualquier PHP de la aplicación sin haberse validado previamente, se le deberá redirigir a login.php para que lo haga.

- Al iniciar sesión, carga en dos variables de sesión el color de fondo y el tipo de letra especificados en la tabla de usuarios, de forma que se utilicen en todos los PHP que visite el usuario.

- Crea el fichero perfil.php para permitir al usuario cambiar su nombre y apellidos, contraseña, correo electrónico, color de fondo y tipo de letra. Los datos modificados (únicamente esos datos) los debes volver a cargar en las variables de sesión correspondientes.

- Durante toda la navegación por la aplicación debes mostrar en el encabezado el nombre completo del usuario junto con un enlace que le permita editar el perfil.

- Almacena tres cookies en el navegador con una caducidad de un mes, cuyas funciones sean las siguientes:

  - Contar el número de accesos incorrectos a la aplicación.
  - Registrar los usuarios y contraseñas utilizados al acceder erróneamente a la aplicación.
  - Almacenar la fecha y la hora del último inicio de sesión exitoso. Esta información, en caso de existir, se debe mostrar en la página de inicio de sesión.

- El usuario debería tener la posibilidad de cerrar sesión en cualquier momento, a través de un enlace que se mostrará en el encabezado de todas las páginas de la aplicación. Tras cerrar la sesión, al usuario se le mostrará la página de login.

- Cuando hayas validado el funcionamiento de la aplicación, une la rama donde has hecho este desarrollo a la rama principal.

Propuesta para organizar el código de la validación del usuario

## login.php

- Definir una función "error($mensaje)" que en caso de error guarde en sesión el mensaje de error pasado por parámetro y redirija al usuario a login.php.
- Si está recibiendo datos de inicio de sesión por POST, que obtenga el usuario y contraseña y compruebe si coinciden con los de la BD.
  - Si no coinciden o si hay algún problema al conectar con la BD, invocar a la función "error" con un mensaje de error.
  - Asignar a una variable de sesión el nombre de usuario
  - Redirigir al usuario al listado de productos, aunque lo ideal sería redirigir al usuario a la página desde la que se intentó hacer la validación.
- Si no está recibiendo datos por POST, mostrar el formulario de inicio de sesión.
  - Si está definida la variable de sesión 'error', mostrar su contenido y eliminar dicha variable.

## resto de php

- Si no existe la variable de sesión “nombredeusuario”, redirigir a login.php
