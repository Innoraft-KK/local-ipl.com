<?php
/**

    * This PHP script starts a session and includes the userDB.php file which contains the UserInfo class.
    * It checks if email and password are set in the $_POST superglobal array. If true, it creates a new UserInfo object and calls the Login() method to authenticate the user.
    * @return void
    */
session_start();
include 'userDB.php';
if(isset($_POST['email']) && isset($_POST['password'])){
    $user= new userDB($_POST);
    $row=$user->login();
    if($row){
        $_SESSION['mail']=$_POST['email'];
        $_SESSION['id']=$row['id'];
        if($row['name']=='admin'){
            $_SESSION['admin']=true;
            header('Location: addPlayer.php');
        }
        header('Location: feed.php');
    }
    else{
        $_SESSION['status']='Wrong Credential';
        header('Location: index.php');
    }
}
?>