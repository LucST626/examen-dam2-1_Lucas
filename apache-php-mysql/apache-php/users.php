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
