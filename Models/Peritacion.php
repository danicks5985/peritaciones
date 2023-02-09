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
            $compan = strtoupper($peritacion['companiaId']);
            $per = strtoupper($peritacion['peritoId']);
            $tot_perit = $this->getImporte($peritacion);

            $local = $this->getLocalidad($peritacion['tallerId']);

            $f_cier = 'NULL';

            $sql = "INSERT INTO peritaciones (taller_id,matricula,f_peritacion,compania_id,perito_id,
                    estado_id,f_cierre,localidad,total_peritacion) 
                    VALUES ($taller,'$matr',DATE(NOW()),$compan,$per,10,$f_cier,
                    '$local',$tot_perit)";
            $res = $this->query($sql);
            return $res;
        }

        // Editar peritación
        public function editPeritacion($form){
            $id = $form['id'];
            $tallerId = $form['tallerId'];
            $matr = strtoupper($form['matricula']);
            $f_perit = $form['f_peritacion'];
            $compan = strtoupper($form['companiaId']);
            $perId = strtoupper($form['peritoId']);
            $f_cierre = $form['f_cierre'];
            $estadoId = $form['estadoId'];
            $kms = ($form['kms'] == '') ? 0 : $form['kms'];
            $total = $form['total'];
            $comentarios = $form['comentarios'];

            $impte_kms = IMPTE_KMS;
            $f_cierre = ($f_cierre == '0000-00-00' || $f_cierre == '') ? 'NULL' : "'$f_cierre'";

            $localidad = $this->getLocalidad($tallerId);

            $sql = "UPDATE peritaciones 
                    SET taller_id=$tallerId,matricula='$matr',f_peritacion='$f_perit',compania_id=$compan,localidad='$localidad',
                    perito_id=$perId,f_cierre=$f_cierre,estado_id=$estadoId,kms=$kms,total_peritacion=$total,
                    importe_kms=$impte_kms*$kms,comentarios=UPPER('$comentarios')
                    WHERE id=$id";
            $res = $this->query($sql);
            return $res;
        }

        // Eliminar peritación
        public function deletePeritacion($id){
            $sql = "DELETE FROM peritaciones WHERE id=$id";
            $res = $this->query($sql);
            return $res;
        }

        // Devolver peritaciones
        public function getAll() {
            $sql = "SELECT p.*, c.nombre AS nombre_compania , t.nombre AS nombre_taller, 
                    pe.nombre as nombre_perito, e.nombre as estado
                    FROM peritaciones p
                    LEFT JOIN peritos pe ON p.perito_id = pe.id
                    LEFT JOIN companias c ON p.compania_id = c.id
                    LEFT JOIN talleres t ON p.taller_id = t.id
                    LEFT JOIN estados e ON p.estado_id = e.id
                    ORDER BY p.id DESC";
            $res = $this->query($sql);
            $peritaciones = $res->fetch_all(MYSQLI_ASSOC);
            return $peritaciones;
        }

        // Devolver peritacion
        public function getPeritacion($id){
            $sql = "SELECT p.*, c.nombre AS nombre_compania , t.nombre AS nombre_taller, e.nombre as estado
                    FROM peritaciones p
                    LEFT JOIN companias c ON p.compania_id = c.id
                    LEFT JOIN talleres t ON p.taller_id = t.id
                    LEFT JOIN estados e ON p.estado_id = e.id
                    WHERE p.id=$id";
            $res = $this->query($sql);
            $row = $res->fetch_assoc();
            return $row;
        } 

        // Calcular importes
        public function getImporte($peritacion){
            $importe = 5;
            if ($peritacion["companiaId"] == 12){
                $importe = 20;
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

        // Devolver los estados
        public function getAllStates() {
            $sql = "SELECT * from estados";
            $res = $this->query($sql);
            $estados = $res->fetch_all(MYSQLI_ASSOC);
            
            return $estados;
        }
    }

?>