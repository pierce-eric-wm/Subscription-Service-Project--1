<?php
// link to the database with the stuff selected from the sign up page (all the info (just need the email)
$from = 'eric.pierce@west-mec.org';
$to= $email;
$subject = 'Thank You for subscribing to Space Station';
$msg = "Hello $first_name $last_name thank you for subscribing to Space Station.\n" .
    "You can now upload you own finds onto this site and have them posted. Have fun!!!"
        mail($to, $subject, $msg, 'From:' .$from);
// Don't know what else to do to this ↑↑↑↑↑↑↑↑
?>