<?php
include('conn.php');
?>



<?php 
$subjectErr=$messageErr=$emailErr=$contactErr=$nameErr='';


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }
 
    if (empty($_POST["contact"])) {
      $contactErr = "Contact Number is required";
    } else {
      $contact = test_input($_POST["contact"]);
 
      if (!preg_match("/^[0-9]{10}$/",$contact)) {
        $contactErr = "Only Numbers are allowed";
      }
    }
  
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
 
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }
  

    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
      } else {
        $subject = test_input($_POST["subject"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$subject)) {
          $subjectErr = "Only letters and white space allowed";
        }
      }
   

    if (empty($_POST["message"])) {
        $messageErr = "massage is required";
      } else {
        $massage = test_input($_POST["message"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$massage)) {
          $messageErr = "Only letters and white space allowed";
        }
      }
   
      
      
    }else{
        
        $_POST['name']='';
        $_POST['contact']='';
        $_POST['email']='';
        $_POST['subject']='';
        $_POST['message']='';
        
    }
  $ip_adress  = $_SERVER['REMOTE_ADDR'];

$name = test_input($_POST['name']);
$contact = test_input($_POST['contact']);
$email = test_input($_POST['email']);
$subject = test_input($_POST['subject']);
$message = test_input($_POST['message']);
if((!empty($name)&& !empty($contact) && !empty($email) && !empty($subject) && !empty($message)) && empty($subjectErr) && empty($messageErr)&& empty($emailErr)&& empty($contactErr)&& empty($nameErr) ){

  $sql = "INSERT INTO `contact_form`(`name`, `phone_number`, `email`, `subject`, `message`, `ip_address`) VALUES
 ('$name','$contact','$email','$subject','$message','$ip_adress')";
if($conn->query($sql)){
    echo "<script>alert('Form Sucessfully Submitted')</script>";
}else{
  echo "Error".$conn->error;
}

}




?>






<html>
<head>
    <title>
        contact Form
    </title>
<style>
.error{
    color: #FF0000;

}


input[type=text],input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  font-family: "Lucida Console", "Courier New", monospace;
}
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
  font-family: "Lucida Console", "Courier New", monospace;
}

button, input[type=reset]{
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
button:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
label {
    font-size: 20px ;
    font-family: "Lucida Console", "Courier New", monospace;

}
h1 {
    font-family: Arial, Helvetica, sans-serif;
    Width : 50%;
    margin-left : 40%;

}

    </style>

</head>
<body>
    <div class='container'>
        <h1> Contact Form </h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST' id="contactform">
<label for = 'name'>Full Name </label>
<input type = 'text' id = 'name' name='name' value="<?php echo $_POST["name"]; ?>"></input>
<span class="error">* <?php echo $nameErr;?></span>
<br>
<label for = 'contact'>Phone Number </label>
<input type = 'text' id = 'contact' name='contact' pattern="[0-9]{10}"  value="<?php echo $_POST["contact"]; ?>"    placeholder="Enter 10 Digits Number" title="Please enter a valid Number" ></input>
<span class="error">* <?php echo $contactErr;?></span>
<br>
<label for = 'email'>Email </label>
<input type = 'email' id = 'email' name='email' value="<?php echo $_POST["email"]; ?>"  ></input>
<span class="error">* <?php echo $emailErr;?></span>
<br>

<label for = 'subject'>Subject </label>
<input type = 'text' id = 'subject' name='subject' value="<?php echo $_POST["subject"]; ?>"  ></input>
<span class="error">* <?php echo $subjectErr;?></span>
<br>
<label for = 'message'>Message </label>
<textarea name="message" form="contactform"    placeholder="Enter text here..."><?php echo $_POST["message"]; ?></textarea>
<span class="error">* <?php echo $messageErr;?></span>
<br>
<button type="submit"> Submit </button>
<input type="reset" value="Reset" name="reset" id="reset" />




</form>
</div>
</body>

