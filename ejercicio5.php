<?php
function sumarPares($numeros) {
    $suma = 0;
    foreach ($numeros as $numero) {
        if ($numero % 2 == 0 && $numero <= 400) {
            $suma += $numero;
        }
    }
    return $suma;
}

function generarNumerosAleatorios($cantidad) {
    $numeros = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $numeros[] = rand(1, 500);
    }
    return $numeros;
}

// Procesar formulario
$resultado = '';
$numeros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['generar'])) {
        $cantidad = intval($_POST['cantidad']);
        if ($cantidad > 0 && $cantidad <= 15) {
            $numeros = generarNumerosAleatorios($cantidad);
        }
    } elseif (isset($_POST['calcular']) && !empty($_POST['numeros'])) {
        $numeros = array_map('intval', explode(',', $_POST['numeros']));
        $suma = sumarPares($numeros);
        $pares = array_filter($numeros, function($n) { return $n % 2 == 0 && $n <= 400; });
        
        $resultado = [
            'suma' => $suma,
            'pares' => $pares,
            'total_numeros' => count($numeros)
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma Pares - Ejercicio 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Ejercicio 5 - Suma de Números Pares (hasta 400)</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad de números (1-15):</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" 
                                               min="1" max="15" value="8" required>
                                    </div>
                                    <button type="submit" name="generar" class="btn btn-danger">Generar Números</button>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!empty($numeros)): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Números generados:</label>
                                        <input type="text" class="form-control" readonly 
                                               value="<?php echo implode(', ', $numeros); ?>">
                                        <input type="hidden" name="numeros" 
                                               value="<?php echo implode(',', $numeros); ?>">
                                    </div>
                                    <button type="submit" name="calcular" class="btn btn-danger">Calcular Suma</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
                            </div>
                        </form>
                        
                        <?php if ($resultado): ?>
                        <div class="alert alert-info mt-3">
                            <h5>Resultado:</h5>
                            <p><strong>Total números generados:</strong> <?php echo $resultado['total_numeros']; ?></p>
                            <p><strong>Números pares (≤400):</strong> <?php echo implode(', ', $resultado['pares']); ?></p>
                            <p><strong>Suma de pares:</strong> <?php echo $resultado['suma']; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>