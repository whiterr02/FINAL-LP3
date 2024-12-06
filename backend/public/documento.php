<?php
// nota-remision.php
class NotaRemisionRepo
{
    private $db;

    public function __construct()
    {
        $this->db = getDB();
    }

    public function create(int $clienteId, int $productoId)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO nota_remision (fecha, id_cliente, id_producto) VALUES (NOW(), ?, ?)"
        );
        $stmt->execute([$clienteId, $productoId]);
        return $this->db->lastInsertId();
    }
}
