<?php
include_once "db.php";
class Producto
{
    public int $id;
    public string $marca;
    public String $modelo;
    public string $año;
    public String $color;
    public string $chasis;

    public function __construct(int $id, string $marca, string $modelo, string $año, string $color, string $chasis)
    {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año = $año;
        $this->color = $color;
        $this->chasis = $chasis;
    }
}
class ProductoRepo
{
    private $db;
    public function __construct()
    {
        $this->db = getDB();
    }

    public function create(string $marca, string $modelo, string $año, string $color, string $chasis)
    {
        $stmt = $this->db->prepare("INSERT INTO producto (marca, modelo, año, color, chasis) values (?, ?, ?, ?, ?)");
        $stmt->execute([$marca, $modelo, $año, $color, $chasis]);
    }

    public function getById(int $id): ?Producto
    {
        $stmt = $this->db->prepare("SELECT * FROM producto where id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Producto($row['id'], $row['marca'], $row['modelo'], $row['año'], $row['color'], $row['chasis']);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM producto WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function update(int $id, string $marca, string $modelo, string $año, string $color, string $chasis)
    {
        $stmt = $this->db->prepare("UPDATE producto SET marca = ?, modelo = ?, año = ?, color = ?, chasis = ? WHERE id = ?");
        return $stmt->execute([$marca, $modelo, $año, $color, $chasis, $id]);
    }

    /**
     * @return Producto[] array de Producto
     */
    public function all(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM producto");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = [];
        foreach ($rows as $row) {
            $productos[] = new Producto($row['id'], $row['marca'], $row['modelo'], $row['año'], $row['color'], $row['chasis']);
        }

        return $productos;
    }
}
