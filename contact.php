<!-- This script uploads the image from page4.php and amends the test.xml file with the data from the form -->
<?php

    /* if the posted with the submit go ahead and run the following */
    if(isset($_POST['submit'])){
        $user_id=$_GET['renter_id'];
        /* get all the variables from the POST request including all file attributes, name, size, tmp_name and type and if there was an error */
        $email=$_POST['email'];
        $subject=$_POST['subject'];
        $message=$_POST['description'];

        $mail_to="joshua.francis@live.com";
        $headers="From: ".$email;
        $txt = "You have receieved an e-mail from ".$name.".\n\n".$message;

        mail($mail_to, $subject, $txt, $headers);
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';

        header("Location: home2.php?id=$user_id");

        
        

    };
?>