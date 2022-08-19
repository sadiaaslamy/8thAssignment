<?php

$connection = new mysqli('localhost:3307', 'root', 'root', 'book_store');
if($connection->connect_error){
   die('no DB connection');
}

if(isset($_POST['insert_book'])){

   $ID = $_POST['ID'];
   $name = $_POST['name'];
   $author = $_POST['author'];
   $published_date = $_POST['published_date'];
   $language = $_POST['language'];
   $genres = $_POST['genres'];
   $pages = $_POST['pages'];
   $price = $_POST['price'];

   $image_file = $_FILES['image'];
	$tmp_name = $image_file['tmp_name'];
	$image_name = $image_file['name'];

	move_uploaded_file($tmp_name, 'storage/products/'. $image_name);
   
   $query = "INSERT INTO books (ID,name,author,published_date,language,genres,pages,price,image) VALUES ('$ID','$name','$author','$language',
   '$genres','$pages','$price',";

   if($published_date){
       $query .= " '$published_date'";
   }else{
      $query .= "NULL";
   }
   
   $query .= ", '$image_name')";
   $connection->query($query);

   header('location: book.php');
   
}

else if(isset($_POST['update_product'])){

   $ID = $_POST['ID'];
   $name = $_POST['name'];
   $author = $_POST['author'];
   $published_date = $_POST['published_date'];
   $language = $_POST['language'];
   $genres = $_POST['genres'];
   $pages = $_POST['pages'];
   $price = $_POST['price'];
    
   $image_query = "SELECT image FROM books WHERE ID=$ID";
   $result = $connection->query($image_query);
   $image_product = $result->fetch_assoc();

   $image_name = $image_product['image'];

   if(isset($_FILES['image'])){
    unlink('storage/products/'. $image_name);

   $image_file = $_FILES['image'];
	$tmp_name = $image_file['tmp_name'];

	$image_name = $image_file['name'];
   move_uploaded_file($tmp_name, 'storage/products/'. $image_name);
   }


   $query = " UPDATE books SET name='$name', author='$author',published_date='$published_date',language='$language',genres='$genres',pages='$pages',price='$price', image='$image_name' WHERE ID=$ID ";
   
   $connection->query($query);
   
   header('location: book.php');
}

else if(isset($_GET['delete_id'])){

   $id = $_GET['delete_id'];
   $image_query = "SELECT image FROM books WHERE ID=$id";
   $result = $connection->query($image_query);
   $image_product = $result->fetch_assoc();

   unlink('storage/products/'. $image_product['image']);
	$query = " DELETE FROM books WHERE ID=$id";

	$connection->query($query);

	if($connection->error){
		echo $connection->error;
	}else{
		header('location: book.php');
	}
}