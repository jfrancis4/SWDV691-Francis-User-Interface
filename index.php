<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set the title of the page to be Renda -->
    <title>P2P Rentals</title>
    <meta charset="utf-8">
     <!-- Link to the bootstrap stylesheet -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Link to the script.js file, which contains the logic to trigger the hamburger menu -->
    <script src="script.js" defer></script>
    <!-- Link to the mustache files, which are responsible for displaying all the photos on the homepage -->
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="mustache.js"></script>
    <script type="text/javascript" src="photos.js"></script>

    <!-- Set  custom container and content styling for the login page to vertically center them -->
    <style>
        #container {
                background-color: white;
                margin: auto;
                margin-top: 17%;
                margin-bottom: 1%;
                height: auto;
                
        }
            /*set the content margins, set the display as grid and add a shadow for styling*/

        #content {
            
            margin-top: 10%;
            background-color: white;
            margin-left: 30%;
            display: grid;
            padding: 5%;
            width: 40%;
            padding-bottom: 1%;
            margin-bottom: 1%;
            height: auto;
            box-shadow: 10px 10px 5px rgb(48,48,48);
        }
        #error-message{
            color: red;
            display: none;
            text-align: center;

        }
    </style>
</head>

<?php
$host="localhost";
$user="root";
$password="password1";
$db="p2p_rentals"; 

$conn = new mysqli($host, $user, $password,$db) or die("Connect failed: %s\n". $conn -> error);
/*mysql_connect($host,$user,$password,$db);
/*mysql_select_db($db);
/*
// Create connection
$conn = new mysqli_connect($host, $user, $password, $db);
// Check connection
*/
if (!$conn) {
die(mysqli_error());
} else{
/*echo"connected!";*/
if(isset($_POST['submit'])){
    $username=$_POST['Username'];
    $password=$_POST['password'];

    $result = $conn->query("select * from rentees where username='".$username."' AND password='".$password."' limit 1");

    /*$sql="select * from rentees where username='".$username."' AND password='".$password."' limit 1";
    
    $sql="select * from rentees";
    $result=mysql_query($sql);
    */

    $row_cnt = $result->num_rows;

    $row = mysqli_fetch_assoc($result);
    $user_id=$row["rentee_id"];

    if($row_cnt==1){
        echo "Login successful!";
        header("Location: home2.php?id=".$user_id);
        die();
    }
    else{        
        ?>
        <script>
        window.alert("Incorrect username or password! Please try again");
        </script>
        <?php
            
    }

    }

//---continue to do other things
}
/*
if(isset($_POST['submit'])){
    $username=$_POST['Username'];
    $password=$_POST['password'];

    $sql="select * from rentees where username='".$username."' AND password='".$password."' limit 1";

    $result=mysql_query($sql);

    if(mysql_num_rows($result)==1){
        echo "Login successful!";
        exit();
    }
    else{
        echo "Invalid login credentials";
        exit();
    }
}; */
?>


<body>

    <!-- Open containe, row and content areas -->
    <div class="container">
        <div class="row">    
                    <div id="content">
                        <div style="text-align: center;">
                            <!-- Insert the logo image at specified size -->
                            <img src="RendaLogo.PNG" width="158px" height="98px" style="text-align: center;"/>
                        </div>
                        <br>
                        <br>

                        <form action="index.php" method="POST" enctype="multipart/form-data">
                                <!-- Set the label and input for username -->
                                <label for="UserName" style="color: rgb(0,176,80);">User Name:</label>
                                <input type="input" name="Username" id="Username" class="inputField" value="" style="width: 350px;">
                            <br>
                            <br>
                                <!-- Set the label and input for password -->
                                <label for="Password" style="color: rgb(0,176,80);">Password:</label>
                                <input type="input" name="password" id="password" class="inputField" value="" style="width: 350px;">
                            <br>
                            <br>
                            <div id="error-message">Login Failed! Username or Password Incorrect</div>
                            <!-- Wrap the form buttons in the div class form-buttons, this is so they can be displayed
                        aligned to the right and adjacent to one another -->
                            <div class="form-buttons" style="text-align: right;">
                                <!-- Set a button to clear the form -->
                                <button class="button" type="reset" value="Clear">CLEAR FORM</button>
                                &nbsp;&nbsp;&nbsp;
                                <!-- Set a button to create a new account -->
                                <button class="button" type="reset" value="Clear"><a href="newaccount.php">NEW ACCOUNT</a></button>
                                &nbsp;&nbsp;&nbsp;
                                <!-- Set a button to login -->
                                <button class="button" type="submit" name="submit">LOGIN</button> 
                                
                            </div>
                        </form>
            
        </div>
    </div>     

</body>
</html>