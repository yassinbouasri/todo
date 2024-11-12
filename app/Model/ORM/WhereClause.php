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
        $sql .= $this->getOrs($sql);
        return $sql;
    }

    private function getAnds(string $sql): string
    {
        if (empty($this->andWheres)) {
            return "";
        }
        foreach ($this->andWheres as $where => $value) {
            $operator = $value->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf("%s %s :%s AND ", $value->column, $operator, $value->column);
        }
        return rtrim($sql, "AND ");
    }

    private function getOrs(string $sql): string
    {
        if (empty($this->orWheres)) {
            return "";
        }
        foreach ($this->orWheres as $field => $value) {
            $operator = $value->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf(" OR %s %s :%s ", $value->column, $operator, $value->column);
        }
        return $sql;
    }

    public function bind(false|PDOStatement $stmt): void
    {
        $this->bindAnds($stmt);
        $this->bindOrs($stmt);
    }

    /**
     * @param false|PDOStatement $stmt
     * @return void
     */
    private function bindAnds(false|PDOStatement $stmt): void
    {
        if (empty($this->andWheres)) {
            return;
        }

        foreach ($this->andWheres as $where) {
            $stmt->bindvalue(":" . $where->column, $where->value);

        }
    }

    /**
     * @param false|PDOStatement $stmt
     * @return void
     */
    private function bindOrs(false|PDOStatement $stmt): void
    {
        if (empty($this->orWheres)) {
            return;
        }
        foreach ($this->orWheres as $where) {
            $stmt->bindvalue(":" . $where->column, $where->column);
        }
    }

}