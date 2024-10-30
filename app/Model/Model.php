<?php
declare(strict_types=1);
namespace App\Model;
use App\Config\Database;
use DateTime;
use PDO;

abstract class Model
{
    private PDO $cnn;
    protected static string $table;

    public function __construct(){
        $this->cnn = Database::getConnection();
    }

    public static function findBy($where = [], $orderBy = []): array
    {

        $instance = new static();
        $sql = "SELECT * FROM {$instance::$table} WHERE 1=1";
        if(!empty($where)){
            $sql .= " AND ";
            foreach ($where as $key => $value) {
                $sql .= "{$key} = :{$key}";
            }
        }
        if(!empty($orderBy)){
            foreach ($orderBy as $key => $value) {
                $sql .= " ORDER BY {$key} {$value}";
            }
        }
        $stmt = $instance->cnn->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function save(array $data): bool
    {
        if (isset($data["id"])) {
            //Update task with given id
            $setPart = [];
            foreach ($data as $key => $value) {
                if ($key !== "id") {
                    $setPart[] = "{$key} = :{$key}";
                }
            }
            $setStr = implode(', ', $setPart);

        }
        return true;
    }

    protected abstract static function mapAll(array $data): array;

    protected abstract static function mapOne($data) ;

}