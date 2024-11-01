<?php
declare(strict_types=1);
namespace App\Model;
use App\Config\Database;
use DateTime;
use mysql_xdevapi\Exception;
use PDO;
use PDOException;
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
            //ex: ["id","=",1]
            $sql .= " AND ";
            foreach ($where as $key) {
                $sql .= "{$key}";
            }
        }
        if(!empty($orderBy)){
            foreach ($orderBy as $key => $value) {
                $sql .= " ORDER BY {$key} {$value}";
            }
        }
        $stmt = self::$cnn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function save(): bool
    {
        $table = static::getTable();
        $attributes = implode(", ", array_keys( $this->getters()));
        $values = implode(", :", array_keys($this->getters()));
        $idName = "";

        //Getting id name from the getters method
        foreach (array_keys($this->getters()) as $key) {
            echo $key;
            $idName .= ($key === 'id') ? $key : "";
        }
        //Update the table if the id is found in returned properties if no id is found then it is an insert
        if (!empty($idName)) {
            $idValue = array_values($this->getters())[0];
            $setParts = implode(', ', array_map(fn($col) => "{$col} = :{$col}", array_keys($this->getters())));
            $sql = "UPDATE " . $table . " SET " . $setParts . " WHERE ". $idName . " = :" . $idName;
            $stmt = self::$cnn->prepare($sql);
            $stmt->bindValue(':'.$idName, $idValue); // Bind id

        } else {
            $sql = "INSERT INTO " . $table . " (" . $attributes . ") VALUES (:" . $values . ")";
            $stmt = self::$cnn->prepare($sql);

        }
        //Binding the values
        foreach ($this->getters() as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        return $stmt->execute();
    }
    public function delete(): bool
    {
        $table = static::getTable();
        $attributes = implode(", ", array_keys( $this->getters()));
        $values = implode(", :", array_keys($this->getters()));
        $idName = "";
        foreach (array_keys( $this->getters()) as $key) {
            $idName .= ($key === 'id') ? $key : "";
        }
        if (!empty($idName)) {
            $idValue = array_values($this->getters())[0];
            $sql = "DELETE FROM " . $table . " WHERE " . $idName . " = :" . $idName;
            $stmt = self::$cnn->prepare($sql);
            $stmt->bindValue(':'.$idName, $idValue);
        } else {
            echo "No id property has been found!";
            return false;
        }
        return $stmt->execute();

    }

    public static function findAll(): array
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table} WHERE 1 = 1";
        try {
            $stmt = self::$cnn->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public  function getters(): array
    {
        //using Reflection class to return an array of properties and values of the child class //TODO: make this method static
        $reflection = new ReflectionClass($this);
        $properties = [];
        foreach ($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {

            if ($property->isInitialized($this)) {
                $value = $property->getValue($this);

                // Add only non-null initialized properties, avoiding the "\Child::$property must not be accessed before initialization" error
                if ($value !== null) {
                    $properties[$property->getName()] = $value;
                }
            }
        }

        return $properties;
    }



    protected abstract static function mapAll(array $data): array;

    protected abstract static function mapOne($data) ;

}