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
    <!-- Link to stylesheet for social media links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Link to the script.js file, which contains the logic to trigger the hamburger menu -->
    <script src="script.js" defer></script>
    <!-- Link to the mustache files, which are responsible for displaying all the photos on the homepage -->
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="mustache.js"></script>
    <script type="text/javascript" src="photos.js"></script>
</head>

<?php
$host="localhost";
$user="root";
$password="password1";
$db="p2p_rentals"; 

$conn = new mysqli($host, $user, $password,$db) or die("Connect failed: %s\n". $conn -> error);
$user_id=$_GET['id'];

?>

<body>
    <div class="container">
        <!-- Header is contained within a row class which consists of three columns -->
        <div class="row" style="box-shadow: 10px 10px 5px rgb(48,48,48);">
            <div class="col-lg-2">
                <!-- In the first column of the header, place the renda logo and have it link back to the homepage -->
                <div role="img" aria-label="Image of Renda Logo, click it to go to the home page">
                <a href="home2.php?id=<?php echo $user_id ?>">
                        <img src="RendaLogo.PNG" width="158px" height="98px">
                    </a>
                </div>
            </div>
            <!-- In the second column of the header, place the search bar and the label -->
            <div class="col-lg-8" style="height: 98px; padding-top: 30px;">
                <form action="home2.php?id=<?php echo $user_id ?>" method="post">
                    <label for="search" class="inputLabel">Search</label>
                    <input type="input" id="submit2" name="submit2" type="submit" class="inputField" value="">
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
                        <button class="button2" type="reset" value="Clear"><a href="home2.php?id=<?php echo $user_id ?>&category=Outdoor/Camping">Outdoor/Camping</a></button>
                        <button class="button2" type="reset" value="Clear"><a href="home2.php?id=<?php echo $user_id ?>&category=Electronics">Electronics</a></button>

                        <button class="button2" type="reset" value="Clear"><a href="home2.php?id=<?php echo $user_id ?>&category=Furniture">Furniture</a></button>

                        <button class="button2" type="reset" value="Clear"><a href="home2.php?id=<?php echo $user_id ?>&category=Clothing">Clothing</a></button>
                        <button class="button2" type="reset" value="Clear"><a href="home2.php?id=<?php echo $user_id ?>&category=Home/Bath">Home/Bath</a></button>

                        <button class="button2" type="reset" value="Clear"><a href="newposting.php?user_id=<?php echo $user_id ?>">New Posting</a></button>

                        <!-- <?php

                                    /* if(isset($_GET['category'])) {
                                        // id index exists
                                        echo '<script language="javascript">';
                                        echo '<script type="text/javascript">alert("You selected category '.$_GET['category'].'");</script>';
                                        echo '</script>';
                                    }
 */
                        ?> -->

                </div>
            </nav>
        </div>

        <!-- define the script template for the mustache framework, this writes all the images from the respective columns in the photos.js file
        into the template below. This reduces code by eliminating the need to redefine a postleft class and image source html for each photo manually
    in the html file. This leads to less code and more maintability. The url is also passed in with image path variables, title variable and category variable -->
    <br>

            <!-- write all the col1 block variables into the template in the first column which consists of all the image paths -->
            <div class="row">

            <?php

            if (!$conn) {
                die(mysqli_error());
                } 
            
            else{
                $user_id=$_GET['id'];

                if(isset($_GET['category'])) {

                    $category=$_GET['category'];
                    // id index exists
                    switch ($category) {
                        case "Outdoor/Camping":
                            $category_id=1;
                            break;
                        case "Electronics":
                            $category_id=2;
                            break;
                        case "Furniture":
                            $category_id=3;
                            break;
                        case "Clothing":
                            $category_id=4;
                            break;
                        case "Home/Bath":
                            $category_id=5;
                            break;
                    }
                    $result = $conn->query("select * from items where renter_id<>".$user_id." and category_id=".$category_id);

                    $row_cnt = $result->num_rows;
                } elseif(isset($_POST['submit2'])){

                    
                    $result = $conn->query("select * from items where renter_id<>".$user_id." and name like '%".$_POST['submit2']."%'");
                    $row_cnt = $result->num_rows;

                }
                else{
                    $result = $conn->query("select * from items where renter_id<>".$user_id);

                    $row_cnt = $result->num_rows;

                }


                if($row_cnt==0){
                    ?>
                    <div class="row">
                         <p style="color: white; text-align: center">Sorry, no items were found</p>
                    <?php
                }
                else{        

                    while ($row = mysqli_fetch_assoc($result)) {
                        $categoryId=$row["category_id"];
                        $result2 = $conn->query("select category_name from categories where category_id='$categoryId'");
                            
                        $row2 = mysqli_fetch_assoc($result2);
                        $categoryNm=$row2['category_name'];


                        if ((int) $row["item_id"]+1 % 3 === 0) {
                            ?>
                            </div>

                            <div class="row">
                            <div class="col-md-4">
                                <div class="postleft">
                                <p style="text-align:right">
                                <a href="detailedBuy.php?item_id=<?php echo $row["item_id"] ?>&user_id=<?php echo $user_id ?>" style="color: #00b050">Buy</a> 
                                <a href="detailed.php?item_id=<?php echo $row["item_id"] ?>&user_id=<?php echo $user_id ?>" style="color: #00b050">Rent</a></p>
                                <img src="<?php echo $row["url"] ?>"/>
                                </div>
                            </div>

                            <?php
                        }
                        else{
                            ?>
                            <div class="col-md-4">
                                <div class="postleft">
                                <p style="text-align:right">
                                <a href="detailedBuy.php?item_id=<?php echo $row["item_id"] ?>&user_id=<?php echo $user_id ?>" style="color: #00b050">Buy</a> 
                                <a href="detailed.php?item_id=<?php echo $row["item_id"] ?>&user_id=<?php echo $user_id ?>" style="color: #00b050">Rent</a></p>
                                <img src="<?php echo $row["url"] ?>"/>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                }        
                ?>

        <!-- define the target div location where the contents of the script get written into -->
                <br>
            </div>

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