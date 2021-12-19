<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Companias.php");

    use Companias\Companias;

    if(isset($_POST['search'])){
        $response = array();
        $res = (new Companias())->searchCompania($_POST['search']);
        while($row = mysqli_fetch_array($res) ){
          $response[] = array("value"=>$row['id'],"label"=>$row['nombre']);
        }
        echo json_encode($response);
    }

?>