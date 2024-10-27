<?php
declare(strict_types=1);
namespace App\Controllers;



use App\Model\CategoryRepository;

class CategoryController
{

    private CategoryRepository $categoryRepository;
    public function __construct(){
        $this->categoryRepository = new CategoryRepository();
    }
    public function index(): void
    {
        $categories = $this->categoryRepository->getAllCategories();

        require_once __DIR__ . "/../../views/categories/showCategory.php";
    }

    public function create(): void
    {

        $categoryName = $_POST['category_name'] ?? null;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($categoryName)) {
                header("HTTP/1.1 400 Bad Request");
                exit();
            }
            $result = $this->categoryRepository->addCategory($categoryName);
            $alertMessage = ($result) ? "<div class='alert alert-success' role='alert'>Category added successfully!</div>":
                "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";

        }

        require_once __DIR__ . "/../../views/categories/addCategory.php";
    }

    public function remove(): void
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $categoryId = $_POST['category_id'] ?? null;
            $deleted = $this->categoryRepository->deleteCategory($categoryId);

            if($deleted){
                header("location: /category/show");
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }
        }
        require_once __DIR__ . "/../../views/categories/showCategory.php";
    }

    public function getCategoryById(): mixed
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $category_id = $_POST['category_id'] ?? null;
        } else {
            $category_id = $_GET['category_id'] ?? null;

        }
        return $this->categoryRepository->getCategoryById($category_id);

    }

    public function update(int $id): void
    {
        $alertMessage = "";
        $category = $this->categoryRepository->getCategoryById($id);
        $categoryId = $category['id'] ?? null;
        $categoryName = $category['category_name'] ?? null;


        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];

            $updated = $this->categoryRepository->updateCategory($name, $id);
            $category = $this->getCategoryById();
            $categoryId = $category['id'];
            $categoryName = $category['category_name'];
            $alertMessage = ($updated) ? "<div class='alert alert-success' role='alert'>Category updated successfully!</div>":
                            "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
        }
        require_once __DIR__ . "/../../views/categories/editCategory.php";
    }

}