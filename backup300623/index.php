<?php
//database details
$host="ap-sp-proj.chwmwhavjzga.eu-west-2.rds.amazonaws.com";
$port=3306;
$socket="";
$user="admin";
$password="i5PSCv6LZjuHtyqqFXfS";
$dbname="webform";
$connect="";

//create connection
$connect = mysqli_connect($host,$user,$password,$dbname);  

if(!$connect){
    echo("<p>Error Performing Query: ".mysql_error()."</p>");
    exit();
} else {
    //echo("Success");
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $contactNo = $_POST['contact_no'];
    $qualificationLevel = $_POST['previous_level'];
    $comments = $_POST['comments'];
if (isset($_POST['submit'])) {
        // Process form data here        // ...
    
        // Display thank you message
        echo "Success!";
    }

    $errors = array();

    if(empty($firstName)) {
        $errors[] = "First Name is required.";
    }

    if(empty($surname)) {
        $errors[] = "Surname is required.";
    }

    if(empty($email)) {
        $errors[] = "Email is required.";
    }

    if(empty($contactNo)) {
        $errors[] = "Phone Number is required.";
    }

    if (!empty($errors)) {
        echo "<h2>Error</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
        echo "<li>$error</li>";
    }   echo "</ul>"; 
}   else {
    echo "<h2>Thank you for your submission!</h2>";

    // Map the selected option to the corresponding numeric value
 switch ($qualificationLevel) {
    case "Level 3":
        $qualificationLevelValue = 3;
        break;
    case "Level 4":
        $qualificationLevelValue = 4;
        break;
    case "Level 5":
        $qualificationLevelValue = 5;
        break;
    case "Level 6":
        $qualificationLevelValue = 6;
        break;
    case "Level 7":
        $qualificationLevelValue = 7;
        break;
    default:
        $qualificationLevelValue = 3; // Default value if none of the above cases match
        break;
}

$checkboxValues = array(
    isset($_POST['agriculture']) ? 1 : 0,
    isset($_POST['business']) ? 1 : 0,
    isset($_POST['care']) ? 1 : 0,
    isset($_POST['catering']) ? 1 : 0,
    isset($_POST['construction']) ? 1 : 0,
    isset($_POST['creative']) ? 1 : 0,
    isset($_POST['digital']) ? 1 : 0,
    isset($_POST['education']) ? 1 : 0,
    isset($_POST['engineering']) ? 1 : 0,
    isset($_POST['hair']) ? 1 : 0,
    isset($_POST['health']) ? 1 : 0,
    isset($_POST['legal']) ? 1 : 0,
    isset($_POST['protective']) ? 1 : 0,
    isset($_POST['sales']) ? 1 : 0,
    isset($_POST['transport']) ? 1 : 0
);


//$checkboxValues = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();

// Convert the checkbox values to integers (1 for checked, 0 for unchecked)
$checkboxValues = array_map(function ($value) {
    return $value ? 1 : 0;
}, $checkboxValues);

$submitDate = date('Y-m-d H:i:s');
//$assignedTo = "";
$query = "INSERT INTO Contact (firstname, surname, email, phone, previous_level, agriculture, business, care, catering, construction, creative, digital, education, engineering, hair, health, legal, protective, sales, transport, comments, submit_date) VALUES ('$firstName', '$surname', '$email', '$contactNo', '$qualificationLevel', " . implode(", ", $checkboxValues) . ", '$comments', '$submitDate')";

    // Execute the query
    $result = mysqli_query($connect, $query);

    // Check if the query was successful
    if ($result) {
        // Query executed successfully
        $insertedId = mysqli_insert_id($connect);
        //echo "Data saved successfully! Inserted ID: " . $insertedId;
    } else {
        // Query failed
        echo "Error: " . mysqli_error($connect);
    }
}

// Construct the SQL query
$query = "SELECT * FROM Contact";

