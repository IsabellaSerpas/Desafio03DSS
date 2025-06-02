<?php
$trimestre = isset($trimestre) ? $trimestre : '';
$estudiante = isset($estudiante) ? $estudiante : ['nombres'=>'', 'apellidos'=>'', 'codigo'=>''];
$semaforo = isset($semaforo) ? $semaforo : '';
$aspectos = isset($aspectos) ? $aspectos : [];
$asistencias = isset($asistencias) ? $asistencias : [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reporte Trimestral</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
        .foto { width: 80px; height: 100px; border: 1px solid #000; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Trimestre <?= $trimestre ?></h2>
    </div>

    <table border="1">
        <tr>
            <td rowspan="2"><img class="foto"></td>
            <td><strong>Estudiante:</strong> <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?></td>
            <td><strong>Carnet:</strong> <?= $estudiante['codigo'] ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; background-color: <?= ($semaforo == 'rojo') ? 'red' : (($semaforo == 'amarillo') ? 'yellow' : (($semaforo == 'verde') ? 'green' : 'blue')) ?>; color: white;">
                <strong>Estado: <?= ucfirst($semaforo) ?></strong>
            </td>
        </tr>
    </table>

    <h3>Aspectos positivos</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($aspectos as $aspecto): 
            if($aspecto['tipo'] == 'P'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($aspecto['fecha'])) ?></td>
            <td><?= $aspecto['descripcion'] ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>

    <h3>Aspectos a mejorar</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Tipo</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($aspectos as $aspecto): 
            if($aspecto['tipo'] != 'P'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($aspecto['fecha'])) ?></td>
            <td><?= $aspecto['descripcion'] ?></td>
            <td><?= $aspecto['tipo'] == 'L' ? 'Leve' : ($aspecto['tipo'] == 'G' ? 'Grave' : 'Muy Grave') ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>

    <h3>Registro de Inasistencia</h3>
    <table>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Tipo</th>
        </tr>
        <?php 
        $contador = 1;
        foreach($asistencias as $asistencia): 
            if($asistencia['tipo'] != 'A'):
        ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= date('d/m/Y', strtotime($asistencia['fecha'])) ?></td>
            <td><?= $asistencia['tipo'] == 'I' ? 'Injustificada' : 'Justificada' ?></td>
        </tr>
        <?php 
            endif;
        endforeach; 
        ?>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>