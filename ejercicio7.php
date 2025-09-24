<?php
function generarPiramide($filas) {
    $piramide = '';
    for ($i = 1; $i <= $filas; $i++) {
        // Espacios en blanco
        $espacios = str_repeat('&nbsp;', $filas - $i);
        // Asteriscos
        $asteriscos = str_repeat('* ', $i);
        $piramide .= $espacios . $asteriscos . "<br>";
    }
    return $piramide;
}

// Procesar formulario
$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filas = intval($_POST['filas']);
    if ($filas > 0 && $filas <= 10) {
        $resultado = generarPiramide($filas);
    } else {
        $resultado = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirámide Asteriscos - Ejercicio 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .piramide {
            font-family: 'Courier New', monospace;
            line-height: 1.2;
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #dee2e6;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Ejercicio 7 - Pirámide de Asteriscos</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="filas" class="form-label">Número de filas (1-10):</label>
                                        <input type="number" class="form-control" id="filas" name="filas" 
                                               min="1" max="10" value="5" required>
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Generar Pirámide</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <small>Este ejercicio muestra un patrón de pirámide usando bucles anidados.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
                            </div>
                        </form>
                        
                        <?php if ($resultado === 'error'): ?>
                        <div class="alert alert-warning mt-3">
                            Por favor, ingrese un número entre 1 y 10.
                        </div>
                        <?php elseif ($resultado): ?>
                        <div class="mt-4">
                            <h5>Pirámide Generada:</h5>
                            <div class="piramide mt-3">
                                <?php echo $resultado; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>