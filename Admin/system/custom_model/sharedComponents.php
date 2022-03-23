<?php

class SharedComponents
{
	private $imageProcessingError;

	function connection(){return new Database();}

	//get anything based on query
	function getData($query)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmnt = $db_handle->query($query);
			$data = $stmnt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}
		catch(PDOException $ex){}
		finally
		{
			$this->connection()->close();
		}
	}

	//get anything by id based on query
	function getDataById($idds, $query)
    {
		$db_handle = $this->connection()->open();
		try
		{
			$astmt = $db_handle->prepare($query);
			$astmt->execute(['id' => $this->unprotect($idds)]);
			$item = $astmt->fetch();

			return $item;
		}
		catch(PDOException $ex){}
		finally
		{
			$this->connection()->close();
		}
    }

	//get category name
    function getCategoryName($id)
	{
        $db_handle = $this->connection()->open();
		try
		{
			$astmt = $db_handle->prepare("SELECT catname FROM category WHERE id=:id");
			$astmt->execute(['id' => $id]);
			$catname = $astmt->fetch();

            if($catname)
            {
                return $catname;
            }
			return false;
		}
		catch(PDOException $ex)
		{
			return false;
		}
		finally
		{
			$this->connection()->close();
		}
    }

	//get category
	function getCategory()
	{
		$db_handle = $this->connection()->open();
        try
		{
            $statement = $db_handle->query("SELECT * FROM category");
            $query = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $query;
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
        finally
        {
            $this->connection()->close();
        }
	}

	function processCatName($category)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$astmt = $db_handle->prepare("SELECT id FROM category WHERE catname=:catname");
			$astmt->execute(['catname' => $category]);
			$catname = $astmt->fetch();
			if ($catname)
			{
				foreach($catname as $key => $val)
				{
					$catid = $val;
				}
			}
			else
			{
				$bstmt = $db_handle->prepare("INSERT INTO category (catname, cat_slug) VALUES (:catname, :cat_slug)");
				$bstmt->execute(['catname'=>$category, 'cat_slug'=>$category]);

				$bstmt = $db_handle->prepare("SELECT id FROM category WHERE catname=:catname ORDER BY id DESC");
				$bstmt->execute(['catname' => $category]); 
				$catname = $bstmt->fetch();
				
				foreach($catname as $key => $val)
				{
					$catid = $val;
				}
			}

			return $catid;
		}
		catch(PDOException $ex)
		{
			$result = ['response' => false, 'message' => 'Error Connecting to Server '.$ex];
		}
		finally
		{
			$this->connection()->close();
		}			
	}

	//check, delete category
	function checkDeleteCategory($catidds)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stmt = $db_handle->prepare("SELECT category_id FROM products WHERE category_id=:category_id");
			$stmt->execute(['category_id' => $catidds]); 
			$catname = $stmt->fetch();
			if ($catname) 
			{
				
			}
			else
			{
				$sql = "DELETE FROM category WHERE id=?";
				$stmt= $db_handle->prepare($sql);
				$stmt->execute([$catidds]);
			}
			return true;
		}
		catch(PDOException $ex)
		{
			return false;
		}
		finally
		{
			$this->connection()->close();
		}
	}

	//checks images and upload to server
	function processImage($image)
	{
		$filename = htmlspecialchars(basename($_FILES[$image]["name"]));
		$target_dir = "../../../uploads/";
		$target_file = $target_dir.basename($_FILES[$image]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						
		// Check file size
		if ($_FILES[$image]["size"] > 500000) 
		{
			$this->imageProcessingError = ['response' => false, 'message' => 'Sorry, your file is too large' ];
			return false;
		}
		// Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) 
		{
			$this->imageProcessingError = ['response' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed'];
			return false;
		}
		//upload file
		move_uploaded_file($_FILES[$image]["tmp_name"], $target_file);
		return $filename;
	}

	//encrypt the datastring
	function protect($routeValue)
	{
		// Store a string into the variable which
		// need to be Encrypted
		$data = $routeValue."";

		// Store the cipher method
		$ciphering = "AES-128-CTR";

		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;

		// Non-NULL Initialization Vector for encryption
		$encryption_iv = '1234567891011121';

		// Store the encryption key
		$encryption_key = "eyo123";

		// Use openssl_encrypt() function to encrypt the data
		$encryption = openssl_encrypt($data, $ciphering,
		$encryption_key, $options, $encryption_iv);

		return $encryption;
	}

	//decrypt the datastring
	function unprotect($encryptedValue)
	{
		$ciphering = "AES-128-CTR";

		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;

		// Non-NULL Initialization Vector for decryption
		$decryption_iv = '1234567891011121';

		// Store the decryption key
		$decryption_key = "eyo123";

		// Use openssl_decrypt() function to decrypt the data
		$decryption = openssl_decrypt ($encryptedValue, $ciphering, 
		$decryption_key, $options, $decryption_iv);

		return $decryption;
	}

	//gets the total number of items in the table
	function getItemCount($tableName)
	{
		$db_handle = $this->connection()->open();
		try
		{
			$stm = $db_handle->prepare("SELECT * FROM $tableName");
			$stm->execute();
			$count = $stm->rowCount();
			return $count;
		}
		catch(PDOException $ex)
		{
			return $ex;
		}
		finally
		{
			$this->connection()->close();
		}
	}

	//get cart items by userid
	function getCartByUserId($idds, $salesdate)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM cart WHERE userid=:userid AND date=:date ORDER BY id DESC");
        $astmt->execute(['userid' => $this->unprotect($idds), 'date' => $salesdate]);
        $item = $astmt->fetchAll(PDO::FETCH_ASSOC);

        return $item;
    }

	function getCartDetailsByUserId($idds)
    {
        $db_handle = $this->connection()->open();

        $astmt = $db_handle->prepare("SELECT * FROM cart WHERE userid=:userid ORDER BY id DESC");
        $astmt->execute(['userid' => $this->unprotect($idds)]);
        $item = $astmt->fetchAll(PDO::FETCH_ASSOC);

        return $item;
    }
}
?>