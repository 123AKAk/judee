<?php

require_once('../database/conn.php');

$namespace = $_POST['namespace'];

if($namespace != '')
{
    if($namespace == "addProduct") 
    {
        $name = $_POST['name'];
		$category_name = $_POST['productcategory'];
		$description = $_POST['description'];
		$slug = $_POST['slug'];
		$price = $_POST['price'];

        $productimage1 = $_POST['productimage1'];
        $productimage2 = $_POST['productimage2'];
        $productimage3 = $_POST['productimage3'];
        $productimage4 = $_POST['productimage4'];

        require_once('../custom_model/sharedComponents.php');
        require '../custom_model/ProductModel.php';
        $model = new Products();
        
        $result = $model->addProduct($category_name, $name, $description, $slug, $price, 'photo1', 'photo2', 'photo3', 'photo4', $productimage1, $productimage2, $productimage3, $productimage4);
        echo json_encode($result);
    }
    else if($namespace == "editProduct")
    {
        $name = $_POST['name'];
		$category_name = $_POST['productcategory'];
		$description = $_POST['productdescription'];
		$slug = $_POST['slug'];
		$price = $_POST['price'];

		$productimage1 = $_POST['productimage1'];
        $productimage2 = $_POST['productimage2'];
        $productimage3 = $_POST['productimage3'];
        $productimage4 = $_POST['productimage4'];

        require_once('../custom_model/sharedComponents.php');
        require '../custom_model/ProductModel.php';
        $model = new Products();
        
        $result = $model->editProduct($_POST['id'], $category_name, $name, $description, $slug, $price, 'photo1', 'photo2', 'photo3', 'photo4', $productimage1, $productimage2, $productimage3, $productimage4);
        echo json_encode($result);
    }
    else if($namespace == "deleteProduct")
    {
        require_once('../custom_model/sharedComponents.php');
        require '../custom_model/ProductModel.php';
        $model = new Products();
        
        $result = $model->deleteProduct($_POST['id'], $_POST['catid']);
        echo json_encode($result);
    }
    else if($namespace == "deleteSale")
    {
        require_once('../custom_model/sharedComponents.php');
        require '../custom_model/SalesModel.php';
        $model = new Sales();
        
        $result = $model->deleteSale($_POST['id']);
        echo json_encode($result);
    }
    else if($namespace == "deleteUser")
    {
        require_once('../custom_model/sharedComponents.php');
        require '../../custom_model/userAccountModel.php';
        $model = new Users();
        
        $result = $model->deleteUser($_POST['id']);
        echo json_encode($result);
    }
    else
    {
        $result = ['response'=> false, 'message'=> 'Prevented: Adultrated Request Received! (No try am Again)'];
        echo json_encode($result);
    }
}
else
{
    $result =  ['response' => false, 'message' => 'Prevented: Adultrated Request Received!'];
    echo json_encode($result);
}


?>