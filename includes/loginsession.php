<?php

if(isset($_SESSION['admin']))
{
    header('location: Admin/document_view/index.php');
}

if(isset($_SESSION['user']))
{
    
}
?>