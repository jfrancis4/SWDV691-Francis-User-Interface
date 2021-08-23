<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set the title of the page to be Renda -->
    <title>P2P Rentals</title>
    <meta charset="utf-8">
    <!-- Link to the bootstrap stylesheet -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Link to stylesheet for social media links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="styles.css">
    <!-- Link to the script.js file, which contains the logic to trigger the hamburger menu -->
    <script src="script.js" defer></script>
    <!-- Link to the mustache files, which are responsible for displaying all the photos on the homepage -->
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="mustache.js"></script>
    <script type="text/javascript" src="photos.js"></script>
</head>
<?php

                $user_id=$_GET['user_id'];
                $item_id=$_GET['item_id'];
?>
<body>
    <div class="container">
        <!-- Header is contained within a row class which consists of three columns -->
        <div class="row" style="box-shadow: 10px 10px 5px rgb(48,48,48);">
            <div class="col-lg-2">
                <!-- In the first column of the header, place the renda logo and have it link back to the homepage -->
                <div role="img" aria-label="Image of Renda Logo, click it to go to the home page">
                    <a href="home2.php?id=<?php echo $user_id ?>">
                        <img src="RendaLogo.png" width="158px" height="98px">
                    </a>
                </div>
            </div>
            <!-- In the second column of the header, place the search bar and the label -->
            <div class="col-lg-8" style="height: 98px; padding-top: 30px;">
                <form>
                    <label for="search" class="inputLabel">Search</label>
                    <input type="input" id="name" class="inputField" value="">
                </form>
            </div>
            <!-- In the third columnn of the header, place the logout button -->
            <div class="col-lg-2" style="height: 98px; padding-left: 50px;">
                <button class="button2"><a href="index.php">Logout</a></button>
            </div>

            <!-- Create the navbar which is placed right below the header -->
            <nav class="navbar">
                <!-- Show the navbar logo when the main logo is hidden -->
                <div class="logo"><img src="RendaLogoNav.PNG" style="max-width:30%; max-height:30%;"></div>
                <a href="#" class="toggle-button">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
                <!-- Display the two navbar links -->
                <div class="navbar-links">
                    <ul>
                        <li><a href="#">Categories</a></li>
                        <li><a href="newposting.php?user_id=<?php echo $user_id ?>">New Posting</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <?php
            $host="localhost";
            $user="root";
            $password="password1";
            $db="p2p_rentals"; 

            $conn = new mysqli($host, $user, $password,$db) or die("Connect failed: %s\n". $conn -> error);

            $user_id=$_GET['user_id'];
            $item_id=$_GET['item_id'];

            $result = $conn->query("select * from items where item_id=".$item_id);

            $row = mysqli_fetch_assoc($result);

            $result2 = $conn->query("select * from categories where category_id=".$row["category_id"]);


            $row2 = mysqli_fetch_assoc($result2);

            $category_name=$row2["category_name"];

            if(isset($_POST['submit'])){
                $user_id=$_GET['user_id'];
                $item_id=$_GET['item_id'];

                $result3 = $conn->query("select max(transaction_id) as transaction_id from transactions");


                $row3 = mysqli_fetch_assoc($result3);

                $transaction_id=$row3['transaction_id']+1;

                echo $transaction_id;

                $renter_id=$row['renter_id'];
                $item_id=$row['item_id'];
                $item_name=$row['name'];
                $rent_duration=$row['rent_duration'];

                echo $renter_id;
                echo $user_id;
                echo $item_id;
                echo $item_name;
                echo $rent_duration;

                $sql2 = "INSERT INTO transactions ".
                "(transaction_id, renter_id, rentee_id, item_id, item_name, rent_duration,rent_or_buy) "."VALUES ".
                "('$transaction_id','$renter_id','$user_id','$item_id','$item_name','$rent_duration','rent')";

            

                if ($conn->query($sql2)) {
                    header("Location: confirmation.php?item_id=".$item_id."&user_id=".$user_id."&transaction_id=".$transaction_id);
                    die();
                }
                else {
                    printf("Could not insert record into table:");
                }
            }



    ?>

        <!-- Open up a row element for the content section -->
        <div class="row">
            <!-- Open up a postmain section, which consists of white background with shadow -->
                <div class="postmain">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- In the first column display the title, which is loaded from a JS url variable -->
                            <h1 id="title"><?php echo $row["name"] ?></h1>
                        </div>
                        <!-- In the second column display the category, which is loaded from a JS url variable-->
                        <div class="col-lg-6" style="text-align: right; padding-right: 40px;"><h3 id="category">
                        <?php echo $category_name?><h3></div>
                    </div>


                    <br>
                    <!-- Place the image on the page dynamically -->
                    <div id="imgDiv">

                    <img src="<?php echo $row["url"]?>">
                    <br>
                    <br>

                    <!-- Insert the information for the item including description, price, payment method, contact info and rental duration -->

                    <p> <b>Item Description: </b><?php echo $row["description"] ?></p>
                    <p><b>Price: </b> <?php echo $row["rent_price"] ?></p>
                    <p><b>Payment Method: </b> <?php echo $row["payment_method"] ?></p>
                    <p><b>Contact Info: </b> <?php echo $row["contact_method"] ?></p>
                    <p><b>Rental Duration: </b> <?php echo $row["rent_duration"] ?></p>
            </div>

            <div class="form-buttons" style="text-align: right;">
                
                <!-- Set the Send form button -->
                
        <form action="detailed.php?item_id=<?php echo $row["item_id"] ?>&user_id=<?php echo $user_id ?>" method="POST" enctype="multipart/form-data">
                <button class="button" type="submit" name="submit">PLACE ORDER</button> 
        </form>

            </div>
            
        </div>

        
        

        <!-- define the target div location where the contents of the script get written into -->

        <div id="target"></div>


        <!-- Define the footer row, which consists of two columns -->
        <div class="row" style="margin-top: 20px;">
            <!-- Have the first column contain the copyright information -->
            <div class="col-lg-8">

                ©2021 P2P Rentals
            </div>

            <!-- Have the second column contain the social media links, about us and contact us links -->
            <div class="col-lg-4">
                <a href="#" class="fa fa-facebook" style="width: 60px; margin-top: 15px;"></a>
                <a href="#" class="fa fa-twitter" style="width: 80px;"></a>
                <button class="button2"><a href="aboutus.php?user_id=<?php echo $user_id ?>">About Us</a></button>
                <button class="button2"><a href="contactus.php?user_id=<?php echo $user_id ?>">Contact Us/FAQ</a></button>
                
            </div>
        <div>
    </div>
</body>
</html>