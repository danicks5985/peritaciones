<?
    session_start();
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Peritacion.php");
    use Peritacion\Peritacion;

    $form = $_POST;
    $res = (new Peritacion)->savePeritacion($form);
    echo json_encode(["ok"=>$res]);
?>