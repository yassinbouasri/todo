<?php

namespace App\Model\ORM;

use App\Config\Database;
use PDO;
use PDOException;
use PDOStatement;

class FindBy
{

    private const string ORDER_BY_KEY = ":orderByKey";
    private const string ORDER_BY_VALUE = ":orderByValue";

    public static function get(Database $db, string $tableName, Where $where, array $orderBy = [], ?int $offset = null, ?int $limit = null): array
    {
        $sql = "SELECT * FROM {$tableName}";
        $sql .= self::getSqlClauses($where, $orderBy, $limit, $offset);
        $stmt = $db->getConnection()->prepare($sql);
        self::bindParams($orderBy, $limit, $offset, $stmt);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    private static function getSqlClauses(Where $where, array $orderBy, ?int $limit, ?int $offset): string
    {
        $whereClauses = new WhereClause();
        $whereClauses->andWhere($where);
        $sqlClause = $whereClauses->build();
        $sqlClause .= self::addOrderBy($orderBy);
        $sqlClause .= self::addOffsetAndLimit($offset, $limit);
        return $sqlClause;
    }

    private static function addOrderBy(array $orderBy)
    {
        if (!empty($orderBy)) {
            $orderBySql = " ORDER BY";
            $counter = 0;
            foreach ($orderBy as $value) {
                $orderBySql .= sprintf(" %s %s,", (self::ORDER_BY_KEY . $counter), (self::ORDER_BY_VALUE . $counter));
                ++$counter;
            }
            return rtrim($orderBySql, ",");
        }

    }

    private static function addOffsetAndLimit(?int $offset, ?int $limit): string
    {
        if (isset($offset) && isset($limit)) {
            return " LIMIT :limit OFFSET :offset";
        }
        return '';
    }

    private static function bindParams(array $orderBy, ?int $offset, ?int $limit, false|PDOStatement $stmt): void
    {
        $whereClause = new WhereClause();
        $whereClause->bind($stmt);
        self::bindOrderBy($orderBy, $stmt);
        self::bindLimitAndOffset($offset, $limit, $stmt);
    }

    private static function bindOrderBy(array $orderBy, false|PDOStatement $stmt): void
    {
        if (!empty($orderBy)) {
            $counter = 0;
            foreach ($orderBy as $key => $value) {
                $stmt->bindValue(self::ORDER_BY_KEY . $counter, $key);
                $stmt->bindValue(self::ORDER_BY_VALUE . $counter, $value);
            }
        }
    }

    private static function bindLimitAndOffset(?int $offset, ?int $limit, false|PDOStatement $stmt): void
    {
        if (isset($offset) && isset($limit)) {
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
    }
}