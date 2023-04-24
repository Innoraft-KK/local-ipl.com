<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Mynerve&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile.css" />
    <link rel="stylesheet" href="login_reg.css">
    <title>Register</title>
  </head>
  <body>
    <header>
      <div class="container flexme">
        <div class='logo'><a href="/feed.php"><img src="./WebImages/logo.png" alt=""></a></div>
        <nav>
          <ul class="flexme">
           
           
            <?php
            $user_id=$_SESSION['user_id'];
            if( empty($_SESSION['mail']) && empty($_SESSION['user_id']))
            { 
             /*  echo "<li><a href='/Profile.php?user_id=".$_SESSION['user_id']."'>My Profile</a></li>";
              echo "<li><a href='/CreatePost.php'><i class='fa-solid fa-pen-to-square'></i> </a></li>";
              echo "<li><a href='../controller/Logout.php'><i class='fa-solid fa-arrow-right-from-bracket'></i></a></li>";
            }
            else{ */
              echo "<li><a href='index.php'>Login</a></li>";
            }
            ?>
            
          </ul>
        </nav>
      </div>
    </header>
    <?php
    if(isset($_SESSION['status'])){
      echo
      "<div class='alert'>
      <span class='closebtn' onclick=";
      echo "this.parentElement.style.display='none';";
      echo">&times;</span> ";
      echo "<strong>";
      echo  $_SESSION['status'];
      echo "</strong>
      </div>";
      unset($_SESSION['status']);
    }
    ?>
  <section class="container">
    <form action="registerLogic.php" method="post">
      <h2>Register</h2>
      <div>
        <label for="name">Name</label>
        <input  type="text"  id="name"  name="name" />
      </div>
      <div>
        <label for="email">Email</label>
        <input  type="email"  id="email"  name="email"/>
      </div>
      <div>
        <label for="password">Password</label>
        <input  type="password"  id="password"  name="password"/>
      </div>
      <div>
        <label for="re-password">Re-enter Password</label>
        <input  type="password"  id="re-password" />
      </div>
      <button>Sign Up</button>
      <div>Already on IPL? <a href="index.php">Log In</a></div>
    </form>
  </section>
  <script src="./script.js"></script>
  </body>
</html>
