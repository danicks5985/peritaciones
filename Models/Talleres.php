<?
    namespace Talleres;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class Talleres extends Db
    {
        // Listar registros del dia actual
        public function searchTaller($search) {
            $sql = "SELECT * FROM talleres WHERE nombre LIKE '%".$search."%'";
            $res = $this->query($sql);
            return $res;
        }
    }

?>