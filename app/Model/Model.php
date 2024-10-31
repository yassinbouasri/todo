<?php
declare(strict_types=1);
namespace App\Model;
use App\Config\Database;
use DateTime;
use mysql_xdevapi\Exception;
use PDO;
use ReflectionClass;
use ReflectionProperty;

abstract class Model
{
    private static $cnn;
    protected static ?string $table = null;


    public function __construct(){
        self::$cnn = Database::getConnection();
    }

    public static function getTable(): string
    {
        if (static::$table === null) {
            throw new Exception("Table not defined" . static::$table);
        }
        return static::$table;
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
        $stmt = self::$cnn->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function save(): bool
    {
        $table = static::getTable();
        $attributes = implode(", ", array_keys( $this->getters()));
        $values = implode(", :", array_keys($this->getters()));
        $idName = array_keys($this->getters())[0];
        $idValue = array_values($this->getters())[0];

        if (isset($idName)) {
            //Update task with given id
            $setParts = implode(', ', array_map(fn($col) => "{$col} = :{$col}", array_keys($this->getters())));
            $sql = "UPDATE " . $table . " SET " . $setParts . " WHERE ". $idName . " = :" . $idName;
            echo $sql;
            $stmt = self::$cnn->prepare($sql);
            $stmt->bindValue(':'.$idName, $idValue); // Bind primary key

        } else {
            $sql = "INSERT INTO " . $table . " (" . $attributes . ") VALUES (:" . $values . ")";
            $stmt = self::$cnn->prepare($sql);

        }
        foreach ($this->getters() as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        return $stmt->execute();
    }

    public function getters(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = [];
        foreach ($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {

            $property->setAccessible(true);
            $properties[$property->getName()] = $property->getValue($this);
        }

        return $properties;
    }

    protected abstract static function mapAll(array $data): array;

    protected abstract static function mapOne($data) ;

}