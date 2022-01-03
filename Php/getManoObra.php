<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/manoObra.php");

  use ManoObra\ManoObra;
    $form = $_POST; 
    $mo = (new ManoObra())->getManoObra($form);
    echo json_encode(["data"=>$mo]);
?>