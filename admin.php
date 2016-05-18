
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Space Station ADMIN</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<?php
require_once ('authorize.php');
require_once('define.php');

// Connect to the database
$dbh=new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
// Retrieve the score data from MySQL
$query = "SELECT * FROM space_add ORDER BY ID ASC ";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();

// Loop through the array of score data, formatting it as HTML
$filepath = GW_UPLOADPATH . $row['image'];
echo '<table id="admin_layout">';

    echo'<td>ID:</td> <td>Image:<td>Name:</td><td>Size:</td><td>Desc:</td><td>Remove:</td>';
// Display the score data
    foreach ($result as $row){
    echo '<tr></tr>';
    echo '<td><span>' . $row['id'] . '</span></td>';
    echo '<td>' . $row['image'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>'. $row ['size'] . '</td>';
    echo '<td>'. $row ['desc'] . '</td>';
    echo '<td><a href="remove_find.php?id=' . $row['id'] . '&amp;desc=' . $row['desc'] . '&amp;name=' . $row['name'] . '&amp;size=' . $row['size'] . '&amp;image=' . $row['image'] . '">Remove</a></td>';
    echo '<tr></tr>';
    }
    echo '</table>';
exit();
?>
</body>
</html>
