<?php

class Admin
{
	function connection(){return new Database();}
	
	function SharedComponents(){return new SharedComponents();}

	function sales()
	{
        $SalesData =  new stdClass();
		$SalesData->EncryptedId = "";
        $SalesData->User_Id = "";
        $SalesData->Transaction_Id = "";
		$SalesData->Sales_Date = "";
        return $SalesData;
    }

	function getSales()
    {
		$db_handle = $this->connection()->open();

		$statement = $db_handle->query("SELECT * FROM sales ORDER BY sales_date DESC");
		$sales = $statement->fetchAll(PDO::FETCH_ASSOC);

        $SalesData = $this->sales();
        $Listsales[] = ($SalesData);

        if (!empty($sales))
        {
            foreach($sales as $item)
            {
                $sales->EncryptedId = $this->SharedComponents()->protect($item["id"]);
				$sales->User_Id = $item["user_id"];
				$sales->Transaction_Id = $item["transaction_id"];
				$sales->Sales_Date = $item["sales_date"];
                
                array_push($Listsales, $sales);
            }
        }
        return $Listsales;
    }

	function getSalesById($idds)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM sales WHERE id=:id");
        $astmt->execute(['id' => $this->SharedComponents()->unprotect($idds)]);
        $item = $astmt->fetch();

        $SalesData = $this->product();
        $sales = new $SalesData;
		
		$sales->EncryptedId = $this->SharedComponents()->protect($item["id"]);
		$sales->User_Id = $item["user_id"];
        $sales->Transaction_Id = $item["transaction_id"];
        $sales->Sales_Date = $item["sales_date"];

        return $sales;
    }

    public function addSales($user_id, $transaction_id)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt = $db_handle->prepare("INSERT INTO sales (user_id, transaction_id) VALUES (:user_id, :transaction_id)");
			$stmt->execute(['user_id'=>$user_id, 'transaction_id'=>$transaction_id]);
			
			$result = ['response' => true, 'message' => '../document_view/sales.php'];
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
	public function editSales($idds, $user_id, $transaction_id)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$decryptedId = $this->SharedComponents()->unprotect($idds);
			
			$stmt = $db_handle->prepare("UPDATE sales SET user_id=:user_id, transaction_id=:transaction_id WHERE id = $decryptedId");
			$stmt->execute(['user_id'=>$user_id, 'transaction_id'=>$transaction_id]);
			
			$result = ['response' => true, 'message' => '../document_view/sales.php'];
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
	public function deleteSales($idds)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt= $db_handle->prepare("DELETE FROM sales WHERE id=?");
			$stmt->execute([$this->SharedComponents()->unprotect($idds)]);

			$result = ['response' => true, 'message' => '../document_view/sales.php'];
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