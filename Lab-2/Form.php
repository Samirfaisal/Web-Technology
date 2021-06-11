<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
$nameErr = $dobErr = $emailErr = $genderErr = $websiteErr = $bgErr= $degErr="";
$name = $email = $gender = $comment = $website = $dob = $bg= $deg[0]= $deg[1]= $deg[2]= $deg[3]="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  
  if (str_word_count($_POST["name"]) < 2) {
    $nameErr = "Minimum Two words ";
  } 
  else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-'. ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $name = "";
    }

  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $email = "";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["dob"])){
    $dobErr="Date of birth is required";
  }
  else {
    $dobErr = "" ;
    $dob = $_POST["dob"];
  }
  if(!empty($_POST['deg'])){
    if (sizeof($_POST["deg"])<2){
    $degErr="Please select at least two fields";
    }
    else{
    $degErr="";
    $deg=$_POST['deg'];
    }
  }
  else{
   $degErr="Please select at least two fields";
  }

  if (($_POST['bg'])==""){
    $bgErr="Blood group is requied";
  } else {
    $bgErr="";
    $bg=$_POST['bg'];
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <fieldset style="width: 300px;">
        <legend><b>NAME</b></legend>
        <input type="text" id="name" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span><hr>
      </fieldset><br>   

      <fieldset style="width: 300px;">
        <legend><b>EMAIL</b></legend>
        <input type="text" id="email" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span><hr>
      </fieldset><br>

  <fieldset style="width: 300px;">
        <legend><b>Date of Birth</b></legend>
        <input type="date" id="dob" name="dob" value="<?php echo $dob;?>">
        <span class="error">* <?php echo $dobErr;?></span><hr>
      </fieldset><br>

  <fieldset style="width: 300px;">
        <legend><b>GENDER</b></legend>
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
          <span class="error">* <?php echo $genderErr;?></span><hr>
      </fieldset><br>

  <fieldset style="width: 300px;">
        <legend><b>DEGREE</b></legend> 
        <input type="checkbox" name="deg" value="SSC" <?php if(isset($_POST['deg'][0])) echo "checked"; ?> >SSC 
        <input type="checkbox" name="deg" value="HSC" <?php if(isset($_POST['deg'][1])) echo "checked"; ?> >HSC 
        <input type="checkbox" name="deg" value="BSc" <?php if(isset($_POST['deg'][2])) echo "checked"; ?> >BSc 
        <input type="checkbox" name="deg" value="MSc" <?php if(isset($_POST['deg'][3])) echo "checked"; ?> >MSc
        <span class="error">* <?php echo $degErr;?></span><hr>
  </fieldset><br>

  <fieldset style="width: 300px;">
        <legend><b>Blood Group</b></legend>
      <select id="bg" name="bg">
        <option value=""></option>
        <option value="A+" <?php if($bg == 'A+'){ echo ' selected="selected"'; } ?> >A+</option>
        <option value="B+" <?php if($bg == 'B+'){ echo ' selected="selected"'; } ?> >B+</option>
        <option value="O+" <?php if($bg == 'O+'){ echo ' selected="selected"'; } ?> >O+</option>
        <option value="A-" <?php if($bg == 'A-'){ echo ' selected="selected"'; } ?> >A-</option>
        <option value="B-" <?php if($bg == 'B-'){ echo ' selected="selected"'; } ?> >B-</option>
        <option value="O-" <?php if($bg == 'O-'){ echo ' selected="selected"'; } ?> >O-</option>
        <option value="AB+" <?php if($bg == 'AB+'){ echo ' selected="selected"'; } ?> >AB+</option>
        <option value="AB-" <?php if($bg == 'AB-'){ echo ' selected="selected"'; } ?> >AB-</option>
  </select> 
  <span class="error">* <?php echo $bgErr;?></span><hr>
  <input type="submit" name="submit" value="Submit">  
  </fieldset>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dob;
echo "<br>";
echo $gender;
echo "<br>";
echo $deg;
echo "<br>";
echo $bg;
?>

</body>
</html>