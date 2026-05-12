<?php

//require 'Conexion.php';
class Voto extends Conexion {
    public $id;
    public $cantidad;
    public $idPr;
    public $idUs;

    public function __construc() {
        parent::__construct();
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad): void  {
        $this->cantidad = $cantidad;
    }

    /**
     * @param mixed $idPr
     */
    public function setIdPr($idPr): void {
        $this->idPr = $idPr;
    }

    /**
     * @param mixed $idUs
     */
    public function setIdUs($idUs): void {
        $this->idUs = $idUs;
    }

    public function create() {
        $i = "insert into votos(cantidad, idPr, idUs) values(:c, :ip, :iu)";
        $stmt = self::$conexion->prepare($i);

        try {
            $stmt->execute([
                ':c'  => $this->cantidad,
                ':ip' => $this->idPr,
                ':iu' => $this->idUs
            ]);
        } catch (PDOException $ex) {
            die("Error al guardar voto: " . $ex->getMessage());
        }
    }//actualizar votos
       public function update()
    {
        $u = "UPDATE votos
              SET cantidad = :c
              WHERE idPr = :ip AND idUs = :iu";
        $stmt = self::$conexion->prepare($u);
        try {
            $stmt->execute([
                ':c'  => $this->cantidad,
                ':ip' => $this->idPr,
                ':iu' => $this->idUs
            ]);
        } catch (PDOException $ex) {
            die("Error al actualizar voto: " . $ex->getMessage());
        }
    }

    public function getTotalPuntos($p) {
        $c    = "select sum(cantidad) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    public function getTotalVotos($p) {
        $c    = "select count(*) as total from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p'=>$p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->total;
    }

    public function getMedia($p) {
        $c    = "select avg(cantidad) as media from votos where idPr=:p";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p]);
        return ($stmt->fetch(PDO::FETCH_OBJ))->media;
    }

    public function puedeVotar($u, $p)  {
        $c    = "select * from votos where idPr=:p AND idUs=:u";
        $stmt = Conexion::$conexion->prepare($c);

        $stmt->execute([':p' => $p, ':u' => $u]);
        
        $filas = $stmt->rowCount();
        if ($filas == 0) return true;
        return false;
    }
    
    public function topMasVotados($limite = 5)
    {
        $sql = "SELECT p.id, p.nombre_corto,
                       AVG(v.cantidad) AS media,
                       COUNT(*) AS total
                FROM votos v
                JOIN productos p ON p.id = v.idPr
                GROUP BY p.id, p.nombre_corto
                ORDER BY media DESC, total DESC
                LIMIT :lim";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bindValue(':lim', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