// Execute the query
$result = mysqli_query($connect, $query);
/*
// Check if the query was successful
if ($result) {
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Output the data
        while ($row = mysqli_fetch_assoc($result)) {
            // Access the columns by their names
            $id = $row['id'];
            $firstName = $row['firstname'];
            $surname = $row['surname'];
            $email = $row['email'];
            $contactNo = $row['phone'];
            $qualificationLevel = $row['previous_level'];
            $checkbox1 = $row['agriculture'];
            $checkbox2 = $row['business'];
            $checkbox3 = $row['care'];
            $checkbox4 = $row['catering'];
            $checkbox5 = $row['construction'];
            $checkbox6 = $row['creative'];
            $checkbox7 = $row['digital'];
            $checkbox8 = $row['education'];
            $checkbox9 = $row['engineering'];
            $checkbox10 = $row['hair'];
            $checkbox11 = $row['health'];
            $checkbox12 = $row['legal'];
            $checkbox13 = $row['protective'];
            $checkbox14 = $row['sales'];
            $checkbox15 = $row['transport'];
            $comments = $row['comments'];
            $submitDate = $row['submit_date'];
            $assignedTo = $row['assigned_to'];

            // Display the data
            echo "ID: $id<br>";
            echo "First Name: $firstName<br>";
            echo "Surname: $surname<br>";
            echo "Email: $email<br>";
            echo "Contact No: $contactNo<br>";
            echo "Qualification Level: $qualificationLevel<br>";
            echo "Agriculture: " . ($checkbox1 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Business: " . ($checkbox2 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Care: " . ($checkbox3 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Catering: " . ($checkbox4 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Construction: " . ($checkbox5 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Creative: " . ($checkbox6 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Digital: " . ($checkbox7 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Education: " . ($checkbox8 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Engineering: " . ($checkbox9 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Hair: " . ($checkbox10 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Health: " . ($checkbox11 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Legal: " . ($checkbox12 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Protective: " . ($checkbox13 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Sales: " . ($checkbox14 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Transport: " . ($checkbox15 ? 'Checked' : 'Unchecked') . "<br>";
            echo "Comments: $comments<br>";
            echo "Date submitted: $submitDate<br>";
            echo "Assigned to: $assignedTo<br>";
            echo "<br>";
        }
    } else {
        echo "No results found.";
    }
} else {
    // Query failed
    echo "Error: " . mysqli_error($connect);
}
*/


}


 
?>


<!DOCTYPE html>

<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Expression of Interest</title>
        <link rel = "stylesheet" href="style.css" type = "text/css">

    </head>

 <body>
    <header class = "site-header" >
        <div class = "site-logo">
        <a href="https://www.apprenticetips.com/" title="ApprenticeTips.com" rel="home">
        <img class="header-image" alt="ApprenticeTips.com logo" src="img/ApprenticeTips_logo.png" title="ApprenticeTips.com">
        </a>
        </div>
    </header>
    <div class="topnav">
    <div class = "items">
      
  <div class = "dropdown">
  <button class="dropdown" >Apprenticeships</button>
  </div>
  <a href = https://www.apprenticetips.com/blog>Latest</a>
  <a href = "search.php">Search</a>
  </div>
</div>

<div class = "personal-details">
<h2>Please enter your details and we will be in touch</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h3>First Name: <textarea class = "input" name = "first_name"></textarea></h3> 
<h3>Surname: <textarea class = "input" name = "surname"></textarea></h3> 
<h3>Email: <textarea class = "input" name = "email"></textarea></h3> 
<h3>Contact No: <textarea class = "input" name = "contact_no"></textarea></h3> 
<h3>Level of previous qualification: <select class = "input" name = "previous_level">
        <option value = "Level 3">Level 3</option>
        <option value = "Level 4">Level 4</option>
        <option value = "Level 5">Level 5</option>
        <option value = "Level 6">Level 6</option>
        <option value = "Level 7">Level 7</option>
</select></h3> 
<h2>Please select the routes that interest you:</h2>
<h3>Agriculture, environmental and animal care <input type= "checkbox" name = "agriculture" id = "cbx1" value = '0'></h3>
<h3>Buisness and administration <input type= "checkbox" name = "business" id = "cbx2" value = '0'></h3>
<h3>Care services <input type= "checkbox" name = "care" id = "cbx3" value = '0'></h3>
<h3>Catering and hospitality <input type= "checkbox" name = "catering" id = "cbx4" value = '0'></h3>
<h3>Construction <input type= "checkbox" name = "construction" id = "cbx5" value = '0'></h3>
<h3>Creative and design <input type= "checkbox" name = "creative" id = "cbx6" value = '0'></h3>
<h3>Digital<input type= "checkbox" name = "digital" id = "cbx7" value = '0'></h3>
<h3>Education and childcare <input type= "checkbox" name = "education" id = "cbx8" value = '0'></h3>
<h3>Engineering and manufactering <input type= "checkbox" name = "engineering" id = "cbx9" value = '0'></h3>
<h3>Hair and beauty<input type= "checkbox" name = "hair" id = "cbx10" value = '0'></h3>
<h3>Health and science<input type= "checkbox" name = "health" id = "cbx11" value = '0'></h3>
<h3>Legal,finance and accounting<input type= "checkbox" name = "legal" id = "cbx12" value = '0'></h3>
<h3>Protective services <input type= "checkbox" name = "protective" id = "cbx13" value = '0'></h3>
<h3>Sales, marketing and procurement <input type= "checkbox" name = "sales" id = "cbx14" value = '0'></h3>
<h3>Transport and logistics <input type= "checkbox" name = "transport" id = "cbx15" value = '0'></h3>
<h3>Comments: <textarea class="input" name="comments" placeholder="Please provide any other information that you wish to let the recruiters know...."></textarea> </h3>
</div>

<button class = "submit">Submit</button>
</body>
</html>
