
<?php
function calcularSemaforo($aspectos) {
    $positivos = 0;
    $leves = 0;
    $graves = 0;
    $muy_graves = 0;
    $inasistencias = 0;

    foreach ($aspectos as $aspecto) {
        switch ($aspecto["tipo"]) {
            case "P": $positivos++; break;
            case "L": $leves++; break;
            case "G": $graves++; break;
            case "MG": $muy_graves++; break;
            case "I": $inasistencias++; break;
        }
    }

    if ($positivos >= 4 && ($leves <= 1 || $inasistencias <= 1)) {
        return "Azul";
    } elseif ($leves <= 2 && $inasistencias <= 2) {
        return "Verde";
    } elseif ($leves >= 6 || $inasistencias >= 4 || $graves >= 1) {
        return "Amarillo";
    } elseif ($muy_graves >= 1 || $graves >= 2 || $leves >= 12 || $inasistencias >= 8) {
        return "Rojo";
    }

    return "Indeterminado";
}
?>