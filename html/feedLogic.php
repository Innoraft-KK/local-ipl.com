<?php
    /**
    *This script retrieves all the posts from the database and displays them on the feed page.
    */
    
    include 'postDB.php';
    $user= new postDB();
    $posts=$user->feed();

?>