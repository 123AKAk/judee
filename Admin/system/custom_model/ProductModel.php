<?php

class Products
{
	function connection(){return new Database();}
	
	function SharedComponents(){return new SharedComponents();}

	function product()
	{
        $ProductData =  new stdClass();
		$ProductData->EncryptedId = "";
        $ProductData->Category_Id = "";
        $ProductData->Name = "";
        $ProductData->Description = "";
        $ProductData->Slug = "";
        $ProductData->Price = "";
        $ProductData->Photo1 = "";
        $ProductData->Photo2 = "";
		$ProductData->Photo3 = "";
		$ProductData->Photo4 = "";
		$ProductData->Date_Added = "";
		$ProductData->Counter = "";
        return $ProductData;
    }

	function getProducts()
    {
		$db_handle = $this->connection()->open();

		$statement = $db_handle->query("SELECT * FROM products ORDER BY date_added DESC");
		$products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $ProductData = $this->product();
        $Listproducts[] = ($ProductData);

        if (!empty($products))
        {
            foreach($products as $item)
            {
                $products->EncryptedId = $this->SharedComponents()->protect($item["id"]);
				$products->Category_Id = $item["category_id"];
				$products->Name = $item["name"];
				$products->Description = $item["description"];
				$products->Slug = $item["slug"];
				$products->Price = $item["price"];
				$products->Photo1 = $item["photo1"];
				$products->Photo2 = $item["photo2"];
				$products->Photo3 = $item["photo3"];
				$products->Photo4 = $item["photo4"];
				$products->Date_Added = $item["date_added"];
				$products->Counter = $item["counter"];
                array_push($Listproducts, $products);
            }
        }
        return $Listproducts;
    }

	function getProductById($idds)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM products WHERE id=:id");
        $astmt->execute(['id' => $this->SharedComponents()->unprotect($idds)]);
        $item = $astmt->fetch();

        $ProductData = $this->product();
        $products = new $ProductData;
		
		$products->EncryptedId = $this->SharedComponents()->protect($item["id"]);
		$products->Category_Id = $item["category_id"];
		$products->Name = $item["name"];
		$products->Description = $item["description"];
		$products->Slug = $item["slug"];
		$products->Price = $item["price"];
		$products->Photo1 = $item["photo1"];
		$products->Photo2 = $item["photo2"];
		$products->Photo3 = $item["photo3"];
		$products->Photo4 = $item["photo4"];
		$products->Date_Added = $item["date_added"];
		$products->Counter = $item["counter"];

