<?php

namespace App\Model\ORM;
use mysql_xdevapi\Exception;
use PDOStatement;

class WhereClause
{
    private const string COLUMN = ":column";
    private const string VALUE = ":value";
    private array $wheres = [];
    public function __construct()
    {
    }

    public function andWhere(Where $where): self
    {
        $this->wheres[] = $where;
        return $this;
    }

    public function build(): string
    {

        $sql = " WHERE ";
        foreach ($this->wheres as $field => $value) {
            $operator = $value->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf(":%s %s :%s AND ", $field, $operator, $field);
            dd($operator);
        }

        $sql = rtrim($sql, "AND ");
        dd($this->wheres);
        return $this;
    }
    public function orWhere(Where $where):self
    {
        $sql = " WHERE ";

        return $this;
    }

    public static function addWhere(array $where):string
    {
        $whereSql = "";
        if(count($where) === 3){
            $columName = $where[0] ;
            $operator = $where[1];
            if(!$operator instanceof Operator){
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
        if(!empty($where)){
            $counter = 0;
            foreach($where as $value){
                $stmt->bindValue(self::COLUMN.$counter, $value->column);
                $stmt->bindValue(self::VALUE.$counter, $value->value);
                ++$counter;
            }
        }
    }
}