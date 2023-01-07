<?php
$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "login_form";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);
if (!$conn) {
    echo "Connection failed!";
}

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
  
	if (empty($uname)) {
		header("Location:loginPage.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: loginPage.php?error=Password is required");
		exit();
	} else {
		$sql = "SELECT * FROM loginpage WHERE user_id='$uname' AND password ='$pass'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user_id'] === $uname && $row['password'] === $pass) {
				
			
				header("Location: index.php");
				exit();
			} else {
                
				header("Location: loginPage.php?error=Invaliduser");
               
				exit();
			}
		} else {
			header("Location: loginPage.php?error=Invalidpassword");
            
			exit();
		}
	}
} 