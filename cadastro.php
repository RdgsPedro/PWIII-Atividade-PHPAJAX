<?php
include 'conecta.php';

$nome = $_POST['campo1'];
$login = $_POST['campo2'];
$senha = $_POST['campo3'];
$email = $_POST['campo4'];
$telefone = $_POST['campo5'];
$foto = $_POST['campo6'];

$sql = "INSERT INTO tb_contato VALUES (NULL,'" . $nome . "', '" . $login . "','" . $senha . "', '" . $email . "', '" . $telefone . "', '" . $foto . "')";
if ($conn->query($sql)) {
    echo "registro inserido";
}
