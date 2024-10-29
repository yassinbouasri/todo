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

    public static function findBy($where = [], $orderBy = []): array
    {

        $instance = new static();
        $sql = "SELECT * FROM {$instance->table} WHERE 1=1";
        if(!empty($where)){
            $sql .= " AND ";
            foreach ($where as $key => $value) {
                $sql .= "{$key} = :{$key}";
            }
        }
        $stmt = $instance->cnn->prepare($sql);
        $stmt->execute($where);
        return static::mapAll($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function save(array $attributes = []): bool
    {
        return true;
    }

    protected abstract static function mapAll(array $data): array;

    protected abstract static function mapOne(array $data): static;

}