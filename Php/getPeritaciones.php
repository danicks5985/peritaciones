<?
    // Constantes
    require("../constantes.php");
    require(BASEDIR."/Models/Peritacion.php");

  use Peritacion\Peritacion;

    $peritaciones = (new Peritacion())->getAll();
    echo json_encode(["data"=>$peritaciones]);
?>