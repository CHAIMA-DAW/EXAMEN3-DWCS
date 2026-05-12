<?php
spl_autoload_register(function($clase){
    include $clase . ".php";
});

require __DIR__ . '/../vendor/autoload.php';

use Jaxon\Jaxon;
use function Jaxon\jaxon;

$jaxon = jaxon();
$jaxon->setOption('plugins.jquery.enable', true); // NECESARIO PARA jQuery4PHP

function miVoto($u, $p, $c)
{
    $resp = jaxon()->newResponse();

    if(strlen($u)==0 || strlen($p)==0){
        $resp->alert("Ni el usuario ni el producto pueden estar vacíos!!!");
        return $resp;
    }

    $voto = new Voto();

    if($voto->puedeVotar($u,$p)){
        $voto->setIdPr($p);
        $voto->setIdUs($u);
        $voto->setCantidad($c);
        $voto->create();

        $datos = [
            'pro' => $p,
            'media' => $voto->getMedia($p)
        ];
        $resp->call('votoValido', $datos);

           // Animación JQuery4PHP: ocultar y mostrar fila
            $jq = $resp->jQuery("#fila_$p");
            $jq->hide(1000)->show(1000);
        } else {
            // Ya ha votado: preguntar si desea cambiar
            $resp->call('preguntarCambio', $u, $p, $c);
        }

    return $resp;
}

function cambiarVoto($u,$p,$c)
{
    $resp = jaxon()->newResponse();

    $voto = new Voto();
    $voto->setIdPr($p);
    $voto->setIdUs($u);
    $voto->setCantidad($c);
    $voto->update();

    $datos = [
        'pro' => $p,
        'media' => $voto->getMedia($p)
    ];
    $resp->call('votoValido', $datos);

    // ANIMACIÓN
    $jq = $resp->jQuery("#fila_$p");
    $jq->hide(1000)->show(1000);

    $voto = null;

    return $resp;
}

function pintarEstrellas($c,$p)
{
    $voto = new Voto();
    $total = $voto->getTotalVotos($p);

    $resp = jaxon()->newResponse();

    $en = intval($c);
    $dec = $c - $en;

    $html = "$total Valoraciones. ";

    for($i=1;$i<=$en;$i++){
        $html .= "<i class='fas fa-star'></i>";
    }
    if($dec>=0.5){
        $html .= "<i class='fas fa-star-half-alt'></i>";
    }

    $resp->assign("votos$p","innerHTML",$html);
    return $resp;
}

function masVotados()
{
    $resp = jaxon()->newResponse();

    $voto = new Voto();
    $lista = $voto->topMasVotados(5);

    if(count($lista)==0){
        $resp->assign("masVotados","innerHTML","<p>No hay votos aún.</p>");
        return $resp;
    }

    $html = "<ul>";
    foreach($lista as $l){
        $html .= "<li>{$l->nombre_corto} - Media: ".number_format($l->media,2)." ({$l->total} votos)</li>";
    }
    $html .= "</ul>";

    $resp->assign("masVotados","innerHTML",$html);
    return $resp;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION,'miVoto');
$jaxon->register(Jaxon::CALLABLE_FUNCTION,'cambiarVoto');
$jaxon->register(Jaxon::CALLABLE_FUNCTION,'pintarEstrellas');
$jaxon->register(Jaxon::CALLABLE_FUNCTION,'masVotados');

if($jaxon->canProcessRequest()){
    $jaxon->processRequest();
}