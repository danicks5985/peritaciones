<?
    session_start();
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Peritacion.php");
    use Peritacion\Peritacion;
    
    if (isset($_POST["grabar_peritacion"])){
        (new Peritacion)->savePeritacion($_POST);
        header("Location: ".BASEURL);
        die();
    }  
?>