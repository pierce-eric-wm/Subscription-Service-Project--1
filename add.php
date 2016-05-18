<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add A Find</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="nav_bar">
    <h1 id="site_name">Space Station-Add</h1>
    <h3 class="right"><a href="sign_up.php" class="a">Sign Up</a></h3>
    <h3 class="right"><a href="index.php" class="a">Home</a></h3>
</div>
<br/>
<div id="add_div">
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="500000000"/>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"/><br/>
        <label for="score">Size:</label>
        <input type="text" id="size" name="size" value="<?php if (!empty($size)) echo $size; ?>"/><br/>
        <label for="score">Description:</label>
        <input type="text" id="desc" name="desc" value="<?php if (!empty($desc)) echo $desc; ?>"/><br/>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" value="<?php if (!empty($image)) echo $image; ?>"/><br/>
        <input type="submit" value="Add" name="submit"/>
    </form>
</div>
<?php
require_once ('define.php');
$name = $_POST['name'];
$size = $_POST['size'];
$desc= $_POST['desc'];
$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_type = $_FILES ['image']['type'];
if (!empty($name) && !empty($size) && !empty($image) && !empty($desc)) {
    if ((($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png'))
        && ($image_size > 0) && ($image_size <= GW_MAXFILESIZE)
    ) {
        if ($_FILES['image']['error'] == 0) {
            $target = GW_UPLOADPATH . $image;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
// Connect to the database
                $dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
// Write the data to the database
                $query = "INSERT INTO space_add VALUES (0, :image, :name , :size , :desc)";
                $stmt = $dbh->prepare($query);
                $result = $stmt->execute(
                    array(
                        'image' => $image,
                        'name' => $name,
                        'size' => $size,
                        'desc' => $desc
                    )
                );
                if (!$result) {
                    die('Error querying database.');
                }
// Confirm success with the user
                echo '<p>Thanks for adding a new find!</p>';
                echo '<p><strong>Name:</strong> ' . $name . '<br />';
                echo '<p><strong>Size:</strong>' . $size . '<br />';
                echo '<strong>Description:</strong> ' . $desc . '<br />';
                echo '<p><a href="index.php">&lt;&lt; Back to home page</a></p>';
// Clear the score data to clear the form
//
//                $name = "";
//                $size = "";
//                $desc = "";
//                $image = "";
//
//

            } else {
                //CANT UPLOAD IMAGE ... FIND OUT WHAT IS WRONG
                echo '<p class="error">Sorry, there was a problem uploading your image.</p>';
            }
        }
    }
    else {
        echo '<p class="error">The image must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1000000) . ' MB in size.</p>';
    }
// Try to delete the temporary screen shot image file
    @unlink($_FILES['image']['tmp_name']);
}
else {
    echo '<p class="error">Please enter all of the information to add your find.</p>';
}
exit();
?>

</body>
</html>