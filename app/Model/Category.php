<?php

namespace App\Model;

class Category extends Model
{

    protected static ?string $table = 'categories';
    public ?int $id;
    public ?string $category_name;

    public function __construct(?int $id = null, ?string $category_name = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->category_name = $category_name;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->category_name = $categoryName;
    }

    protected static function mapAll(array $data): array
    {
        return [];
    }

    protected static function mapOne( $data)
    {

    }

    protected static function getTable(): string
    {
        if (static::$table !== null) {
            return static::$table;
        }
        return "Table not defined!";
    }
}