<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Companias.php");

    use Companias\Companias;

    $companias = (new Companias())->getCompanias();
    echo json_encode($companias);
    
?>