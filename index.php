

<html lang="en">
<head style:text-align=center;>
<meta charset="UTF-8">
<H1>Welcome to Radhika Application.... Login to continue</H1>

</head>

<style type="text/css">
body{
background:url('https://s3-us-west-2.amazonaws.com/raw-rad/cloud.jpg');
}
</style>
<body>
<form action="welcome.php" method="post">
    <p>
        <label for="username">User Name:</label>
        <input type="text" name="username" id="username">
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
    </p>
    <p>
        <label for="account">Account Type:</label>
        <input type="text" name="account" id="account">
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>

<?php
session_start();

require 'vendor/autoload.php';


$client = new Aws\Rds\RdsClient([
  'region'            => 'us-west-2',
    'version'           => 'latest'
]);
 

$result = $client->describeDBInstances([
    'DBInstanceIdentifier' => 'rg-db'
]);


$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
echo $endpoint . "\n";

$link = mysqli_connect($endpoint,"controller1","radhika6","school") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


$sql = "CREATE TABLE login
(
userid VARCHAR(255),
password VARCHAR(30),
account VARCHAR(20)
)";
$link->query($sql);
$sql2 = "INSERT INTO `login` (`userid`,`password`,`account`) VALUES ('rgupta28@hawk.iit.edu','radhika','controller'),('jhajek@iit.edu','ilovebunnies','user'),('any@iit.edu','iit','user')";
if ($link->query($sql2) === TRUE) {
echo "Data inserted successfully";
} else {
echo "Error creating database: " . $link->error;
}

?>


