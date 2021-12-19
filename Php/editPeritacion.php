<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Peritacion.php");

  use Peritacion\Peritacion;
    $form = $_POST;
    $res = (new Peritacion())->editPeritacion($form);
    echo json_encode(["ok"=>$res]);
?>