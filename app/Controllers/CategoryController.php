<?php
declare(strict_types=1);
namespace App\Controllers;



use App\Model\CategoryRepository;

class CategoryController extends Controller
{

    private CategoryRepository $categoryRepository;
    public function __construct(){
        $this->categoryRepository = new CategoryRepository();
    }
    public function index(): void
    {
        $categories = $this->categoryRepository->getAllCategories();

        require_once __DIR__ . "/../../views/categories/showCategory.tmpl.php";
    }

    public function create(): void
    {
        $alertMessage = "";
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
        $this->render("categories/addCategory", [
            "categoryName" => $categoryName,
            "alertMessage" => $alertMessage
        ]);

    }

    public function remove(): void
    {
        $alertMessage = "";
        $categoryId = (int)$_POST['category_id'] ?? null;
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $deleted = $this->categoryRepository->deleteCategory($categoryId);

            if($deleted){
                header("location: /category/show");
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }
        }
        $this->render("categories/showCategory", [
            "categoryId" => $categoryId,
            "alertMessage" => $alertMessage
        ]);

    }

    public function getCategoryById(int $category_id): array|null
    {
            return ($category_id) ? $this->categoryRepository->getCategoryById($category_id): null;
    }

    public function update(int $id): void
    {
        $alertMessage = "";
        $category = $this->categoryRepository->getCategoryById($id);
        $categoryId = (int)$category['id'] ?? null;
        $categoryName = $category['category_name'] ?? null;


        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = (int)$_POST['category_id'] ?? $categoryId;
            $name = $_POST['category_name'];

            $updated = $this->categoryRepository->updateCategory($name, $id);
            $categoryId = (int)$category['id'];
            $category = $this->getCategoryById($categoryId);
            $categoryName = $category['category_name'];
            $alertMessage = ($updated) ? "<div class='alert alert-success' role='alert'>Category updated successfully!</div>":
                            "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
        }
        $this->render("categories/editCategory",[
            "categoryId" => $categoryId,
            "categoryName" => $categoryName,
            "alertMessage" => $alertMessage
        ]);
    }

}