<?php
include 'conecta.php';

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$nome = $_POST['campo1'];
$login = $_POST['campo2'];
$senha = $_POST['campo3'];
$email = $_POST['campo4'];
$telefone = $_POST['campo5'];
$foto = "";

if (isset($_FILES['campo6']) && $_FILES['campo6']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['campo6']['name'], PATHINFO_EXTENSION);
    $novoNome = uniqid("foto_") . "." . $ext;
    $destino = $uploadDir . $novoNome;

    if (move_uploaded_file($_FILES['campo6']['tmp_name'], $destino)) {
        $foto = $destino;
    }
}

$sql = "INSERT INTO tb_contato (nome, login, senha, email, telefone, foto) 
        VALUES (:nome, :login, :senha, :email, :telefone, :foto)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':senha', $senha);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':foto', $foto);

if ($stmt->execute()) {
    echo "Registro inserido com sucesso!";
} else {
    echo "Erro ao inserir registro.";
}
