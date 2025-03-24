<?php
$mysqli = new mysqli("localhost", "root", "", "vulnerable_db");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Verifica que 'user' esté presente en la URL
if (isset($_GET['user'])) {
    $username = $_GET['user']; // Entrada sin sanitizar

    $query = "SELECT * FROM users WHERE username = $username LIMIT 1"; 

    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Usuario: " . $row["username"] . " - Contraseña: " . $row["password"] . "<br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "Falta el parámetro 'user' en la URL.";
}
?>

