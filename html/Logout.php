<?php
/**
    *Ends the current session and logs the user out
 */
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("location: index.php"); //to redirect back to "index.php" after logging out
exit();
?>