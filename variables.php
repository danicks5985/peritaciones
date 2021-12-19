<?
require_once(BASEDIR . "/Models/Companias.php");
require_once(BASEDIR . "/Models/Talleres.php");
require_once(BASEDIR . "/Models/Peritos.php");

use Companias\Companias;
use Peritos\Peritos;

// Obtener las compañias
$companias = [];
foreach ((new Companias())->getCompanias() as $c) {
    $companias[$c['id']] = $c['nombre'];
}

// Obtener los peritos
$peritos = [];
foreach ((new Peritos())->getPeritos() as $p) {
    $peritos[$p['id']] = $p['nombre'];
}

// Variables js
$variablesJs = [];
$variablesJs['constantes'] = get_defined_constants(true)['user'];
$variablesJs['estados_peritacion'] = [
    STE_AVANCE, STE_CERRADA, STE_ENV_INDX, STE_ENVIADA
];

$variablesJs['companias'] = $companias;
$variablesJs['peritos'] = $peritos;

?>