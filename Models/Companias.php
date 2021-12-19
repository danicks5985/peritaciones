<?
    namespace Companias;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class Companias extends Db
    {
        // Listar registros del dia actual
        public function searchCompania($search) {
            $sql = "SELECT * FROM companias WHERE nombre LIKE '%".$search."%'";
            $res = $this->query($sql);
            return $res;
        }

        // Listar las compañías
        public function getCompanias(){
            $sql = "SELECT * FROM companias";
            $res = $this->query($sql);
            $companias = $res->fetch_all(MYSQLI_ASSOC);
            return $companias;
        }
        
    }

?>