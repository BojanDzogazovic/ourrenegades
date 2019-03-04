<?php 
$connect = mysqli_connect("sql202.epizy.com", "epiz_21987433", "LiwJjSJkAcdS", "epiz_21987433_buying");

$name4 = $phone4 = $email4 = $numoftickets4 = "";
$name_error4 = $phone_error4 = $email_error4 = $numoftickets_error4 = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit4"])) {
    if (empty($_POST["name4"])) {
        $name_error4 = "Please enter your name and surname.";
    } else {
        $name4 = test_input4($_POST["name4"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name4)) {
        $name_error4 = "Only letters and space are allowed.";
         }
        $name4 = mysqli_real_escape_string($connect, $_POST["name4"]);
  }    
    if (empty($_POST["phone4"])) {
        $phone_error4 = "Please enter your phone number.";
    } else {
        $phone4 = test_input4($_POST["phone4"]);
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone4)) {
        $phone_error4 = "Invalid phone number format.";
        }
        $phone4 = mysqli_real_escape_string($connect, $_POST["phone4"]);  
  }  
    if (empty($_POST["email4"])) {
        $email_error4 = "Please enter your email address.";
    } else {
        $email4 = test_input4($_POST["email4"]);
        if (!filter_var($email4, FILTER_VALIDATE_EMAIL)) {
        $email_error4 = "Invalid email format.";
        }
        $email4 = mysqli_real_escape_string($connect, $_POST["email4"]);  
  }     
    if (empty($_POST["numoftickets4"])) {
        $numoftickets_error4 = "Please select number of ticket you want to buy.";
    } else {
        $numoftickets4 = test_input4($_POST["numoftickets4"]);
        $numoftickets4 = mysqli_real_escape_string($connect, $_POST["numoftickets4"]);
  }
    if($name_error4 == "" && $phone_error4 == "" && $email_error4 == "" && $numoftickets_error4 == "") {
    $query = "INSERT INTO rome(name, phone, email, numoftickets) VALUES ('$name4','$phone4','$email4','$numoftickets4')";
        if(mysqli_query($connect, $query)) {
            $name4 = $phone4 = $email4 = $numoftickets4 = "";
        }
    } 
}
function test_input4($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
mysqli_close($connect);
require "header.php";
?>
<form method="post" class="form">
    <div class="form-group header">
        <p class="place">Italy, Rome, Casa di Opera<br>11th february 2018 @ 20:00h</p>
        <p class="price">Price of ticket is $19 for one, and $29 for a pair.</p>
    </div>
    <div class="container"> 
        <div class="form-group field">
            <input type="text" name="name4" class="form-control purchase" value="<?php echo $name4 ?>" placeholder="Your name and surname..*">
            <span class="form_error"><?php echo $name_error4?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="phone4" class="form-control purchase" value="<?php echo $phone4 ?>" placeholder="Your phone number..*">
            <span class="form_error"><?php echo $phone_error4?></span>
        </div>
        <div class="form-group field">
            <input type="text"  name="email4" class="form-control purchase" value="<?php echo $email4 ?>" placeholder="Your e-mail..*">
            <span class="form_error"><?php echo $email_error4?></span>
        </div>
        <div class="form-group field">
            <input type="number" name="numoftickets4" class="form-control purchase" value="<?php echo $numoftickets4 ?>" placeholder="How many tickets would you like to buy?*">
            <span class="form_error"><?php echo $numoftickets_error4?></span>  
        </div>
        <button type="submit" name="submit4" class="order">Buy!</button>
    </div>
</form>
<?php require "footer.php"; ?>
