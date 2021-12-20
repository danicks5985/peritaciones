<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Peritacion.php");

  use Peritacion\Peritacion;
    $id = $_GET['id'];
    $res = (new Peritacion())->deletePeritacion($id);
    echo json_encode(["ok"=>$res]);
?>