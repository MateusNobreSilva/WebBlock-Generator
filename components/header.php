<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proxy Block Generator</title>

    <link rel="stylesheet" href="assets/bootstrap-5.3.8-dist/css/bootstrap.min.css">

    <style>
        .site-card {
            transition: .2s ease;
            cursor: pointer;
        }

        .site-card:hover {
            border-color: #0d6efd;
            background: #f8f9fa;
        }

        .site-card input {
            cursor: pointer;
        }
    </style>

</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark shadow">
        <div class="container">
            <span class="navbar-brand fw-bold">Proxy Block Generator</span>
        </div>
    </nav>

    <button type="button" class="btn btn-sm btn-info" onclick="abrirSeletorArquivo()">
        Carregar arquivo (.txt)
    </button>

    <input type="file" id="filePicker" accept=".txt,text/plain" style="display:none" />

    <div class="container py-4">