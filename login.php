<?php
session_start();
include 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($login === '' || $senha === '') {
        echo "erro";
        exit;
    }

    $sql = "SELECT * FROM tb_contato WHERE login = :login AND senha = :senha LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;

        echo "sucesso";
    } else {
        echo "erro";
    }
}
