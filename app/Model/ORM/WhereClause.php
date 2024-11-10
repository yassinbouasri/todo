<?php

namespace App\Model\ORM;
use mysql_xdevapi\Exception;
use PDOStatement;

readonly class WhereClause
{
    private const string WHERE_COLUMN = ":wherecolumn";
    private const string WHERE_VALUE = ":wherevalue";
    public function __construct(public string $column, public Operator $operator,public string|float|int $value)
    {
    }

    public function andWhere(Where $where):self
    {
        $sql = " WHERE ";
        foreach ($where as $field => $value) {
            $operator = $this->operator;
            if ($value instanceof Operator) {
                $operator = $value->operator->value;
            }
            $sql .= $field->column . $operator . $field->value ." OR ";
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