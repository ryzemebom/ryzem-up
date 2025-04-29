<?php

// Definir o diretório de uploads
$uploadDir = './uploads/';

// Verifique se o diretório de uploads existe, se não, cria
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verificar se o arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Caminho completo do arquivo
        $filePath = $uploadDir . basename($_FILES['file']['name']);
        
        // Mover o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            echo json_encode(['message' => 'Arquivo enviado com sucesso!']);
        } else {
            echo json_encode(['message' => 'Erro ao mover o arquivo.']);
        }
    } else {
        echo json_encode(['message' => 'Erro no upload do arquivo.']);
    }
} else {
    echo json_encode(['message' => 'Nenhum arquivo enviado.']);
}