        return $products;
    }

    public function addProduct($category_name, $name, $description, $slug, $price, $photo1, $photo2, $photo3, $photo4, $productimage1, $productimage2, $productimage3, $productimage4)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$uniqueFileName1 = "";
			$uniqueFileName2 = "";
			$uniqueFileName3 = "";
			$uniqueFileName4 = "";

			if(!empty($productimage1))
			{
				$imageEntity1 = $this->SharedComponents()->processImage($photo1);
				if($imageEntity1 == false){
					return $this->SharedComponents()->imageProcessingError;
				}
				$uniqueFileName1 = $imageEntity1;
			}
			if(!empty($productimage2))
			{
				$imageEntity2 = $this->SharedComponents()->processImage($photo2);
				if($imageEntity2 == false){
					return $this->SharedComponents()->imageProcessingError;
				}
				$uniqueFileName2 = $imageEntity2;
			}
			if(!empty($productimage3))
			{
				$imageEntity3 = $this->SharedComponents()->processImage($photo3);
				if($imageEntity3 == false){
					return $this->SharedComponents()->imageProcessingError;
				}
				$uniqueFileName3 = $imageEntity3;
			}
			if(!empty($productimage4))
			{
				$imageEntity4 = $this->SharedComponents()->processImage($photo4);
				if($imageEntity4 == false){
					return $this->SharedComponents()->imageProcessingError;
				}
				$uniqueFileName4 = $imageEntity4;
			}

			$stmt = $db_handle->prepare("INSERT INTO products (category_id, name, description, slug, price, photo1, photo2, photo3, photo4) VALUES (:category_id, :name, :description, :slug, :price, :photo1, :photo2, :photo3, :photo4)");
			$stmt->execute(['category_id'=>$this->SharedComponents()->processCatName($category_name), 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo1'=>$uniqueFileName1, 'photo2'=>$uniqueFileName2, 'photo3'=>$uniqueFileName3, 'photo4'=>$uniqueFileName4]);
			
			$result = ['response' => true, 'message' => '../document_view/products.php'];
			return $result;
		}
		catch(PDOException $ex)
		{
			$result = ['response' => false, 'message' => 'Error Connecting to Server '.$ex];
			return $result;
		}
		finally
		{
			$this->connection()->close();
		}
    }

	//editTeam
	public function editProduct($idds, $category_name, $name, $description, $slug, $price, $photo1, $photo2, $photo3, $photo4, $productimage1, $productimage2, $productimage3, $productimage4)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$decryptedId = $this->SharedComponents()->unprotect($idds);
			
			$uniqueFileName1 = $productimage1;
			$uniqueFileName2 = $productimage2;
			$uniqueFileName3 = $productimage3;
			$uniqueFileName4 = $productimage4;
            
			$astmt = $db_handle->prepare("SELECT * FROM products WHERE id=:id");
			$astmt->execute(['id' => $decryptedId]); 
			$currentimage = $astmt->fetch();

			if(!empty($productimage1))
			{
				if($uniqueFileName1 != $currentimage["photo1"])
				{
					$imageEntity = $this->SharedComponents()->processImage($photo1);
					if($imageEntity == false){
						return $this->SharedComponents()->imageProcessingError;
					}
					$uniqueFileName1 = $imageEntity;
				}
			}
			if(!empty($productimage2))
			{
				if($uniqueFileName2 != $currentimage["photo2"])
				{
					$imageEntity = $this->SharedComponents()->processImage($photo2);
					if($imageEntity == false){
						return $this->SharedComponents()->imageProcessingError;
					}
					$uniqueFileName2 = $imageEntity;
				}
			}
			if(!empty($productimage3))
			{
				if($uniqueFileName3 != $currentimage["photo3"])
				{
					$imageEntity = $this->SharedComponents()->processImage('photo3');
					if($imageEntity == false){
						return $this->SharedComponents()->imageProcessingError;
					}
					$uniqueFileName3 = $imageEntity;
				}
			}
			if(!empty($productimage4))
			{
				if($uniqueFileName4 != $currentimage["photo4"])
				{
					$imageEntity = $this->SharedComponents()->processImage($photo4);
					if($imageEntity == false){
						return $this->SharedComponents()->imageProcessingError;
					}
					$uniqueFileName4 = $imageEntity;
				}
			}
			
			$stmt = $db_handle->prepare("UPDATE products SET category_id=:category_name, name=:name, description=:description, slug=:slug, price=:price, photo1=:photo1, photo2=:photo2, photo3=:photo3, photo4=:photo4 WHERE id = $decryptedId");
			$stmt->execute(['category_name'=>$this->SharedComponents()->processCatName($category_name), 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo1'=>$uniqueFileName1, 'photo2'=>$uniqueFileName2, 'photo3'=>$uniqueFileName3, 'photo4'=>$uniqueFileName4]);
			
			$result = ['response' => true, 'message' => '../document_view/products.php'];
			return $result;
		}
		catch(PDOException $ex)
		{
			$result = ['response' => false, 'message' => 'Error Connecting to Server '.$ex];
			return $result;
		}
		finally
		{
			$this->connection()->close();
		}
    }

	//delete
	public function deleteProduct($idds, $catid)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt= $db_handle->prepare("DELETE FROM products WHERE id=?");
			$stmt->execute([$this->SharedComponents()->unprotect($idds)]);

			$catdele = $this->SharedComponents()->checkDeleteCategory($catid);
			if($catdele == false)
			{
				$result = ['response' => false, 'message' => 'Error Deleting Product Category'];
				return $result;
			}
			
			$result = ['response' => true, 'message' => '../document_view/products.php'];
			return $result;
		}
		catch(PDOException $e)
		{
			$result = ['response' => false, 'message' => 'Error Connecting to Server '.$ex];
			return $result;
		}
		finally
		{
			$this->connection()->close();
		}
    }
}

?>