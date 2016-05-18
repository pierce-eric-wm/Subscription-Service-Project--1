<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Space Station Home</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="nav_bar">
    <h1 id="site_name">Space Station-Home</h1>
    <h3 class="right"><a href="sign_up.php" class="a">Sign Up</a></h3>
    <h3 class="right"><a href="sign_in.php" class="a">Sign In</a></h3>
</div>
<p id="home_sum">Welcome to <span id="underline">Space Station</span>. Here on this site you will see some finds that astronomers or regular people have found in space. You can see the picture of the find ,the size, and a description of it.
There is much of space to be explored and looked at so every day there is something new. The site is free a subscription and it allows you to post any
of your space finds. Visit frequently as new finds are posted all of the time! There is still much of space to be explored. Have fun!!!</p>
<?php
require ('define.php');
$dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
$query = "SELECT * FROM space_add ORDER BY id DESC ";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$id = $stmt->fetchAll();

foreach ($id as $row) {
    echo '<div class="info">';
    echo '<table>';
    // Display the score data
    $filepath = GW_UPLOADPATH . $row['image'];
    echo '<tr>';
    echo '<tr class="fl"><strong>Name:</strong></tr> ' . $row['name'] . '<br />';
    echo '<tr class="fl"><strong>Size:</strong></tr> ' . $row['size'] . '<br />';
    echo '<tr class="fl"><strong>Description:</strong></tr>' .$row['desc'] .'<br />';
    if (is_file($filepath) && filesize($filepath) > 0) {
        echo '<td id="info_image"><img src="' . $filepath . '"alt="Find Image"  class="image"/></td></tr>';
        echo '</table>';
        echo '</div>';
    }
}

?>
</body>
</html>