 <?php   
    
    include 'userDB.php';
    if(isset($_POST['player'])){
        // Retrieve selected players' IDs
            $selectedPlayers = $_POST['player'];

            // Count number of selected players
            $numPlayers = count($selectedPlayers);

            // Calculate total points of selected players
            $totalPoints = 0;
            $numBatsmen = 0;
            $numAllRounders = 0;
            $numBowlers = 0;
            foreach($selectedPlayers as $player){
                // Fetch player data from the database based on ID
                // Here, $player is the player ID
                $user= new postDB();
                $playerData = $user->pointsType($player);// Code to fetch player data from the database
                $type = $player['type'];
                switch ($type) {
                    case 'batsman':
                        $numBatsmen++;
                        break;
                    case 'all-rounder':
                        $numAllRounders++;
                        break;
                    case 'bowler':
                        $numBowlers++;
                        break;
                }
                // Increment total points by the points of the selected player
                $totalPoints += $playerData['points'];
            }

            // Check if the number of selected players is exactly 11
            if($numPlayers != 11){
                $_SESSION['status']="You must select exactly 11 players.";
                header('Location : feed.php');
            }
            // Check if the total points of selected players is less than 100
            else if($totalPoints > 100){
                $_SESSION['status']= "Total points of selected players must be less than 100.";
                header('Location : feed.php');
            }
            elseif ($numBatsmen != 5 || $numAllRounders != 2 || $numBowlers != 4) {
                echo "Please select the correct number of players of each type";
                exit;
            }
            // Otherwise, selected players are valid
            else{
                $user= new postDB();
                $user->reducePoints($totalPoints);
                $user->playerAdded($_POST['player']);
                header('Profile.php');
            }
        }
?>