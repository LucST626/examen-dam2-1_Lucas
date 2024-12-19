# Sprint 1

Iniciamos el proyecto y probamos que ponemos hacer commits a nuestro master de nuestro fork utilizando los comandos de `git`:

```
git add .
git commit -m "Prueba de commit"
git push
```

E iniciamos sesión en `Docker HUB`:
```
docker login
```
![alt text](image.png)


# Sprint 2

- Creada una carpeta `apache` con un archivo `Dockerfile` basado en la imagen oficial de Apache.

- Agregado un archivo `index.html` que muestra "Hola Mundo".

- Imagen construida con `docker build` y contenedor lanzado en el puerto 8080.
Primero le hacemos la Build a Docker y lo runeamos:
```
docker build -t apache-server .
docker run -d -p 8080:80 --name apache-container apache-server
```
![alt text](image.png)

Y entramos en `http://localhost:8080`

# Sprint 3

- Creada la carpeta `apache-php` con soporte para PHP mediante la imagen oficial `php:7.4-apache`.
- Configurado `index.php` para mostrar un mensaje, la hora, versiones y direcciones IP.

```
<?php
echo "<h1>Hola Mundo</h1>";
echo "<p>Fecha y hora actual: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>Versión de PHP: " . phpversion() . "</p>";
echo "<p>Versión de Apache: " . apache_get_version() . "</p>";
echo "<p>IP del servidor: " . $_SERVER['SERVER_ADDR'] . "</p>";
echo "<p>IP del cliente: " . $_SERVER['REMOTE_ADDR'] . "</p>";
?>
```
![alt text](image-1.png)

- Imagen construida y contenedor lanzado en el puerto 8080.

# Sprint 4

- Agregados los archivos `info.php` y `random.php` para mostrar información de PHP y un JSON con datos aleatorios.

info.php
```
<?php
phpinfo();
?>
```


random.php
```
<?php
$randomNumber = rand(1, 100);
$parity = ($randomNumber % 2 === 0) ? "par" : "impar";
$elements = ["rojo", "azul", "verde", "amarillo", "morado"];
$randomElement = $elements[array_rand($elements)];

echo json_encode([
    "numero" => $randomNumber,
    "paridad" => $parity,
    "elemento" => $randomElement
]);
?>
```
- Imagen reconstruida y contenedor lanzado nuevamente.

# Sprint 5

-Agregado la carpeta `apache-php-mysql` con el `docker-compose.yml` un `init.sql` y la carpeta de `apache-php` copiada dentro.

`init.sql` tiene lo siguiente en su interior:
```
CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(100)
);

INSERT INTO users (name, password) VALUES
('Alice', 'password123'),
('Bob', 'securepassword'),
('Charlie', 'anotherpassword');
```

`docker-compose.yml` tiene:
```
version: '3.8'

services:
  apache-php:
    build: ./apache-php
    ports:
      - "8080:80"
    networks:
      - app-network

  mysql:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: testdb
      MYSQL_USER: testuser
      MYSQL_PASSWORD: testpassword
    volumes:
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql
    networks:
      - app-network

networks:
  app-network:
    driver: bridge
```
-Dentro de la carpeta de `apache-php` hemos creado y modificado:
│   ├── Dockerfile
```
FROM php:8.0-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli

# Copia los archivos PHP al directorio adecuado del contenedor
COPY . /var/www/html/

# Cambia permisos para evitar problemas de acceso
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80
EXPOSE 80

```
│   ├── index.php
```
<?php
$servername = "mysql";
$username = "testuser";
$password = "testpassword";
$dbname = "testdb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
echo "Conexión exitosa a la base de datos MySQL";
?>

```
│   ├── users.php
```
<?php
$servername = "mysql";
$username = "testuser";
$password = "testpassword";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, name, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nombre: " . $row["name"]. " - Contraseña: " . $row["password"]. "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>

```
- He iniciado ambos contenedores con `docker-compose` primero instalandolo con: `sudo apt install docker-compose` y acontinuación creamos la build y le damos a correr:
 
```
docker-compose build
docker-compose up
```
y por último para subirlo a Docker Hub utilizamos:

`docker tag apache-php-mysql-apache-php rveng/apache-php-mysql-apache-php:latest
`
y 

`docker push Rveng/apache-php-mysql-apache-php:latest
`

y una vez hayamos limpiado todos los errores, y nos acepte el push tendrémos todo listo.
