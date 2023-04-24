<?php
    /**
 * Includes the postDB class and creates a new instance if the necessary POST data is set.
 *
 * @param string $_POST['employee_name'] The name of the employee being added.
 * @param int $_POST['employee_id'] The ID of the employee being added.
 * @param string $_POST['type'] The type of employee being added.
 * @param int $_POST['points'] The points assigned to the employee being added.
 * 
 * @return void
 */
    include 'postDB.php';
    
    if(isset($_POST['employee_name']) && isset($_POST['employee_id']) && isset($_POST['type']) && isset($_POST['points'])){
    $user= new postDB($_POST);
    $user->addPlayer();
   }
?>