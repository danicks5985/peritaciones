<?
    // Constantes
    require_once("../constantes.php");
    require_once(BASEDIR."/Models/Talleres.php");

    use Talleres\Talleres;

    if(isset($_POST['search'])){
        $response = array();
        $res = (new Talleres())->searchTaller($_POST['search']);
        while($row = mysqli_fetch_array($res) ){
          $response[] = array("value"=>$row['id'],"label"=>$row['nombre']);
        }
        echo json_encode($response);
    }

?>