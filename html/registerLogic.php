<?php 
    /**
   * Registers a new user with the given first name, last name, email, and password.
   * @param string $fname The first name of the user.
   * @param string $lname The last name of the user.
   * @param string $email The email of the user.
   * @param string $password The password of the user.
   * @return void
    */
    include 'userDB.php';
    
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
    var_dump($_POST);
    $user= new userDB($_POST);
    $result=$user->register();
   
    if($result){
        header('Location: index.php');
    }
    else{
        $_SESSION['status']='User Exist';
        header('Location: RegistrationPage.php');
    }
}
?>