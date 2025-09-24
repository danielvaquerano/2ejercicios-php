<?php
function invertirLista($array) {
    return array_reverse($array);
}

function generarArrayAleatorio($cantidad) {
    $array = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $array[] = rand(1, 100);
    }
    return $array;
}

// Procesar formulario
$resultado = '';
$arrayOriginal = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['generar'])) {
        $cantidad = intval($_POST['cantidad']);
        if ($cantidad > 0 && $cantidad <= 20) {
            $arrayOriginal = generarArrayAleatorio($cantidad);
        }
    } elseif (isset($_POST['invertir']) && !empty($_POST['array_original'])) {
        $arrayOriginal = array_map('intval', explode(',', $_POST['array_original']));
        $arrayInvertido = invertirLista($arrayOriginal);
        $resultado = implode(', ', $arrayInvertido);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Invertida - Ejercicio 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Ejercicio 4 - Lista Invertida</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad de números (1-20):</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" 
                                               min="1" max="20" value="5" required>
                                    </div>
                                    <button type="submit" name="generar" class="btn btn-warning">Generar Array</button>
                                </div>
                                <div class="col-md-6">
                                    <?php if (!empty($arrayOriginal)): ?>
                                    <div class="mb-3">
                                        <label class="form-label">Array generado:</label>
                                        <input type="text" class="form-control" readonly 
                                               value="<?php echo implode(', ', $arrayOriginal); ?>">
                                        <input type="hidden" name="array_original" 
                                               value="<?php echo implode(',', $arrayOriginal); ?>">
                                    </div>
                                    <button type="submit" name="invertir" class="btn btn-warning">Invertir Lista</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
                            </div>
                        </form>
                        
                        <?php if ($resultado): ?>
                        <div class="alert alert-success mt-3">
                            <h5>Resultado:</h5>
                            <p class="mb-1"><strong>Array original:</strong> <?php echo implode(', ', $arrayOriginal); ?></p>
                            <p class="mb-0"><strong>Array invertido:</strong> <?php echo $resultado; ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>