<?php
// Logout from website
session_start();
unset($_SESSION['loggedIn']);
 
if(session_destroy())
{
    header("Location: index.php");
}