<!--Deber02-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 1</title>
    <!--Llamada de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Menú 1</h1>
        
        <?php
        $mostrarFormulario = true; // Controla si el formulario debe mostrarse
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opcion = strtoupper(trim($_POST["opcion"])); // Convertir opción a mayúscula
            $numero = isset($_POST["numero"]) ? intval($_POST["numero"]) : null;

            // Validar entrada
            if (!in_array($opcion, ['1', '2', '3', 'S'])) {
                echo "<div class='alert alert-danger'>Por favor, elija una opción válida: 1, 2, 3 o S.</div>";
            } elseif ($opcion !== 'S' && ($numero < 0 || $numero > 10)) {
                echo "<div class='alert alert-danger'>Por favor, ingrese un número entre 0 y 10.</div>";
            } else {
                // Procesar opciones
                switch ($opcion) {
                    case '1':
                        echo "<h4>Factorial de $numero:</h4>";
                        echo factorial($numero);
                        break;
                    case '2':
                        echo "<h4>¿El número $numero es primo?</h4>";
                        echo esPrimo($numero) ? "Sí, es primo." : "No, no es primo.";
                        break;
                    case '3':
                        echo "<h4>Serie Matemática ($numero términos):</h4>";
                        echo calcularSerie($numero);
                        break;
                    case 'S':
                        echo "<h4>Gracias por usar el programa. ¡Hasta luego!</h4>";
                        $mostrarFormulario = false; // Ocultar el formulario
                        break;
                }
            }
        }

        // Mostrar el formulario solo si la opción no es "S"
        if ($mostrarFormulario): 
        ?>
        
        <form method="post" action="index.php">
            <div class="mb-3">
                <label class="form-label">==========================</label>
                <p>
                    1. Factorial<br>
                    2. Número Primo<br>
                    3. Serie Matemática<br>
                    S. Salir<br>
                </p>
                <label for="opcion" class="form-label">Elija una opción (1, 2, 3 o S):</label>
                <input type="text" id="opcion" name="opcion" class="form-control" maxlength="1" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Ingrese un número (0 - 10):</label>
                <input type="number" id="numero" name="numero" class="form-control" min="0" max="10">
            </div>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        <?php endif; ?>

        <?php
        // Funciones auxiliares
        function factorial($n) {
            $factorial = 1;
            for ($i = 1; $i <= $n; $i++) {
                $factorial *= $i;
            }
            return $factorial;
        }

        function esPrimo($n) {
            if ($n < 2) return false;
            for ($i = 2; $i <= sqrt($n); $i++) {
                if ($n % $i == 0) return false;
            }
            return true;
        }

        function calcularSerie($terminos) {
            $serie = "";
            $resultado = 0;
            for ($i = 1; $i <= $terminos; $i++) {
                $numerador = $i * $i;
                $denominador = factorial($i);
                $valor = $i % 2 == 0 ? -$numerador / $denominador : $numerador / $denominador;
                $resultado += $valor;
                $serie .= $i == 1 ? "$valor" : " " . ($valor > 0 ? "+ $valor" : "$valor");
            }
            return "$serie<br><strong>Resultado:</strong> $resultado";
        }
        ?>
    </div>

    <!-- Para el dise;o de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
