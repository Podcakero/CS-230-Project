<?php
if (isset($_POST['login-submit']))
{
    require 'dbhandler.php';

    $username = $_POST['uname-email'];
    $password = $_POST['pwd'];

    if (empty($username) || empty($password))
    {
        header("Location: ../login.php?error=emptyField");
        exit();
    }

    $sql = "SELECT * FROM users WHERE uname=? OR email=?";
	$stmt = $conn->prepare($sql);

	if ($stmt->execute(array($username, $username)))
	{
		$data = $stmt->fetch();
		if (empty($data))
        {
            header("Location: ../login.php?error=userNotFound");
            exit();
        }
		else
		{
            $pass_check = password_verify($password, $data['password']);

            if ($pass_check == true)
            {
                session_start();
                $_SESSION['uid'] = $data['uid'];
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['lname'] = $data['lname'];
                $_SESSION['uname'] = $data['uname'];

                //echo "<h1> Success!</h1><p>$username</p>";
                header("Location: ../profile.php?success=login");
                exit();
            }
            else
            {
                header("Location: ../login.php?error=wrongPassword");
                exit();
            }
	    }
	}
	else
	{
	    header("Location: ../login.php?error=SQLInjection");
        exit();
	}
	
}
else
{
    header("Location: ../login.php");
    exit();
}