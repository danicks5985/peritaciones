<?
    namespace Peritacion;
    require_once(BASEDIR."/Php/Db.php");

    use Db\Db;

    class Peritacion extends Db
    {

        // Grabar peritación
        public function savePeritacion($peritacion) {
            $taller = strtoupper($peritacion['tallerId']);
            $matr = strtoupper($peritacion['matricula']);
            $f_perit = $peritacion['f_peritacion'];
            $compan = strtoupper($peritacion['companiaId']);
            $per = strtoupper($peritacion['peritoId']);
            $estado = strtoupper($peritacion['estado']);
            $coment = strtoupper($peritacion['comentarios']);
            $kms = $peritacion['kms'];
            $tot_perit = $this->getImporte($peritacion);

            $local = $this->getLocalidad($peritacion['tallerId']);

            $f_cier = 'NULL';
            if ($estado == STE_CERRADA || $estado == STE_ENV_INDX){
                $f_cier = "'". date("Y-m-d") ."'";
            }

            if ($kms == "") $kms = 0;

            $imp_kms = $kms * 0.20;

            $sql = "INSERT INTO peritaciones (taller_id,matricula,f_peritacion,compania_id,perito_id,
                    estado,f_cierre,localidad,comentarios,kms,importe_kms,total_peritacion) 
                    VALUES ($taller,'$matr','$f_perit',$compan,$per,'$estado',$f_cier,
                    '$local','$coment',$kms,$imp_kms,$tot_perit)";
            $res = $this->query($sql);
            return $res;
        }

        // Editar peritación
        public function editPeritacion($form){
            $id = $form['id'];
            $f_cierre = $form['f_cierre'];
            $estado = $form['estado'];
            $kms = $form['kms'];
            $total = $form['total'];
            $comentarios = $form['comentarios'];

            $impte_kms = IMPTE_KMS;
            $f_cierre = ($f_cierre == '0000-00-00' || $f_cierre == '') ? 'NULL' : "'$f_cierre'";
            $sql = "UPDATE peritaciones 
                    SET f_cierre=$f_cierre,estado='$estado',kms=$kms,total_peritacion=$total,
                    importe_kms=$impte_kms*$kms,comentarios=UPPER('$comentarios')
                    WHERE id=$id";
            $res = $this->query($sql);
            return $res;
        }

        // Devolver peritaciones
        public function getAll() {
            $sql = "SELECT p.*, c.nombre AS nombre_compania , t.nombre AS nombre_taller, pe.nombre as nombre_perito
                    FROM peritaciones p
                    INNER JOIN peritos pe ON p.perito_id = pe.id
                    INNER JOIN companias c ON p.compania_id = c.id
                    INNER JOIN talleres t ON p.taller_id = t.id";
            $res = $this->query($sql);
            $peritaciones = $res->fetch_all(MYSQLI_ASSOC);
            return $peritaciones;
        }

        // Devolver peritacion
        public function getPeritacion($id){
            $sql = "SELECT p.*, c.nombre AS nombre_compania , t.nombre AS nombre_taller
                    FROM peritaciones p
                    INNER JOIN companias c ON p.compania_id = c.id
                    INNER JOIN talleres t ON p.taller_id = t.id
                    WHERE p.id=$id";
            $res = $this->query($sql);
            $row = $res->fetch_assoc();
            return $row;
        } 

        // Calcular importes
        public function getImporte($peritacion){
            $importe = 5;
            if ($peritacion["companiaId"] == "2"){
                if ($peritacion['perito'] == 'KIKE' || $peritacion['perito'] == 'ALICIA' || $peritacion['perito'] == 'TELES') {
                    $importe = 3;
                }
            }
            return $importe;
        }

        // Obtener la localidad
        public function getLocalidad($tallerId){
            $sql = "SELECT * FROM talleres WHERE id = $tallerId";
            $res = $this->query($sql);
            $row = $res->fetch_assoc();
            return $row["localidad"];
        }
    }

?>