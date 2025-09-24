<?php
function esPrimo($numero) {
    if ($numero <= 1) return false;
    if ($numero <= 3) return true;
    if ($numero % 2 == 0 || $numero % 3 == 0) return false;
    
    for ($i = 5; $i * $i <= $numero; $i += 6) {
        if ($numero % $i == 0 || $numero % ($i + 2) == 0) {
            return false;
        }
    }
    return true;
}

// Procesar formulario
$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = intval($_POST['numero']);
    if ($numero > 0) {
        $esPrimo = esPrimo($numero);
        $resultado = $numero . ($esPrimo ? ' ES un número primo' : ' NO es un número primo');
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
    <title>Números Primos - Ejercicio 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Ejercicio 2 - Números Primos</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Ingrese un número:</label>
                                <input type="number" class="form-control" id="numero" name="numero" 
                                       min="1" required>
                            </div>
                            <button type="submit" class="btn btn-success">Verificar</button>
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