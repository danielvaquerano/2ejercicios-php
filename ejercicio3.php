<?php
function esPalindromo($cadena) {
    // Limpiar cadena: quitar espacios y convertir a minúsculas
    $cadenaLimpia = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $cadena));
    
    // Comparar con su reverso
    return $cadenaLimpia === strrev($cadenaLimpia);
}

// Procesar formulario
$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = trim($_POST['texto']);
    if (!empty($texto)) {
        $esPalindromo = esPalindromo($texto);
        $resultado = '"' . htmlspecialchars($texto) . '"' . 
                     ($esPalindromo ? ' ES un palíndromo' : ' NO es un palíndromo');
    } else {
        $resultado = 'Por favor, ingrese un texto válido';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palíndromos - Ejercicio 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Ejercicio 3 - Palíndromos</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="texto" class="form-label">Ingrese una palabra o frase:</label>
                                <input type="text" class="form-control" id="texto" name="texto" 
                                       required placeholder="Ej: anita lava la tina">
                            </div>
                            <button type="submit" class="btn btn-info text-white">Verificar</button>
                            <a href="index.php" class="btn btn-secondary">Volver</a>
                        </form>
                        
                        <?php if ($resultado): ?>
                        <div class="alert alert-info mt-3">
                            <strong>Resultado:</strong> <?php echo $resultado; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <small class="text-muted">Ejemplos de palíndromos: "reconocer", "anita lava la tina", "oso"</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>