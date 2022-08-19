<?php
session_start();
if(!isset($_SESSION['authenticated'])){
 	header('location: login.php');
 }

$auth = $_SESSION['auth'];

$db = new mysqli ('localhost:3307', 'root', 'root', 'book_store');

$sql_query = ' SELECT * FROM books ';

$result = $db->query($sql_query);

$info = $result->fetch_all(MYSQLI_ASSOC);
?>
<html>
    <head>
        <title>BOOKSTORE</title>
        <link rel="stylesheet" href="style.css">
     </head>
    <body>
        <div class="welcome_message">
            <p>
            Welcome, <strong style="color:green;"><?php echo $auth['name']?></strong>
            </p>
            <p><a href="login_backend.php?logout=true">Logout</a></p>
        </div>
       <div class="continar"> 
        <h2 class="title">Book Details</h2>
        <table>
	          <tr class="title">
		        <th>ID</th>
		        <th>Name</th>
		        <th>Author</th>
		        <th>Published date</th>
		        <th>Language</th>
		        <th>Genres</th>
		        <th>Pages</th>
		        <th>Price(€)</th>
                <th>Image</th>
                <th>Action</th>
	         </tr>

	    <tbody>
		<?php 
			
			foreach($info as $record){

				echo "<tr>
							<td>". $record['ID'] ."</td>
							<td>". $record['name'] ."</td>
							<td>". $record['author'] ."</td>
							<td>". $record['published_date'] ."</td>
							<td>". $record['language'] ."</td>
							<td>". $record['genres'] ."</td>
							<td>". $record['pages'] ."</td>
							<td>". $record['price'] ."</td>
                            <td>
								<img src='storage/books/{$record['image']}' />
							</td>
                            <td>

                            <div class='buttons'>
                            <button><a class='edit' href='book.php?edit_id={$record['ID']}'>Edit</a></button>
                            <button><a class='delete' href='book_controller.php?delete_id={$record['ID']}'>Delete</a></button>
                            </div>
                            </td>
						</tr>";
			}
		?>
	    </tbody>
        </table>
       </div>  
    </body>
</html>

<?php
$edit_book = null;

if (isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];

   $book_query = "SELECT * FROM books WHERE ID=${id}";
   
   $book_result = $db->query($book_query);

   $edit_book = $book_result->fetch_assoc();
   
}
?>



<div class="continar">
<form action="book_controller.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo ($edit_book) ? $edit_book['id'] : ''?>">
  <h2 class="title">Book Details</h2>
  <table>
    <tr>
            <td>ID</td>
            <td>
                <input type="number" name="ID" value="<?php echo($edit_book) ? $edit_book['ID'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" value="<?php echo($edit_book) ? $edit_book['name'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Author</td>
            <td>
                <input type="text" name="author" value="<?php echo($edit_book) ? $edit_book['author'] : '' ?>">
            </td>
        </tr>
        
        <tr>
            <td>Published Date</td>
            <td>
                <input type="date" name="published_date" value="<?php echo($edit_book) ? $edit_book['published_date'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Language</td>
            <td>
                <input type="text" name="language" value="<?php echo($edit_book) ? $edit_book['language'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Genres</td>
            <td>
                <input type="text" name="genres" value="<?php echo($edit_book) ? $edit_book['genres'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Pages</td>
            <td>
                <input type="text" name="pages" value="<?php echo($edit_book) ? $edit_book['pages'] : '' ?>">
            </td>
        </tr>

        <tr>
            <td>Price</td>
            <td>
                <input type="text" name="price" value="<?php echo($edit_book) ? $edit_book['price'] : '' ?>">
            </td>
        </tr>
        
        <tr>
            <td>Image</td>
            <td>
                <input type="file" name="image">
                <br>
                <img src="storage/products/<?php echo $edit_book['image'] ?>" alt="">
                
                <?php  ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <div class='buttons'>
                <button class="save"type="submit" name="<?php echo ($edit_product) ? 'update_book' : 'insert_book' ?>"> Save</button>
                <button class="cancel"name="<?php header('location: book.php'); ?>">Cancel</button>
                </div>
            </td>
        </tr>

        
    </table>
</form>
</div>