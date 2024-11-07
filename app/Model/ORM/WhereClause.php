<?php

namespace App\Model\ORM;
use PDOStatement;

readonly class WhereClause
{
    private const string WHERE_COLUMN = ":wherecolumn";
    private const string WHERE_VALUE = ":wherevalue";
    public function __construct(public string $column, public Operator $operator,public string|float|int $value)
    {
    }

    public static function addWhere(array $where):string
    {
        $whereSql = "";
        if(!empty($where)){
            $counter = 0;
            foreach($where as $value){
                $whereSql = sprintf("%s %s %s", self::WHERE_COLUMN.$counter, $value->operator->value, self::WHERE_VALUE.$counter); ;
                ++$counter;
            }
            return rtrim($whereSql, 'AND');
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