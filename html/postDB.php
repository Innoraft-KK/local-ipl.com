<?php
session_start();
/**
 * Class blogPost
 */
class postDB{
   public $employee_id, $employee_name, $type, $points;
    /**
     * Constructor for the blogPost class
     *
     * @param array $data The data used to initialize the object
     */
    function __construct($data=[]){
        foreach ($data as $key=>$value){
            $this->$key=$value;
        }
    }

     /**
   * Creates a new player in the database.
   *
   * @return void
   */

    function addPlayer(){
        require_once 'conn.php';
        $sql="INSERT INTO players (employee_id, employee_name, type, points) VALUES ($this->employee_id, '$this->employee_name', '$this->type', $this->points);";
        $result = mysqli_query($connect, $sql);
    }

     /**
     * Retrieves all posts from the database and returns them in an array
     *
     * @return array An array of all posts
     */

    function feed(){
        require_once 'conn.php';
        $sql="SELECT * FROM players";
        $result = mysqli_query($connect, $sql);
        $arr=[];
        while($row = mysqli_fetch_assoc($result)){
        $arr[]=$row;
        }
        return $arr;
    }

    /**
   * Retrieves the points and type of a player from the database.
   *
   * @param int $player The ID of the player to retrieve data for.
   *
   * @return array An array containing the points and type of the player.
   */

    function pointsType($player){
        require_once 'conn.php';
        $sql="SELECT points,type FROM players where employee_id=$player";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    /**
    * Reduces the points of the current user by the given amount.
    * @param int $total The total number of points to be reduced.
    */
    function reducePoints($total){
        require_once 'conn.php';
        $user=(int)$_SESSION['id'];
        $sql="UPDATE user SET points= points- $total where id=$user";
        $result = mysqli_query($connect, $sql);
    }

    /**
    * Updates the number of players for the current user.
    * @param int $players The total number of players to be updated.
    * @return void
    */
    function playerAdded($players){
        require_once 'conn.php';
        $user=(int)$_SESSION['id'];
        $sql="UPDATE user SET players=$players where id=$user";
        $result = mysqli_query($connect, $sql);
    }
    
    
}
?>