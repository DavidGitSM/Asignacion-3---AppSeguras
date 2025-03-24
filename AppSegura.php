<?php
$mysqli = new mysqli("localhost", "root", "", "vulnerable_db");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Se obtiene la entrada del usuario desde la URL
$username = $_GET['user']; 

// Se prepara la consulta SQL para evitar inyección SQL
$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");

// Se vincula el parámetro de entrada, asegurándose de que el valor sea tratado como una cadena
$stmt->bind_param("s", $username);

// Se ejecuta la consulta preparada
$stmt->execute();

// Se obtiene el resultado de la ejecución
$result = $stmt->get_result();

// Se recorre el resultado y se imprime de forma segura
while ($row = $result->fetch_assoc()) {
    // Aquí se sanitiza la salida usando htmlspecialchars para evitar XSS
    // Esto convierte caracteres especiales en entidades HTML, evitando la ejecución de código malicioso
    echo "Usuario: " . htmlspecialchars($row["username"]) . "<br>";
}
?>
