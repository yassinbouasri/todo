<?php

namespace App\Model\ORM;
use mysql_xdevapi\Exception;
use PDOStatement;

readonly class WhereClause
{
    private const string WHERE_COLUMN = ":wherecolumn";
    private const string WHERE_VALUE = ":wherevalue";
    public function __construct()
    {
    }

    public function andWhere(Where $where): self
    {
        $sql = " WHERE ";
        foreach ($where as $field => $value) {
            $operator = $where->operator;
            if ($operator instanceof Operator) {
                $operator = $operator->value;
            }
            $sql .= sprintf("%s %s %s", $field, $operator, $value);
        }

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
            $whereSql = sprintf("%s %s %s", self::WHERE_COLUMN, $operator->value, self::WHERE_VALUE);
            return $whereSql;
        }
        return "";
    }

    public static function bindWhere(array $where, PDOStatement $stmt): void
    {
        if(!empty($where)){
            $counter = 0;
            foreach($where as $value){
                $stmt->bindValue(self::WHERE_COLUMN.$counter, $value->column);
                $stmt->bindValue(self::WHERE_VALUE.$counter, $value->value);
                ++$counter;
            }
        }
    }
}