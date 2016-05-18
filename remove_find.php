<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Space Station REMOVE</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<?php
require ('define.php');
if (isset($_GET['id']) && isset($_GET['desc']) && isset($_GET['name']) && isset($_GET['size']) && isset($_GET['image'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $desc = $_GET['desc'];
    $name = $_GET['name'];
    $size = $_GET['size'];
    $image = $_GET['image'];
}
else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['size'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
}
else {
    echo '<p class="error">Sorry, no find was specified for removal.</p>';
}

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
        // Delete the screen shot image file from the server
        @unlink(GW_UPLOADPATH . $image);
        // Connect to the database
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
        // Delete the score data from the database
        $query = "DELETE FROM space_add WHERE id = $id LIMIT 1";
        $stmt =  $dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        // Confirm success with the user
        echo '<p>The find was successfully removed.';
    }
    else {
        echo '<p class="error">The find was not removed.</p>';
    }
}
else if (isset($id) && isset($name) && isset($desc) && isset($size)) {
    echo '<p>Are you sure you want to delete the following find?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /> <strong>Desc:</strong>' . $desc . '<br /><strong>Size:</strong>' . $size . '</p>';
    echo '<form method="post" action="remove_find.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="size" value="' . $size . '" />';
    echo '</form>';
}
echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
exit();
?>