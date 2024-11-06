<?php

namespace App\Model\ORM;

use App\Config\Database;
use PDO;

class QueryBuilder
{
    public function __construct()
    {

    }

    public static function build(Database $db,string $table, array $columns, ?string $idName = ""): array
    {
        $query = "";
        $attributes = "";
        $values = "";
        $setPart = "";
        $att = [];
        foreach ($columns as $attribute) {
            $attributes .= ($attribute["COLUMN_NAME"] != 'id') ? $attribute["COLUMN_NAME"].", ":'';
            $values .= ($attribute["COLUMN_NAME"] != 'id') ? ":".$attribute["COLUMN_NAME"].", ":'';
            $setPart .= ($attribute["COLUMN_NAME"] != 'id') ? $attribute["COLUMN_NAME"]." = :".$attribute["COLUMN_NAME"] . ", " :'';
            $att[] = $attribute["COLUMN_NAME"];
        }

        if (!empty($idName)) {
            $query .= "UPDATE {$table} SET " . rtrim($setPart, ', ') . " WHERE {$idName} = :id";
        } else {
            $query .= "INSERT INTO {$table} (" . rtrim($attributes, ', ') . ") VALUES (" . rtrim($values, ', ') . ")";
        }
        return [$query, $att];
    }


}