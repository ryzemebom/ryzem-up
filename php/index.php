<?php
// Define o diretório onde os arquivos serão armazenados
$uploadDir = 'uploads/';

// Cria o diretório de uploads se não existir
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verifica se um arquivo foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Verifica se houve erro no upload
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        // Define o caminho completo onde o arquivo será salvo
        $filePath = $uploadDir . basename($_FILES['file']['name']);
        
        // Move o arquivo enviado para o diretório de uploads
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            echo "Arquivo enviado com sucesso!";
        } else {
            echo "Erro ao mover o arquivo para o diretório de uploads.";
        }
    } else {
        echo "Erro no envio do arquivo.";
    }
}

// Lista todos os arquivos presentes no diretório de uploads
$files = array_diff(scandir($uploadDir), array('..', '.'));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compartilhamento de Arquivos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        .file-list {
            margin-top: 20px;
        }
        .file-list a {
            display: block;
            margin: 5px 0;
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Compartilhe seus Arquivos</h1>

        <!-- Formulário para upload -->
        <form action="index.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="file" name="file" required>
            <button type="submit">Enviar Arquivo</button>
        </form>

        <!-- Lista de arquivos para download -->
        <div class="file-list">
            <h3>Arquivos Disponíveis</h3>
            <ul>
                <?php foreach ($files as $file): ?>
                    <li><a href="uploads/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
