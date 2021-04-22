<?php
session_start();
// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}
// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
	session_destroy(); 
    header('Location: index.php');
    return;
}
// Set up the values for the game...
// 0 is Rock, 1 is Paper, 2 is Scissors, 3 is Lizard and 4 is Spock
$names = array('Rock', 'Paper', 'Scissors','Lizard','Spock');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;
$computer = rand(0,4);

// This function takes as its input the computer and human play
// and returns "Tie", "You Lose", "You Win" depending on play
// where "You" is the human being addressed by the computer
function check($computer, $human) {
    if (( $human - $computer )%5 == 0) {
        return "Tie";
    } else if ((( $human - $computer + 5)%5 == 1) OR (( $human - $computer + 5)%5 == 2)){
        return "You Win";
    } else if ((( $human - $computer + 5)%5 == 3) OR (( $human - $computer + 5)%5 == 4)){
        return "You Lose";
    }
    
    return false;
}
// Check to see how the play happenned
if($human!=-1)
{
	$result = check($computer, $human);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Zhong Shan Hui 354ae7eb</title>
<?php require_once "bootstrap.php"; 
?>
</head>
<body>
<div class="container">
<h1>Rock Paper Scissors Lizard Spock</h1>
<?php
if ( isset($_REQUEST['name']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    echo "</p>\n";
}
?>
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Lizard</option>
<option value="4">Spock</option>
<option value="5">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 5 ) {
    for($c=0;$c<5;$c++) {
        for($h=0;$h<5;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
</pre>
</div>
</body>
</html>
