<?php 
$connect = mysqli_connect("sql202.epizy.com", "epiz_21987433", "LiwJjSJkAcdS", "epiz_21987433_buying");

$name1 = $phone1 = $email1 = $numoftickets1 = "";
$name_error1 = $phone_error1 = $email_error1 = $numoftickets_error1 = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit1"])) {
    if (empty($_POST["name1"])) {
        $name_error1 = "Please enter your name and surname.";
    } else {
        $name1 = test_input1($_POST["name1"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name1)) {
        $name_error1 = "Only letters and space are allowed.";
         }
        $name1 = mysqli_real_escape_string($connect, $_POST["name1"]);
  }    
    if (empty($_POST["phone1"])) {
        $phone_error1 = "Please enter your phone number.";
    } else {
        $phone1 = test_input1($_POST["phone1"]);
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone1)) {
        $phone_error1 = "Invalid phone number format.";
        }
        $phone1 = mysqli_real_escape_string($connect, $_POST["phone1"]);  
  }  
    if (empty($_POST["email1"])) {
        $email_error1 = "Please enter your email address.";
    } else {
        $email1 = test_input1($_POST["email1"]);
        if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
        $email_error1 = "Invalid email format.";
        }
        $email1 = mysqli_real_escape_string($connect, $_POST["email1"]);  
  }     
    if (empty($_POST["numoftickets1"])) {
        $numoftickets_error1 = "Please select number of ticket you want to buy.";
    } else {
        $numoftickets1 = test_input1($_POST["numoftickets1"]);
        $numoftickets1 = mysqli_real_escape_string($connect, $_POST["numoftickets1"]);
  }
    if($name_error1 == "" && $phone_error1 == "" && $email_error1 == "" && $numoftickets_error1 == "") {
    $query = "INSERT INTO barcelona(name, phone, email, numoftickets) VALUES ('$name1','$phone1','$email1','$numoftickets1')";
        if(mysqli_query($connect, $query)) {
            $name1 = $phone1 = $email1 = $numoftickets1 = "";

        }
    } 
}
function test_input1($data) {
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
        <p class="place">Spain, Barcelona, Palau de la Musica<br>2nd february 2018, @ 21:00h</p>
        <p class="price">Price of ticket is $19 for one, and $29 for a pair.</p>
    </div>
    <div class="container">
        <div class="form-group field">
            <input type="text" name="name1" class="form-control purchase" value="<?php echo $name1 ?>" placeholder="Your name and surname..*">
            <span class="form_error"><?php echo $name_error1?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="phone1" class="form-control purchase" value="<?php echo $phone1 ?>" placeholder="Your phone number..*">
            <span class="form_error"><?php echo $phone_error1?></span>
        </div>
        <div class="form-group field">
            <input type="text" name="email1" class="form-control purchase" value="<?php echo $email1 ?>"  placeholder="Your e-mail..*">
            <span class="form_error"><?php echo $email_error1?></span>
        </div>
        <div class="form-group field">
            <input type="number" name="numoftickets1" class="form-control purchase" value="<?php echo $numoftickets1 ?>" placeholder="How many tickets would you like to buy?*">
            <span class="form_error"><?php echo $numoftickets_error1?></span>        
        </div>
        <button type="submit" name="submit1" class="order">Buy!</button>
    </div>
</form>
<?php require "footer.php"; ?>
