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
    $name=$_POST['name'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];
    $phone=$_POST['phone'];

    $result = $conn->query("select max(rentee_id) as rentee_id from rentees");

    $row_cnt = $result->num_rows;

    $row = mysqli_fetch_assoc($result);

    $rentee_id=$row['rentee_id']+1;
    
    $sql = "INSERT INTO rentees ".
    "(rentee_id, name, username, password, email, street_address, city, zip, phone) "."VALUES ".
    "('$rentee_id','$name','$username','$password','$email','$address','$city','$zip','$phone')";
           
    if ($conn->query($sql)) {
        echo "Account Successfully created!";
        header("Location: index.php");
        die();
    }
    else {
        printf("Could not insert record into table:");
    }
    /*
    if($row_cnt==1){
        echo "Login successful!";
        header("Location: home.html");
        die();
    }
    else{        
        ?>
        <script>
        window.alert("Incorrect username or password! Please try again");
        </script>
        <?php
            
    }*/

    }

}
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
                        <form action="newaccount.php" method="POST" enctype="multipart/form-data">
                       <!-- Insert a table for the new account form -->
                       <table class="AddForm" style="padding-right: 300px;">
                        <!-- Add a new table row for the Name-->
                        <tr style="text-align: left;">
                            <!-- Align Name text label right -->
                            <td align="right">
                                Name:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Name input box left -->
                            <td align="left">
                                <input type="input" name="name" id="name" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Username text label right -->
                            <td align="right">
                                Username:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Username input box right -->
                            <td align="left">
                                <input type="input" name="username" id="username" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align password text label right -->
                            <td align="right">
                                Password:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align password input box left -->
                            <td align="left">
                                <input type="input" name="password" id="password" class="inputField" value="" style="width: 300px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Email text label right -->
                            <td align="right">
                                Email:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Email input box left -->
                            <td align="left">
                                <input type="input" name="email" id="email" class="inputField" value="" style="width: 300px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Address text label right -->
                            <td align="right">
                                Address:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Address input box left -->
                            <td align="left">
                                <input type="input" name="address" id="address" class="inputField" value="" style="width: 300px;">
                                <br><br>
                            </td>
                        </tr>

                        

                        <tr>
                            <!-- Align City text label right -->
                            <td align="right">
                                City:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align City input box left -->
                            <td align="left">
                                <input type="input" name="city" id="city" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Zip text label right -->
                            <td align="right">
                                Zip:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Zip input box left -->
                            <td align="left">
                                <input type="input" name="zip" id="zip" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Phone text label right -->
                            <td align="right">
                                Phone:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Phone input box left -->
                            <td align="left">
                                <input type="input" name="phone" id="phone" class="inputField" value="" style="width: 200px;">
                                <br><br>
                            </td>
                        </tr>
                        
                    </table>
                            <!-- Wrap the form buttons in the div class form-buttons, this is so they can be displayed
                        aligned to the right and adjacent to one another -->
                            <div class="form-buttons" style="text-align: right;">
                                <!-- Set the Clear Form button -->
                                <button class="button" type="reset" value="Clear">CLEAR FORM</button>
                                &nbsp;&nbsp;&nbsp;
                                <!-- Set the Cancel button -->
                                <button class="button" type="reset" value="Clear"><a href="login.html">CANCEL</a></button>
                                &nbsp;&nbsp;&nbsp;
                                <!-- Set the Create button -->
                                <button class="button" type="submit" name="submit">CREATE</button>                          
                    </div>
    </form>
            
        </div>
    </div>     

</body>
</html>