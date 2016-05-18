<?php
$username = 'Space';
$password = '594C3';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
    // The user name/password are incorrect so send the authentication headers
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Space Station"');
    exit('<h2>Space Station</h2><h2 id="admin_error">Sorry, you must enter a valid user name and password to access the admin page</h2>');
}