<?php
include_once "db.php";

class Usuario
{
    public int $id;
    public string $user;
    public string $password;

    public function __construct(int $id, string $user, string $password)
    {
        $this->id = $id;
        $this->user = $user;
        $this->password = $password;
    }
}

class UsuarioRepo
{
    private $db;

    public function __construct()
    {
        $this->db = getDB();
    }

    public function login(string $user, string $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE user = ?");
        $stmt->execute([$user]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return new Usuario($usuario['id'], $usuario['user'], $usuario['password']);
        }
        return null;
    }

    public function create(string $user, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuario (user, password) VALUES (?, ?)");
        $stmt->execute([$user, $hashedPassword]);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE usuario SET password = ? WHERE id = ?");
        return $stmt->execute([$hashedPassword, $id]);
    }
}
