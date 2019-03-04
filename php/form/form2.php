<?php 
$connect = mysqli_connect("sql202.epizy.com", "epiz_21987433", "LiwJjSJkAcdS", "epiz_21987433_buying");

$name2 = $phone2 = $email2 = $numoftickets2 = "";
$name_error2 = $phone_error2 = $email_error2 = $numoftickets_error2 = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit2"])) {
    if (empty($_POST["name2"])) {
        $name_error2 = "Please enter your name and surname.";
    } else {
        $name2 = test_input2($_POST["name2"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name2)) {
        $name_error2 = "Only letters and space are allowed.";
         }
        $name2 = mysqli_real_escape_string($connect, $_POST["name2"]);
  }    
    if (empty($_POST["phone2"])) {
        $phone_error2 = "Please enter your phone number.";
    } else {
        $phone2 = test_input2($_POST["phone2"]);
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone2)) {
        $phone_error2 = "Invalid phone number format.";
        }
        $phone2 = mysqli_real_escape_string($connect, $_POST["phone2"]);  
  }  
    if (empty($_POST["email2"])) {
        $email_error2 = "Please enter your email address.";
    } else {
        $email2 = test_input2($_POST["email2"]);
        if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
        $email_error2 = "Invalid email format.";
        }
        $email2 = mysqli_real_escape_string($connect, $_POST["email2"]);  
  }     
    if (empty($_POST["numoftickets2"])) {
        $numoftickets_error2 = "Please select number of ticket you want to buy.";
    } else {
        $numoftickets2 = test_input2($_POST["numoftickets2"]);
        $numoftickets2 = mysqli_real_escape_string($connect, $_POST["numoftickets2"]);
  }
    if($name_error2 == "" && $phone_error2 == "" && $email_error2 == "" && $numoftickets_error2 == "") {
    $query = "INSERT INTO madrid(name, phone, email, numoftickets) VALUES ('$name2','$phone2','$email2','$numoftickets2')";
        if(mysqli_query($connect, $query)) {
            $name2 = $phone2 = $email2 = $numoftickets2 = "";
        }
    } 
}
function test_input2($data) {
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
        <p class="place">Spain, Madrid, Auditorio de Musica<br>4th february 2018 @ 21:00h</p>
        <p class="price">Price of ticket is $19 for one, and $29 for a pair.</p>
    </div>
    <div class="container">
        <div class="form-group field">
            <input type="text" name="name2" class="form-control purchase" value="<?php echo $name2 ?>" placeholder="Your name and surname..*">
            <span class="form_error"><?php echo $name_error2?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="phone2" class="form-control purchase" value="<?php echo $phone2 ?>" placeholder="Your phone number..*">
            <span class="form_error"><?php echo $phone_error2?></span>
        </div>
        <div class="form-group field">
            <input type="text"  name="email2" class="form-control purchase" value="<?php echo $email2 ?>" placeholder="Your e-mail..*">
            <span class="form_error"><?php echo $email_error2?></span>
        </div>
        <div class="form-group field">
            <input type="number" name="numoftickets2" class="form-control purchase" value="<?php echo $numoftickets2 ?>" placeholder="How many tickets would you like to buy?*">
            <span class="form_error"><?php echo $numoftickets_error2?></span> 
        </div>
        <button type="submit" name="submit2" class="order">Buy!</button>
    </div>
</form>
<?php require "footer.php"; ?>
