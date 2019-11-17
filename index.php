<!doctype html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="$1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Employee DB</title>

<?php

$servername = "localhost";
$username = "phpmyadmin";
$password = "toor";
$dbname = "employee_db";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}

?>
</head>
<body>
<?php

// Save Query
if (isset($_POST['save'])){
    $insql = "INSERT INTO TeamMember (MemberID, FirstName, LastName, EmailAddress, CellNumber, Address) VALUES ('$_POST[memberID]', '$_POST[fname]', '$_POST[lname]', '$_POST[mail]', '$_POST[cell]', '$_POST[address]')";
}

if ($conn->query($insql) === TRUE) {
    echo "New record created successfully";
} elseif ($conn->query($insql) === FALSE) {
    echo "No new record inserted";
} else {
    echo "Error: " . $insql . "<br>" . $conn->error;
}

// SQL Query
$sql = "SELECT MemberID, FirstName, LastName, EmailAddress, CellNumber, Address FROM TeamMember";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "
    <table>
    <thead>
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Cell Number</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
    ";
    //Output Data of Each Row
    while($row = $result->fetch_assoc()){
        echo "<tr><td>". $row[MemberID] ."</td><td>". $row[FirstName] ."</td><td>". $row[LastName] ."</td><td>". $row[EmailAddress] ."</td><td>". $row[CellNumber] ."</td><td>". $row[Address] ."</td></tr>";
    }
    echo "
    </tbody>
    </table>
    ";
} else {
    echo "0 results";
}

?>
<form method="post"> 
<label id="first"> Member ID:</label><br/>
<input type="number" name="memberID"><br/>

<label id="first"> First Name:</label><br/>
<input type="text" name="fname"><br/>

<label id="first"> Last Name:</label><br/>
<input type="text" name="lname"><br/>

<label id="first">Email Address</label><br/>
<input type="email" name="mail"><br/>

<label id="first">Cell Number</label><br/>
<input type="tel" name="cell"><br/>

<label id="first"> Address:</label><br/>
<input type="text" name="address"><br/>

<button type="submit" name="save">Save</button>
</form>
<?php

$conn->close();

?>
</body>
</html>