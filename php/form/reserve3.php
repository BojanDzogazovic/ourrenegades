<?php 
$connect = mysqli_connect("sql202.epizy.com", "epiz_21987433", "LiwJjSJkAcdS", "epiz_21987433_reserving");

$name3 = $phone3 = $email3 = $numoftickets3 = $message3 = "";
$name_error3 = $phone_error3 = $email_error3 = $numoftickets_error3 = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit3"])) {
    if (empty($_POST["name3"])) {
        $name_error3 = "Please enter your name and surname.";
    } else {
        $name3 = test_input3($_POST["name3"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name3)) {
        $name_error3 = "Only letters and space are allowed.";
         }
        $name3 = mysqli_real_escape_string($connect, $_POST["name3"]);
  }    
    if (empty($_POST["phone3"])) {
        $phone_error3 = "Please enter your phone number.";
    } else {
        $phone3 = test_input3($_POST["phone3"]);
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone3)) {
        $phone_error3 = "Invalid phone number format.";
        }
        $phone3 = mysqli_real_escape_string($connect, $_POST["phone3"]);  
  }  
    if (empty($_POST["email3"])) {
        $email_error3 = "Please enter your email address.";
    } else {
        $email3 = test_input3($_POST["email3"]);
        if (!filter_var($email3, FILTER_VALIDATE_EMAIL)) {
        $email_error3 = "Invalid email format.";
        }
        $email3 = mysqli_real_escape_string($connect, $_POST["email3"]);  
  }     
    if (empty($_POST["numoftickets3"])) {
        $numoftickets_error3 = "Please select number of ticket you want to buy.";
    } else {
        $numoftickets3 = test_input3($_POST["numoftickets3"]);
        $numoftickets3 = mysqli_real_escape_string($connect, $_POST["numoftickets3"]);
  }
    
    $message3 = mysqli_real_escape_string($connect, $_POST["message3"]);

    if($name_error3 == "" && $phone_error3 == "" && $email_error3 == "" && $numoftickets_error3 == "") {
    $query = "INSERT INTO munich (name, phone, email, numoftickets, message) VALUES ('$name3','$phone3','$email3','$numoftickets3', '$message3')";
        if(mysqli_query($connect, $query)) {
            $name3 = $phone3 = $email3 = $numoftickets3 = $message3 = "";
        }
    } 
}
function test_input3($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
mysqli_close($connect);
require "rheader.php";
?>
<form method="post" class="form">
    <div class="form-group header">
        <p class="place">You want to get reservation for a concert in:<br>Munich, Mannheimer Rosengarten, 11th March 2018 @ 21:00h?</p>
        <p class="price">Price per ticket is $15 on reservation, and $19 on the day of event.</p>
    </div>
    <div class="container">
        <div class="form-group field">
            <input type="text" name="name3" class="form-control purchase" value="<?php echo $name3 ?>" placeholder="Your name and surname..*">
            <span class="form_error"><?php echo $name_error3?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="phone3" class="form-control purchase" value="<?php echo $phone3 ?>" placeholder="Your phone number..*">
            <span class="form_error"><?php echo $phone_error3?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="email3" class="form-control purchase" value="<?php echo $email3 ?>"  placeholder="Your e-mail..*">
            <span class="form_error"><?php echo $email_error3?></span>
        </div>
        <div class="form-group field">
            <input type="number" name="numoftickets3" class="form-control purchase" value="<?php echo $numoftickets3 ?>" placeholder="How many tickets would you like to buy?*">
            <span class="form_error"><?php echo $numoftickets_error3?></span>        
        </div>
        <div class="form-group field">
            <textarea name="message3" class="form-control purchase" placeholder="If you have any additional questions or requests, write them here! :)" rows="5"><?php echo $message3 ?></textarea>       
        </div>
        <button type="submit" name="submit3" class="order">Reserve!</button>
    </div>
</form>
<?php require "footer.php"; ?>
