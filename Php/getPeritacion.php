<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Peritacion.php");

  use Peritacion\Peritacion;
    $id = $_GET["id"]; 
    $peritacion = (new Peritacion())->getPeritacion($id);
    echo json_encode(["data"=>$peritacion]);
?>