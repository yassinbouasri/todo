<?php
declare(strict_types=1);
namespace App\Model;
use App\Config\Database;
use DateTime;
use PDO;

abstract class Model
{
    private PDO $cnn;
    protected string $table;

    public function __construct($table){
        $this->table = $table;
        $this->cnn = Database::getConnection();
    }

    public static function all()
    {
        $instance = new static();
        $sql = "SELECT * FROM {$instance->table}";
        $stmt = $instance->cnn->query($sql);
        $tasks = $stmt->fetchAll(PDO::FETCH_CLASS,get_called_class());
        return $tasks;
    }

    public function save(array $attributes = []): bool
    {

    }

}