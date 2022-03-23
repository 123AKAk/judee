<?php

class Sales
{
	function connection(){return new Database();}
	
	function SharedComponents(){return new SharedComponents();}

	function sales()
	{
        $SalesData =  new stdClass();
		$SalesData->EncryptedId = "";
        $SalesData->userid = "";
		$SalesData->Amount = "";
        $SalesData->transactionid = "";
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
				$sales->userid = $item["user_id"];
				$sales->Amount = $item["amount"];
				$sales->transactionid = $item["transaction_id"];
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

        $SalesData = $this->sales();
        $sales = new $SalesData;
		
		$sales->EncryptedId = $this->SharedComponents()->protect($item["id"]);
		$sales->userid = $item["user_id"];
		$sales->Amount = $item["amount"];
        $sales->transactionid = $item["transaction_id"];
        $sales->Sales_Date = $item["sales_date"];

        return $sales;
    }

	function getSalesByIda($idds)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM sales WHERE id=:id");
        $astmt->execute(['id' => $this->SharedComponents()->unprotect($idds)]);
        $item = $astmt->fetchAll(PDO::FETCH_ASSOC);

        return $item;
    }

    public function addSales($userid, $amount, $transactionid)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt = $db_handle->prepare("INSERT INTO sales (user_id, amount, transaction_id) VALUES (:user_id, :amount, :transactionid)");
			$stmt->execute(['user_id'=>$userid, 'amount'=>$amount, 'transaction_id'=>$transactionid]);
			
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
	public function editSales($idds, $userid, $amount, $transactionid)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$decryptedId = $this->SharedComponents()->unprotect($idds);
			
			$stmt = $db_handle->prepare("UPDATE sales SET user_id=:user_id, amount=:amount, transaction_id=:transaction_id WHERE id = $decryptedId");
			$stmt->execute(['user_id'=>$userid, 'amount'=>$amount, 'transaction_id'=>$transactionid]);
			
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
	public function deleteSale($idds)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt= $db_handle->prepare("DELETE FROM sales WHERE id=?");
			$stmt->execute([$this->SharedComponents()->unprotect($idds)]);

			$result = ['response' => true, 'message' => 'Sale Deleted successfully'];
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