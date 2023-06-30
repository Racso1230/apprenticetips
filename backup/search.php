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

$route = $_POST['route']; 
$status = $_POST['status'];
$level = $_POST['level'];
$duration = $_POST['duration'];

// Construct SQL query
$query = "SELECT name, link FROM Apprenticeships WHERE route = '$route' AND status = '$status' AND level = '$level' AND duration = '$duration'";

// Execute the query
$result = mysqli_query($connect, $query);

// Check if any matching records found
if (mysqli_num_rows($result) > 0) {
    // Start constructing HTML table
    echo '<table>';
    echo '<tr><th>Name</th><th>Link</th></tr>';

    // Fetch and display records
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td><a href="' . $row['link'] . '">Link</a></td>';
        echo '</tr>';
    }

    // Close the HTML table
    echo '</table>';
} else {
    echo 'No records found.'; // Display a message if no matching records found
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <title>Apprenticeship Search</title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <a href = "index.php">Expression of Interest</a>
  </div>
</div>

<div class = "personal details">
   <h2> Use the fields below to find apprenticeships</h2>
   <form action="search.php" method="POST">
   <h3>Route: <select  name = "route" class = "input">
    <option>Agriculture, environmental and animal care</option>
    <option>Business and administration</option>
    <option>Care services</option>
    <option>Catering and hospitality</option>
    <option>Construction</option>
    <option>Creative and design</option>
    <option>Digital</option>
    <option>Education and childcare</option>
    <option>Engineering and manufacturing</option>
    <option>Hair and beauty</option>
    <option>Health and safety</option>
    <option>Legal, Finance and accounting</option>
    <option>Protective services</option>
    <option>Sales, marketing and procurement</option>
    <option>Transport and logistics</option>
   </select> </h3>
   <h3>Status: <select  name = "status" class = "input">
    <option>Approved for delivery</option>
    <option>In development</option>
    <option>Retired</option>
    <option>Withdrawn</option>
    <option>Proposal in development</option>
   </select> </h3>
   <h3>Level: <select  name = "level" class = "input" >
        <option value = "Level 3">Level 3</option>
        <option value = "Level 4">Level 4</option>
        <option value = "Level 5">Level 5</option>
        <option value = "Level 6">Level 6</option>
        <option value = "Level 7">Level 7</option>
</select></h3> 
<h3>Duration: <select class = "input" name = "duration">
        <option value = "">0</option>
        <option value = "">12</option>
        <option value = "">13</option>
        <option value = "">14</option>
        <option value = "">15</option>
        <option value = "">16</option>
        <option value = "">18</option>
        <option value = "">21</option>
        <option value = "">22</option>
        <option value = "">24</option>
        <option value = "">26</option>
        <option value = "">27</option>
        <option value = "">30</option>
        <option value = "">33</option>
        <option value = "">34</option>
        <option value = "">36</option>
        <option value = "">38</option>
        <option value = "">42</option>
        <option value = "">48</option>
        <option value = "">54</option>
        <option value = "">60</option>
        <option value = "">66</option>

</select></h3> 
</form>
</div>
<button class = "search" type = "submit"> Find Apprenticeships</button>

</body>


</html>
