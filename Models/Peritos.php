<?
    namespace Peritos;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class Peritos extends Db
    {
        // Listar los peritos
        public function getPeritos(){
            $sql = "SELECT * FROM peritos";
            $res = $this->query($sql);
            $peritos = $res->fetch_all(MYSQLI_ASSOC);
            return $peritos;
        }
        
    }

?>