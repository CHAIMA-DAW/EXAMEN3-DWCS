// [JAXON-PHP]
function envVoto(usu, pro) {
    id = "spuntos_" + pro;
    var puntos = document.getElementById(id).value;
    
    jaxon_miVoto(usu, pro, puntos);
}

function votoValido(datos) {
    jaxon_pintarEstrellas(datos['media'], datos['pro']);
}

// llamada desde PHP cuando ya ha votado
function preguntarCambio(usu, pro, puntos) {
    if (confirm("Ya has votado ese producto. ¿Desea cambiar su voto?")) {
        jaxon_cambiarVoto(usu, pro, puntos);
    }
}