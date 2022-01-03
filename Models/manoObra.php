<?
    namespace ManoObra;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class ManoObra extends Db
    {

        // Devolver peritaciones
        public function getManoObra($form) {
            $sql = "SELECT * FROM mano_obra 
                    WHERE taller_id = {$form['taller_id']} 
                    AND compania_id = {$form['compania_id']}";
            $res = $this->query($sql);
            $mo = $res->fetch_assoc();
            return $mo;
        }
    }

?>