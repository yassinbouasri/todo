<?php
declare(strict_types=1);

namespace App\Model;

use App\Config\Database;
use App\Model\ORM\FindBy;
use App\Model\ORM\QueryBuilder;
use BackedEnum;
use DateTime;
use mysql_xdevapi\Exception;
use PDO;
use PDOException;
use PDOStatement;

abstract class Model
{
    protected static ?string $table = null;
    private static Database $db;

    public function __construct()
    {
        self::$db = Database::getInstance();
    }

    public static function findBy(array $where = [], array $orderBy = [], ?int $offset = null, ?int $limit = null): array
    {
        $instance = new static();
        return FindBy::get(self::$db, $instance::$table, $where, $orderBy, $offset, $limit);
    }

    public static function findAll(): array
    {
        $table = static::getTable();
        $sql = "SELECT * FROM {$table}";
        $stmt = self::$db->getConnection()->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function getTable(): string
    {
        if (static::$table === null) {
            throw new Exception("Table not defined" . static::$table);
        }
        return static::$table;
    }

    public static function count(): mixed
    {
        $table = static::getTable();
        $sql = "SELECT COUNT(*) FROM {$table}";
        $stmt = self::$db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    protected abstract static function mapAll(array $data): array;

    protected abstract static function mapOne($data);

    public function save(): bool
    {
        $table = static::getTable();
        if ($this->getId() !== null) {
            list($sql, $attr) = QueryBuilder::buildSave($table, self::attributes(), "id");
        } else {
            list($sql, $attr) = QueryBuilder::buildSave($table, self::attributes());
            unset($attr[0]);
        }
        $stmt = self::$db->getConnection()->prepare($sql);
        $this->bindValues($stmt, $attr);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }

    }

    public static function attributes(): array
    {
        $instance = new static();
        $sql = "SELECT * FROM information_schema.columns WHERE table_schema = 'todo' AND table_name = '{$instance::$table}'";
        $stmt = self::$db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function bindValues(PDOStatement $stmt, array $attr): void
    {
        foreach ($attr as $key) {
            $parts = explode("_", $key);
            $getter = "get" . ucfirst($parts[0]) . ucfirst($parts[1] ?? "");
            if (!$this->{$getter}() instanceof DateTime) {
                $stmt->bindValue(":{$key}", ($this->{$getter}() instanceof BackedEnum) ? ($this->{$getter}()->value) : $this->{$getter}());
            } else {

                $stmt->bindValue(":{$key}", $this->{$getter}()->format('Y-m-d H:i'));
            }
        }

    }

    public function delete(): bool
    {
        $table = static::getTable();
        $id = $this->getId() ?? null;
        if ($id !== null) {
            $sql = QueryBuilder::buildDelete($table);
            $stmt = self::$db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
        } else {
            echo "No id property has been found!";
            return false;
        }
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }

    }

}