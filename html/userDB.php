<?php

session_start();
/**
* Class UserInfo
* Represents a user information class which has methods for registering, login, checking email, changing password,
* displaying user profile, and editing user details.
*/
class userDB{

    public $name,$password,$email,$conn;

    function __construct($data=[]){
        foreach ($data as $key=>$value){
            $this->$key=$value;
        }
    }

    /**

    * Registers a new user with given details.
    * Inserts user details into database and redirects to Login page if successful,
    * otherwise displays 'User Exist' message on RegistrationPage.
    */
    function register(){

        require_once 'conn.php';
        var_dump($this->userExist($this->email));
        if ($this->userExist($this->email)){
            return false;
        }
        else{
            $sql="INSERT INTO User (name,password,email) VALUES ('$this->name','$this->password','$this->email')";
            $result=mysqli_query($connect,$sql);
            return $result;
        }
    }

    /**
    * Login a user with given email and password.
    * Fetches user details from database and sets session variables.
    * Redirects to feed page if successful, otherwise displays 'Wrong Credential' message on Login page.
    */
    function login(){
        require_once 'conn.php';
        $sql="SELECT name,email,password,user_id FROM user WHERE email='$this->email' and password='$this->password'"; 
        $result=mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row['email']==$this->email and $row['password']==$this->password){
            return $row;
        } 
    }

    /**

    * Checks if the given email exists in the database.
    * If the email exists, generates and sends an OTP to that email and redirects to ChangePassword page.
    * Otherwise, displays 'Wrong Email or email does not exist' message on OTP page.
    */
    function checkEmail(){
        require_once 'conn.php';
        $sql="SELECT * FROM user WHERE email='$this->email'"; 
        $result=mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result); 
        
        if($row['email']==$this->email){
            $gen_otp = random_int(100000, 999999);
            $_SESSION['OTP']=$gen_otp;
            $_SESSION['email']=$this->email;
            $message='Your OTP for changing password is '.$gen_otp;
            $subject='OTP for password change';
            include './sendMail.php';
            header('Location: ChangePassword.php');
        }
        else{
            $_SESSION['status']='Wrong Email or email does not exist';
            header('Location: OTP.php');
        }
    }

    /**

    * Changes the password for the given email in the database.
    * If successful, clears session variables and redirects to Login page.
    * Otherwise, displays 'Unable to change password' message on ChangePassword page.
    */
    function changePassword(){
        require_once 'conn.php';
        $sql="UPDATE User set password='$this->password' where email='$this->email'"; 
        $result=mysqli_query($connect,$sql);
        if($result){
            unset($_SESSION['OTP'], $_SESSION['email']);
            header('Location: Login.php');
        }
        else{
            $_SESSION['status']='Unable to change password';
            header('Location: ChangePassword.php');
        }
    }
    /**
    * Function to get the profile details of a user from the User table
    * @return array Returns an array containing the user's profile details
    */
    function profile(){
        require_once 'conn.php';
        $id=(int)$_SESSION['id'];
        $sql="SELECT * FROM user WHERE id=id;"; 
        $result=mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    /**
    * Function to check if user exist in database or not
    */
    function userExist($email){
        require_once 'conn.php';
        $query = "SELECT email FROM user where email = '$email';";
        //executes query
        $result = mysqli_query($connect, $query);
        var_dump($result);
        if ($result) {
            return true;
        }
        return false;
    }
}
?>