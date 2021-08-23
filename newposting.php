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

                $user_id=$_GET['user_id'];
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
                        <li><a href="home2.php?id=<?php echo $user_id ?>">Home</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Open up a row element for the content section -->
        <div class="row">
                <!-- Open up a postmain section, which consists of white background with shadow -->
                <div class="postmain">

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Set the Post Item Heading -->
                            <h3 id="title"><b>Post Item</b></h3>
                        </div>
                        <div class="col-lg-6" style="text-align: right; padding-right: 40px;"><h3 id="category"><h3></div>
                    </div>


                    <br>
                <form action="upload.php?renter_id=<?php echo $user_id ?>" method="POST" enctype="multipart/form-data">

                    <!-- Create a table for the new item form -->
                    <table class="AddForm">
                        <!-- Add a new table row for the Title-->
                        <tr>
                            <!-- Align title text label right -->
                            <td align="right">
                                Title:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align title input box left -->
                            <td align="left">
                                <input type="input" id="name" name="name" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Price text label right -->
                            <td align="right">
                                Price:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align price input box left -->
                            <td align="left">
                                <input type="input" id="rent_price" name="rent_price" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Price text label right -->
                            <td align="right">
                                Buy Price:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align price input box left -->
                            <td align="left">
                                <input type="input" id="buy_price" name="buy_price" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Category text label right -->
                            <td align="right">
                                Category:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Category input box left -->
                            <td align="left">
                                <!-- Category drop down menu consisting of the following items -->
                                <select id="category" name="category">
                                    <option value="Electronics">Electronics</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Home/Bath">Home/Bath</option>
                                    <option value="Outdoor/Camping">Outdoor/Camping</option>
                                  </select>
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Rental duration text label right -->
                            <td align="right">
                                Rental Duration:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Rental duration input box left -->
                            <td align="left">
                                <input type="input" id="rent_duration" name="rent_duration" class="inputField" value="" style="width: 90px;">
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Payment Method text label right -->
                            <td align="right">
                                Payment Method:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Payment Method input box left -->
                            <td align="left">
                                <select id="payment_method" name="payment_method">
                                    <!-- Payment Method drop down menu -->
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Cryptocurrency">Cryptocurrency</option>
                                  </select>
                                <br><br>
                            </td>
                        </tr>

                        <tr>
                            <!-- Align Contact Method text label right -->
                            <td align="right">
                                Contact Method:&nbsp;&nbsp;
                                <br><br>
                            </td>
                            <!-- Align Contact Method input box left -->
                            <td align="left">
                                <!-- Contact Method drop down menu -->
                                <select id="contact_method" name="contact_method">
                                    <option value="Phone">Phone</option>
                                    <option value="Email">Email</option>
                                    <option value="Social Media">Social Media</option>
                                  </select>
                                <br><br>
                            </td>
                        </tr>

                        


                        <!-- Add a new table row for the Image choose file -->
                        <tr>
                            <!-- Align Image text label right -->
                            <td align="right">
                                <br><br><br><br><br>Image:&nbsp;&nbsp;

                            </td>
                            <!-- Align the Image input button left -->
                            <td align="left"><br>
                                <!-- TEST CASE 20 - Test that an image is really required -->
                                <input type="file" required="required" name="inpFile" id="inpFile" accept="image/x-png,image/gif,image/jpeg">
                                <br>
                                <br>
                                <!-- Set the class for the image-preview to allow the user to see a preview of the image they're about to upload -->
                                <div class="image-preview" id="imagePreview">
                                    <img src="" alt="Image Preview" class="image-preview__image">
                                    <span class="image-preview__default-text">Image Preview</span>
                                </div>
                            </td>
                        </tr>

                        <script>

                            /* Define the variables needed by getting the inpFile and ImagePreview elements */
                            const inpFile = document.getElementById("inpFile");
                            const previewContainer = document.getElementById("imagePreview");
                            const previewImage = previewContainer.querySelector(".image-preview__image");
                            const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

                            /* function to clear the image if called */
                            function clearImage() {
                                /* Set the previewDefault text style to null since no image is being displayed */
                                previewDefaultText.style.display = null;
                                previewImage.style.display = null;
                                /* Set the previewImage to be blank */
                                previewImage.setAttribute("src","")
                            }

                            /* Add an event listener to the inpFile input box, this will trigger this portion of the code ant time
                            a file is selected */
                            inpFile.addEventListener("change", function() {
                                    /* set the file as inpFile user picked */
                                    const file = this.files[0];

                                    /* TEST CASE 21 - Test to see that a file picked is displayed properly */
                                    /* If file exists then proceed to display image */
                                    if (file){
                                        /* create new file reader */
                                        const reader = new FileReader();

                                        /* Set the previewDefaultText display to be none and display style as block*/
                                        previewDefaultText.style.display = "none";
                                        previewImage.style.display = "block";

                                        /* add an event listener to this new reader to have it passed to previewImage after 
                                        the file is read */
                                        reader.addEventListener("load", function() {
                                            /* set the previewImage file source to be the one just read */
                                            previewImage.setAttribute("src", this.result);
                                        });
                                        /* have the reader read the file */
                                        reader.readAsDataURL(file);

                                    }
                                    /* If no file was picked in inpFile proceed to display default box and undisplay
                                    any image that was there previously as the user deselected it*/
                                    /* TEST CASE 22 - If user selects image and then proceeds to deselect it, verify that the 
                                    image disappears from the preview window */
                                    else{
                                        
                                        previewDefaultText.style.display = null;
                                        previewImage.style.display = null;
                                        previewImage.setAttribute("src","")
                                    }
                            });
                        </script>

                        <!-- Add a new table row for the description label and input -->
                        <tr>
                            <!-- Align the description label right -->
                            <td align="right"><br>
                                <br>Description:&nbsp;&nbsp;<br><br>
                            </td>
                            <!-- Align the description text box left -->
                            <td align="left"><br>
                                <br><textarea id="description" required="required" name="description" rows="3" cols="45"></textarea><br><br>
                            </td>
                        </tr>
                    </table>

                    <br>
                        <!-- Add the form-buttons to the bottom of the table -->
                        <div class="form-buttons" style="text-align: right;">
                            <!-- TEST CASE 24 - verify that the CLEAR FORM button indeed clears the form -->
                            <button class="button" type="reset" value="Clear">CLEAR FORM</button>
                            &nbsp;&nbsp;&nbsp;
                            <!-- Upload photo button will submit the photo to upload.php to valdidate and upload -->
                            <button class="button" type="submit" name="submit">POST</button>
                            &nbsp;&nbsp;&nbsp;
                            <!-- TEST CASE 25 - verify that the CLEAR IMAGE button deselects any selected image -->
                            <button class="button" type="button" onclick="clearImage()">CLEAR SELECTED IMAGE</button>
                            
                            
                        </div>
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