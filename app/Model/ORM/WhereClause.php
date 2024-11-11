<?php

namespace App\Model\ORM;

use mysql_xdevapi\Exception;
use PDOStatement;

class WhereClause
{
    private const string COLUMN = ":column";
    private const string VALUE = ":value";
    private array $andWheres = [];
    private array $orWheres = [];

    public function __construct()
    {
    }

    public static function addWhere(array $where): string
    {
        $whereSql = "";
        if (count($where) === 3) {
            $columName = $where[0];
            $operator = $where[1];
            if (!$operator instanceof Operator) {
                throw new Exception("Invalid operator");
            }
            $value = $where[2];
            $whereSql = sprintf("%s %s %s", self::COLUMN, $operator->value, self::VALUE);
            return $whereSql;
        }
        return "";
    }

    public static function bindWhere(array $where, PDOStatement $stmt): void
    {
        if (!empty($where)) {
            $counter = 0;
            foreach ($where as $value) {
                $stmt->bindValue(self::COLUMN . $counter, $value->column);
                $stmt->bindValue(self::VALUE . $counter, $value->value);
                ++$counter;
            }
        }
    }

    public function andWhere(Where $where): self
    {
        $this->andWheres[] = $where;
        return $this;
    }

    public function orWhere(Where $where): self
    {
        $this->orWheres[] = $where;
        return $this;
    }

    public function build(): string
    {

        $sql = " WHERE ";
        $sql = $this->getAnds($sql);
        return $this->getOrs($sql);
    }

    public function getAnds(string $sql): string
    {
        if (empty($this->andWheres)) {
            return "";
        }
        foreach ($this->andWheres as $field => $value) {
            $operator = $value->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf(":%s %s :%s AND ", $value->column, $operator, $value->column);
        }
        return rtrim($sql, "AND ");
    }

    public function getOrs(string $sql): string
    {
        if (empty($this->orWheres)) {
            return "";
        }
        foreach ($this->orWheres as $field => $value) {
            $operator = $value->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf(" OR :%s %s :%s ", $value->column, $operator, $value->column);
        }
        return $sql;
    }

    /**
     * @param string $sql
     * @return string
     */

}