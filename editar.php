<?php
include 'conecta.php';

$id = $_POST['campo0'];
$nome = $_POST['campo1'];
$login = $_POST['campo2'];
$senha = $_POST['campo3'];
$email = $_POST['campo4'];
$telefone = $_POST['campo5'];

$foto = $_POST['foto_atual'];

if (isset($_FILES['campo6']) && $_FILES['campo6']['error'] === UPLOAD_ERR_OK) {
    $extensao = pathinfo($_FILES['campo6']['name'], PATHINFO_EXTENSION);
    $novoNome = uniqid() . "." . strtolower($extensao);
    $caminho = "uploads/" . $novoNome;

    if (move_uploaded_file($_FILES['campo6']['tmp_name'], $caminho)) {
        $foto = $caminho;
    }
}

$sql = "UPDATE tb_contato 
        SET nome='" . $nome . "', 
            login='" . $login . "', 
            senha='" . $senha . "', 
            email='" . $email . "', 
            telefone='" . $telefone . "', 
            foto='" . $foto . "'
        WHERE id='" . $id . "'";

if ($conn->query($sql)) {
    echo "registro atualizado";
} else {
    echo "erro ao atualizar: " . $conn->error;
}
?>