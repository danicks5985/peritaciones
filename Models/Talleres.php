<?
    namespace Talleres;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class Talleres extends Db
    {
        // Buscar taller
        public function searchTaller($search) {
            $sql = "SELECT * FROM talleres WHERE nombre LIKE '%".$search."%'";
            $res = $this->query($sql);
            return $res;
        }

        // Devolver lista talleres
        public function getAll(){
            $sql = "SELECT * FROM talleres";
            $res = $this->query($sql);
            $talleres = $res->fetch_all(MYSQLI_ASSOC);
            return $talleres;
        }
    }

?>