<?php
namespace Clases;

use PDO;
use PDOException;

class OperacionesExamen6
{
    private PDO $con;

    public function __construct()
    {
        $host = "localhost";
        $db   = "examen06";
        $user = "admin06";
        $pass = "secreto";

        $dsn = "mysql:host=localhost;port=3306;dbname=examen06;charset=utf8mb4";

        try {
            $this->con = new PDO($dsn, $user, $pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new \Exception("Error de conexión a BD");
        }
    }
/**
 * Devuelve un array con los nombres completos de los jugadores
 * que tienen la posición indicada (Portero, Defensa, ...).
 *
 * @soap
 * @param string $posicion
 * @return array
 */
public function getPosicion(string $posicion): array
{
    $sql = "SELECT CONCAT(apellidos, ', ', nombre) AS nombreCompleto
            FROM jugadores
            WHERE posicion = :p
            ORDER BY apellidos, nombre";

    $stmt = $this->con->prepare($sql);
    $stmt->execute([':p' => $posicion]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

}