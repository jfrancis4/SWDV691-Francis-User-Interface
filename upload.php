<!-- This script uploads the image from page4.php and amends the test.xml file with the data from the form -->
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
    /* if the posted with the submit go ahead and run the following */
    if(isset($_POST['submit'])){
        /* get all the variables from the POST request including all file attributes, name, size, tmp_name and type and if there was an error */
        $file = $_FILES['inpFile'];

        $fileName = $_FILES['inpFile']['name'];
        $fileTmpName = $_FILES['inpFile']['tmp_name'];
        $fileSize = $_FILES['inpFile']['size'];
        $fileError = $_FILES['inpFile']['error'];
        $fileType = $_FILES['inpFile']['type'];

        /* Get the title and description in preparation to append to xml */
        $renter_id=$_GET['renter_id'];
        $name = $_POST['name'];
        $rent_price = $_POST['rent_price'];
        $buy_price = $_POST['buy_price'];
        $category = $_POST['category'];
        $rent_duration = $_POST['rent_duration'];
        $payment_method = $_POST['payment_method'];
        $contact_method = $_POST['contact_method'];
        $description = $_POST['description'];

        /* get the extension of the fileName and force it to all lower-case */
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        /* keep only jpg, jpeg, png and gif as the allowed file types */
        $allowed = array('jpg','jpeg','png','gif');
        

        /* if the actual extension of the file is within the array of allowed file types proceed, else throw an error message */
        if(in_array($fileActualExt, $allowed)){
            /* If there was no file error, proceed */
            if($fileError===0){
                /* If the file size is less than 10MB, then proceed */
                if($fileSize<10000000){

                    $result = $conn->query("select max(item_id) as item_id from items");
                    $row = mysqli_fetch_assoc($result);
                    $item_id=$row['item_id']+1;

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


                    $result = $conn->query("select * from renters where renter_id=$renter_id");

                    $row_cnt = $result->num_rows;

                    $row = mysqli_fetch_assoc($result);

                    if($row_cnt==0){
                        $result2 = $conn->query("select * from rentees where rentee_id=$renter_id");
                        $row2 = mysqli_fetch_assoc($result2);
                        $name2=$row2['name'];
                        $username2=$row2['username'];
                        $password2=$row2['password'];
                        $email2=$row2['email'];
                        $street_address2=$row2['street_address'];
                        $city2=$row2['city'];
                        $zip2=$row2['zip'];
                        $phone2=$row2['phone'];

                        $sql = "INSERT INTO renters ".
                        "(renter_id, name, username, password, email, street_address, city, zip, phone) "."VALUES ".
                        "('$renter_id','$name2','$username2','$password2','$email2','$street_address2','$city2','$zip2','$phone2')";

                        $conn->query($sql);
                        /* if ($conn->query($sql)) {
                            printf("Inserted record into renters table:");
                            echo $renter_id;
                            die();
                        }

                        else {
                            printf("Could not insert record into renters table:");
                            echo $renter_id;
                            die();
                        }
                    } */
                }

                    
                        
                    /* if ($conn->query($sql)) { */
                        $url2="images\\\\\\".($item_id).".".$fileActualExt;
                        /* load the test.xml file and get the attribute with the max id */
                        $sql2 = "INSERT INTO items ".
                        "(item_id, renter_id, name, rent_price, buy_price, category_id, rent_duration, payment_method, contact_method, description, url) "."VALUES ".
                        "('$item_id', '$renter_id', '$name', '$rent_price', '$buy_price', '$category_id', '$rent_duration', '$payment_method', '$contact_method', '$description', '$url2')";
                        if ($conn->query($sql2)) {

                            /* calculate the file path to images folder and assign to fileDesination in preparation to move file */
                            $fileDestination = "images/".($item_id).".".$fileActualExt;

                            /* Move the uploaded file to the fileDesination */
                            /* TEST CASE 27 - verify that the file has been moved to the images folder */
                            move_uploaded_file($fileTmpName, $fileDestination);
                            /* Redirect user to page2.php */
                            /* TEST CASE 28 - Verify that the user is redirected to page2 after upload is complete */
                            header("Location: home2.php?id=$renter_id");

                            die();
                        }
                        else {
                            printf("Could not insert record into items table:");
                            echo $renter_id;
                        }
                            die();
                    /* }
                    else {
                        printf("Could not insert record into renters table:");
                    } */

                    

    
                }else{
                    /* TEST CASE 29-test by uploading a file larger than 10 MB to see if error is thrown */
                    echo "File size exceeds 10MB. Please reupload a file that's 10MB or less";
                    exit();
                }
                                
            }
            else{
                echo "There was an error uploading the file!";
                exit();
            }


        }else{
            /* TEST CASE 30 - test by uploading a non-image file to see if error is thrown */
            echo "You did not select an image file. Please only upload PNG/JPG/GIF image files.";
            exit();

        };
        

    };
}
?>