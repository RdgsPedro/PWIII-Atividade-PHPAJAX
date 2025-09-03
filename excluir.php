<?php
include 'conecta.php';

$id = $_POST['campo0']; 

$sql = "DELETE FROM tb_contato WHERE id='" . $id . "'";

if ($conn->query($sql)) {
    echo "registro excluido";
} else {
    echo "erro ao excluir";
}
?>
