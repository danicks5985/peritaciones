<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software peritaciones</title>
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />
    <link href="/peritaciones/static/libs/fontawesome5/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <link href="/peritaciones/static/libs/foundation-datepicker/css/foundation-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.foundation.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.foundation.min.css">
    <link rel="stylesheet" href="/peritaciones/static/css/estilos.css">
</head>

<body>

    <?
    session_start();
    // Establecer timezone y localización
    setlocale(LC_ALL, "es_es.UTF-8");
    date_default_timezone_set("Europe/Madrid");

    // Constantes
    require_once("constantes.php");

    // Variables
    require_once("variables.php");
    
    ?>

    <!-- <ul class="menu" style="background: black;">
        <li><a href="/peritaciones"><i class="far fa-edit"></i> Fichar</a></li>
        <li><a href="/peritaciones/templates/filtrar.php"><i class="fas fa-search"></i> Filtrar</a></li>
    </ul> -->

    <div class="grid-container fluid">
        <!-- Configuración del dashboard -->
        <? include(BASEDIR . "/templates/dashboardConfig.php"); ?>

        <!-- Formulario nueva peritación -->
        <? include(BASEDIR . "/templates/addPeritacionForm.php"); ?>

        <!-- Formulario filtros avanzados -->
        <? include(BASEDIR . "/templates/filtrosAvanzadosForm.php"); ?>

        <!-- Tabla peritaciones -->
        <? include(BASEDIR . "/templates/tablaPeritaciones.php"); ?>

        <!-- Modal ver peritacion -->
        <? include(BASEDIR . "/templates/peritacionModal.php"); ?>
    </div>

    <!-- Compressed JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/js/foundation.min.js" crossorigin="anonymous"></script>
    <script src="/peritaciones/static/libs/foundation-datepicker/js/foundation-datepicker.js"></script>
    <script src="/peritaciones/static/libs/foundation-datepicker/js/locales/foundation-datepicker.es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.foundation.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.4/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.4/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.foundation.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script>
        var variablesJs = JSON.parse('<?= addslashes(json_encode($variablesJs)); ?>');
    </script>
    <script src="/peritaciones/static/js/verPeritacion.js"></script>
    <script src="/peritaciones/static/js/index.js"></script>
    <script src="/peritaciones/static/js/setConfig.js"></script>
    <script src="/peritaciones/static/js/filtrosAvanzados.js"></script>
</body>

</html>