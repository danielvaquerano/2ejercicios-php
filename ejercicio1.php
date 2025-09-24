<?php
function generarFibonacci($n) {
    $fibonacci = [];
    
    if ($n >= 1) {
        $fibonacci[] = 0;
    }
    if ($n >= 2) {
        $fibonacci[] = 1;
    }
    
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    
    return $fibonacci;
}

// Procesar formulario
$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = intval($_POST['numero']);
    if ($numero > 0) {
        $serie = generarFibonacci($numero);
        $resultado = implode(', ', $serie);
    } else {
        $resultado = 'Por favor, ingrese un número válido mayor a 0';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci - Ejercicio 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ejercicio 1 - Serie Fibonacci</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número de términos:</label>
                                <input type="number" class="form-control" id="numero" name="numero" 
                                       min="1" max="50" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Generar Serie</button>
                            <a href="index.php" class="btn btn-secondary">Volver</a>
                        </form>
                        
                        <?php if ($resultado): ?>
                        <div class="alert alert-info mt-3">
                            <strong>Resultado:</strong> <?php echo $resultado; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>