<?php
$password = "Alexa05"; // Reemplázalo con la contraseña que quieras encriptar
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Contraseña original: " . htmlspecialchars($password) . "<br>";
echo "Hash generado: " . htmlspecialchars($hash);
?>