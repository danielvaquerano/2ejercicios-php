<?php
function frecuenciaCaracteres($texto) {
    $frecuencia = [];
    $texto = strtolower($texto);
    
    for ($i = 0; $i < strlen($texto); $i++) {
        $caracter = $texto[$i];
        if ($caracter != ' ') {
            if (isset($frecuencia[$caracter])) {
                $frecuencia[$caracter]++;
            } else {
                $frecuencia[$caracter] = 1;
            }
        }
    }
    
    return $frecuencia;
}

// Procesar formulario
$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = trim($_POST['texto']);
    if (!empty($texto)) {
        $frecuencia = frecuenciaCaracteres($texto);
        $resultado = $frecuencia;
    } else {
        $resultado = 'empty';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frecuencia Caracteres - Ejercicio 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Ejercicio 6 - Frecuencia de Caracteres</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="texto" class="form-label">Ingrese un texto:</label>
                                <textarea class="form-control" id="texto" name="texto" rows="3" 
                                          placeholder="Ej: programación en PHP" required><?php 
                                          echo isset($_POST['texto']) ? htmlspecialchars($_POST['texto']) : ''; 
                                          ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Analizar Frecuencia</button>
                            <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
                        </form>
                        
                        <?php if ($resultado === 'empty'): ?>
                        <div class="alert alert-warning mt-3">
                            Por favor, ingrese un texto válido.
                        </div>
                        <?php elseif ($resultado): ?>
                        <div class="alert alert-success mt-3">
                            <h5>Frecuencia de Caracteres:</h5>
                            <div class="row mt-3">
                                <?php 
                                $totalCaracteres = array_sum($resultado);
                                foreach ($resultado as $caracter => $frecuencia): 
                                    $porcentaje = round(($frecuencia / $totalCaracteres) * 100, 1);
                                ?>
                                <div class="col-md-3 col-sm-4 mb-2">
                                    <div class="card text-center">
                                        <div class="card-body py-2">
                                            <h6 class="card-title">'<?php echo htmlspecialchars($caracter); ?>'</h6>
                                            <p class="mb-0"><strong><?php echo $frecuencia; ?></strong> veces</p>
                                            <small class="text-muted"><?php echo $porcentaje; ?>%</small>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
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