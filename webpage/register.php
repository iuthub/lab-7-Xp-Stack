
<?php

include('connection.php');

$db = new PDO('mysql:host=localhost;dbname=blog', 'xuri', '1006');
$isPost = 'no';
$usersRepo = new UsersRepo($db);
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $isPost = 'yes';

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" required/>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	</body>
<head>
    <title>My Blog - Registration Form</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php include('header.php');
$username = '';
$pwd = '';
$confirmPwd = '';
$fullname = '';
$email = '';

$isValid = TRUE;
$isOk = TRUE;

if($isPost == 'yes') {
    $username=$_REQUEST["username"];
    $pwd =$_REQUEST["pwd"];
    $confirmPwd =$_REQUEST["confirmPwd"];
    $fullname = $_REQUEST["fullname"];
    $email = $_REQUEST["email"];
}

?>

<h2>User Details Form</h2>
<h4>Please, fill below fields correctly</h4>
<form action="register.php" method="post">
    <ul class="form">
        <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $username ?>" required/>
            <?php if ($isPost == 'no'): $isValid = false; ?>
                <span class="error">Required field.</span>
            <?php endif ?>
        </li>
        <li>
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" value="<?= $fullname ?>" required/>
            <?php if ($isPost == 'no' ): $isValid = false; ?>
                <span class="error">Required field.</span>
            <?php endif ?>
        </li>
        <li>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $email ?>" />
            <?php if ($isPost == 'no' ): $isValid=false; ?>
                <span class="error">Not a valid email.</span>
            <?php endif ?>
        </li>
        <li>
            <label for="pwd">Password</label>
            <input type="password" name="pwd" id="pwd" value="<?= $pwd ?>" required/>
            <?php if ($isPost == 'no' ): $isValid=false; ?>
                <span class="error">Required field.</span>
            <?php endif ?>
        </li>
        <li>
            <label for="confirm_pwd">Confirm Password</label>
            <input type="password" name="confirmPwd" id="confirmPwd" value="<?= $confirmPwd ?>" required />
            <?php if ($isPost == 'no' || $confirmPwd != $pwd ): $isValid=false; ?>
                <span class="error">Required field.</span>
            <?php endif ?>
        </li>
        <?php
        if($isPost == 'yes' && $isValid) {
            $isOk = $usersRepo->addUser($username, $pwd, $fullname, $email);

        }
        ?>
        <?php if (!$isOk): ?>
            <span class="error">This user exists in database!</span>
        <?php endif ?>
        <li>
            <input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
        </li>

    </ul>
</form>
</body>
</html>