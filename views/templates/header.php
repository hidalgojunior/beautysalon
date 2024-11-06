<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventário</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Nosso CSS customizado com as cores do projeto -->
    <style>
        :root {
            --black: #000000;
            --cambridge-blue: #839788;
            --champagne: #eee0cb;
            --khaki: #baa898;
            --columbia-blue: #bfd7ea;
        }

        body {
            background-color: var(--champagne);
        }

        .navbar {
            background-color: var(--cambridge-blue);
        }

        .btn-primary {
            background-color: var(--cambridge-blue);
            border-color: var(--cambridge-blue);
        }

        .btn-primary:hover {
            background-color: var(--khaki);
            border-color: var(--khaki);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Inventário</a>
        </div>
    </nav>
    <div class="container mt-4"> 