<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 2</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Menú 2</h1>
        
        <!-- Formulario con las opciones como lista -->
        <form method="post" action="index.php">
            <div class="mb-3">
                <label for="opcion" class="form-label">============================</label>
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>
                            <input type="radio" name="opcion" value="1" required>
                            1.- Fibonacci
                        </label>
                    </li>
                    <li class="list-group-item">
                        <label>
                            <input type="radio" name="opcion" value="2">
                            2.- Cubo
                        </label>
                    </li>
                    <li class="list-group-item">
                        <label>
                            <input type="radio" name="opcion" value="3">
                            3.- Fraccionarios
                        </label>
                    </li>
                    <li class="list-group-item">
                        <label>
                            <input type="radio" name="opcion" value="S">
                            S.- Salir
                        </label>
                    </li>
                </ul>
            </div>

            <div class="mt-3">
                <p class="text-muted">Escoja una opción ????????</p>
                <button type="submit" class="btn btn-primary">Procesar</button>
            </div>
        </form>

        <div class="mt-4">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $opcion = $_POST["opcion"];

                switch ($opcion) {
                    case '1': // Fibonacci
                        echo '<h4>Serie Fibonacci</h4>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="opcion" value="1">';
                        echo '<div class="mb-3">';
                        echo '<label for="numero" class="form-label">Ingrese un número (1 - 50):</label>';
                        echo '<input type="number" id="numero" name="numero" class="form-control" min="1" max="50" required>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-success">Generar Serie</button>';
                        echo '</form>';
                        break;

                    case '2': 
                        define('MAX', 1000000);
                        echo '<h4>Números que cumplen la condición:</h4>';
                        for ($i = 1; $i <= MAX; $i++) {
                            if (esSumaDeCubos($i)) {
                                echo $i . " ";
                            }
                        }
                        break;

                    case '3': // Fraccionarios
                        echo '<h4>Operación con Fraccionarios</h4>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="opcion" value="3">';
                        for ($i = 1; $i <= 4; $i++) {
                            echo "<div class='mb-3'>";
                            echo "<label for='num{$i}' class='form-label'>Fracción {$i} (Numerador y Denominador):</label>";
                            echo "<div class='row'>";
                            echo "<div class='col'><input type='number' name='num{$i}_numerador' class='form-control' required></div>";
                            echo "<div class='col'><input type='number' name='num{$i}_denominador' class='form-control' min='1' required></div>";
                            echo "</div></div>";
                        }
                        echo '<button type="submit" class="btn btn-success">Calcular</button>';
                        echo '</form>';
                        break;

                    case 'S': // Salir
                        echo '<h4>Gracias por usar el programa. ¡Hasta luego!</h4>';
                        break;

                    default:
                        echo '<div class="alert alert-danger">Opción inválida.</div>';
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero"])) {
                $numero = intval($_POST["numero"]);
                if ($numero < 1 || $numero > 50) {
                    echo '<div class="alert alert-danger">Ingrese un número entre 1 y 50.</div>';
                } else {
                    echo "<h4>Serie Fibonacci ($numero términos):</h4>";
                    echo fibonacci($numero);
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num1_numerador"])) {
                $resultado = calcularFraccionarios(
                    [$_POST["num1_numerador"], $_POST["num1_denominador"]],
                    [$_POST["num2_numerador"], $_POST["num2_denominador"]],
                    [$_POST["num3_numerador"], $_POST["num3_denominador"]],
                    [$_POST["num4_numerador"], $_POST["num4_denominador"]]
                );
                echo "<h4>Resultado de A + B * C - D:</h4>";
                echo $resultado;
            }

            function fibonacci($n) {
                $f1 = 1;
                $f2 = 1;
                $serie = "1 1";
                for ($i = 3; $i <= $n; $i++) {
                    $fn = $f1 + $f2;
                    $serie .= " $fn";
                    $f1 = $f2;
                    $f2 = $fn;
                }
                return $serie;
            }

            function esSumaDeCubos($num) {
                $suma = 0;
                $temp = $num;
                while ($temp > 0) {
                    $digito = $temp % 10;
                    $suma += pow($digito, 3);
                    $temp = intdiv($temp, 10);
                }
                return $suma == $num;
            }

            function calcularFraccionarios($a, $b, $c, $d) {
                // A + B * C - D
                $a_val = $a[0] / $a[1];
                $b_val = $b[0] / $b[1];
                $c_val = $c[0] / $c[1];
                $d_val = $d[0] / $d[1];
                return $a_val + ($b_val * $c_val) - $d_val;
            }
            ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
