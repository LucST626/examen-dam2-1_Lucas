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


