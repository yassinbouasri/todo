<?php

namespace App\Model;

class Category extends Model
{

    protected static ?string $table = 'categories';
    private int $id;
    private string $category_name;
    

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
}