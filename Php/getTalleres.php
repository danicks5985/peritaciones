<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Talleres.php");

    use Talleres\Talleres;
  
    $talleres = (new Talleres())->getAll();
    echo json_encode($talleres);
  
?>