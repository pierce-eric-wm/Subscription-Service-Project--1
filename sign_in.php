<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<?php
$dbh = new PDO('mysql:host=127.0.0.1;dbname=space_station', 'root', 'root');
if(isset($_SESSION['username'])){
}

$error = false;
$success = false;

if(@$_POST['login']) {
    if (!$_POST['username']) {
    }
    if (!$_POST['password']) {
    }

    $query = $dbh->prepare("SELECT * FROM user_table WHERE username = :username AND password = :password");
    $result = $query->execute(
        array(
            'username' => $_POST['username'],
            'password' => $_POST['password']
        )
    );
    $userinfo = $query->fetch();
    if ($userinfo) {
        $success = "User, " . $_POST['username'] . " was successfully logged in.";
        $_SESSION["first_name"] = $userinfo['first_name'];
        $_SESSION["username"] = $userinfo['username'];
        header("Location: index_si.php");
    } else {
        $success = "There was an error logging into the account.";
    }
}
?>
<div id="nav_bar">
    <h1 id="site_name">Space Station-Sign In</h1>
    <h3 class="right"><a href="sign_in.php" class="a">Sign In</a></h3>
    <h3 class="right"><a href="index.php" class="a">Home</a></h3>
</div>
<div id="SignInto">
    <form id=signin method="post">
        <h2 id="h2o">Sign - In</h2>
        <label>Username:</label>
        <input type="text" name="username" id="name"> <br><br>
        <label> Password:</label>
        <input type="password" name="password" id="passsword"> <br><br>
        <button type="submit" name="login" value="1">Sign In</button></br />
    </form>
    <div id="buttonz">
        <a href="sign_up.php"><button id="si_su">Sign Up</button> </a><br />
        </div>
</div>
<body>
</html>

