<!DOCTYPE html>
<html>
<body>

<?php


//add values to multidimensional array
$merge = array();
for($x = 0; $x <= 5; $x++)
{
	$result = ['id' => $x."id", 'price' => $x*10, 'quantity' => $x];
	$merge[] = $result;
}

print_r($merge);

echo "<hr><hr>";

//display values from multidimensional array
$keys = array_keys($merge);
for($i = 0; $i < count($merge); $i++)
{
    foreach($merge[$keys[$i]] as $key => $value)
	{
        echo $key . " : " . $value . "<br>";
    }
	echo "<hr>";
}
echo "<hr>";



//add values to multidimensional array
$merge = array();
for($x = 0; $x <= 5; $x++)
{
	$result = [$x."id", $x*10, $x];
	$merge[] = $result;
}
print_r($merge);
echo "<hr><hr>";

//display values from multidimensional array
$keys = array_keys($merge);
for($i = 0; $i < count($merge); $i++)
{
    foreach($merge[$keys[$i]] as $key => $value)
	{
        echo $key . " : " . $value . "<br>";
    }
    
}
echo "<hr><hr>";

foreach($merge[0] as $key => $value)
{
	echo $key . " : " . $value . "<br>";
}

?>

</body>
</html>