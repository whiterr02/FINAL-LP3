<?php
include_once "db.php";
class Cliente
{
    public int $id;
    public string $razonSocial;
    public String $ci;

    public function __construct(int $id, string $razon_social, string $ci)
    {
        $this->id = $id;
        $this->razonSocial = $razon_social;
        $this->ci = $ci;
    }
}
class ClienteRepo
{
    private $db;
    public function __construct()
    {
        $this->db = getDB();
    }

    public function create(string $razonsocial, string $ci)
    {
        $stmt = $this->db->prepare("INSERT INTO cliente (razon_social, ci) values (?, ?)");
        $stmt->execute([$razonsocial, $ci]);
    }

    public function getById(int $id): ?Cliente
    {
        $stmt = $this->db->prepare("SELECT * FROM cliente where id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Cliente($row['id'], $row['razon_social'], $row['ci']);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM cliente WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function update(int $id, string $razonsocial, string $ci)
    {
        $stmt = $this->db->prepare("UPDATE cliente SET razon_social = ?, ci = ? WHERE id = ?");
        return $stmt->execute([$razonsocial, $ci, $id]);
    }

    /**
     * @return Cliente[] array de Clientes
     */
    public function all(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM cliente");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clientes = [];
        foreach ($rows as $row) {
            $clientes[] = new Cliente($row['id'], $row['razon_social'], $row['ci']);
        }

        return $clientes;
    }
}
