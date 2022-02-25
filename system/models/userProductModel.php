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
			return $Listproducts;
        }
    }

	function getProductsByCategory($idds, $query)
    {
		$db_handle = $this->connection()->open();

		$statement = $db_handle->prepare($query);
		$statement->execute(['category_id' => $this->SharedComponents()->unprotect($idds)]);
		$products = $statement->fetchAll(PDO::FETCH_ASSOC);

       	return $products;
    }

	function getProductById($idds)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM products WHERE id=:id");
        $astmt->execute(['id' => $this->SharedComponents()->unprotect($idds)]);
        $item = $astmt->fetch();

		if(!empty($item))
		{
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
    }

	function searchProduct()
	{
		
	}
}

?>