<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<?php
/*if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = date("D M j G:i:s T Y");
    if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password) && !empty($date)) {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
        $query = "INSERT INTO user_table VALUES (NULL , :first_name, :last_name, :username, :email, :password, NOW())";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => $password
            )
        );
        if (!$result) {
            die('Error querying database.');
        }*/
?>
<div id="nav_bar">
    <h1 id="site_name">Space Station-Sign Up</h1>
    <h3 class="right"><a href="index.php" class="a">Home</a></h3>
    <h3 class="right"><a href="sign_in.php" class="a">Sign In</a></h3>
</div>
<div id="form_submit">
 <h2 id="signsup">Register for Space Station</h2>
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"  value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"  value="<?php if (!empty($username)) echo $username; ?>" /> <br />
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"  value="<?php if (!empty($email)) echo $email; ?>" /> <br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  value="<?php if (!empty($password)) echo $password; ?>" /> <br />
        <input type="submit" value="Add User" name="submit"/>
    </form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $from = 'eric.pierce@west-mec.org';
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = date("D M j G:i:s T Y");
    if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password) && !empty($date)) {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
        $query = "INSERT INTO user_table VALUES (NULL , :first_name, :last_name, :username, :email, :password, NOW())";
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => $password
            )
        );
        if (!$result) {
            die('Error querying database.');
        }
        else {
            $subject = 'Thank You for subscribing to Space Station';
            $msg = "Hello $first_name $last_name thank you for subscribing to Space Station You can now upload you own finds onto this site and have them posted. Have fun!!!";
        mail($email, $subject, $msg, 'From:' .$from);
        }
        echo '<p><a href="sign_in.php">&lt;&lt;Sign In</a></p>';
    }
    else {
        echo '<p>Please enter the requested information below</p>';
    }
}
?>

