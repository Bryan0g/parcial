<?php
include 'config.php';
include 'supabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Guardar en la base de datos local
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password) VALUES (:nombre, :apellido, :email, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error al guardar en la base de datos local: " . $e->getMessage());
    }

    // Guardar en Supabase
    try {
        guardarEnSupabase($nombre, $apellido, $email, $password);
    } catch (Exception $e) {
        die("Error al guardar en Supabase: " . $e->getMessage());
    }

    echo "Usuario registrado correctamente.";
}
?>
