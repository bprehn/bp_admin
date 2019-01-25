<?php 
	session_set_cookie_params(0);
	session_start();
	//require_once('../includes/error.php');
	require_once('../includes/includes.php');
	require_once('../includes/functions.php');
	
	$self = basename($_SERVER["PHP_SELF"]);
	$_SESSION['logged'] = 0;
	$_SESSION['isLoggedIn'] = false;
	//var_dump($_POST);
	if (isset($_POST['submit'])) {
		require_once('../includes/rwConnect.php');
		foreach (@$_POST as $objItem => $objValue) {
			//echo "objItem: " . $objItem . "&nbsp;&nbsp;";
			//echo "post_objItem: " . $_POST[$objItem] . "<br />";
			$_SESSION['sess_' . $objItem] = $_POST[$objItem];
		}
		if (empty($_POST['email'])) {  header("location:" . $self . "?error=true"); } else if(!isEmail($_POST['email'])) {  header("location:" . $self . "?error=true"); }
		
		$loginPassword = $_POST['password'];
		//$loginPassword = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $loginPassword, MCRYPT_MODE_CBC, md5(md5($key))));
		if (strtolower($_POST['password']) != "changeme") { $loginPassword = md5($loginPassword . $key); }
		$userSQL = "SELECT `uID`, `uUsername`, `uSections`, `uLevel`, `uNew` FROM `cms_users` WHERE `uEmail` = '".trim(sql_inj($_POST['email']))."' && `uPassword` = '".$loginPassword."' && `uActive` = '1' LIMIT 1";
		//echo "sql: " . $sql; exit();
		$userResults = mysql_query($userSQL, $link) or die(mysql_error());
		$userNUM = mysql_num_rows($userResults);
		
		if ($userNUM == 1) {
			while ($userROWS=mysql_fetch_array($userResults)) {
				$_SESSION['uID'] = $userROWS['uID'];
				$_SESSION['uUsername'] = $userROWS['uUsername'];
				$_SESSION['menuSections'] = $userROWS['uSections'];
				//$_SESSION['uNew'] = $uNew = $userROWS['uNew'];
				$uNew = $userROWS['uNew'];
				$_SESSION['uLevel'] = $userROWS['uLevel'];
				
				//echo 'logged '.$_SESSION['logged'];exit();
				//echo 'new '.$uNew;exit();
				if  ($uNew != '1') { 
					$_SESSION['logged'] = '89pV8uWh7Dz6ODsWN6ev6HRDZk16J8kN';
					$_SESSION['isLoggedIn'] = true;
				
					header("location:index.php");
				} else {
					header("location: set_password.php"); exit();
				}
			}
		} else {
			header("location:" . $self . "?error=true");
		}
	} else {
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
		    <meta name="description" content="">
		    <meta name="author" content="">
		
			<title><?php echo $siteName; ?> | CMS</title>
		
		    <!-- Bootstrap Core CSS -->
		    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		
		    <!-- MetisMenu CSS -->
		    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
		
		    <!-- Custom CSS -->
		    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
		
		    <!-- Custom Fonts -->
		    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		    <![endif]-->
		
		</head>
		<body>
		<?php require_once('../includes/analytics.php'); ?>
		<?php 
			//$loginPassword = 'password';
			//echo base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $loginPassword, MCRYPT_MODE_CBC, md5(md5($key))));
			//echo RotEncrypt($loginPassword, $key) . "\n<br>\n"
			//.RotDecrypt(RotEncrypt($loginPassword, $key), $key);
		?>
		<div class="container">
	        <div class="row">
	            <div class="col-md-4 col-md-offset-4">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading">
	                        <h3 class="panel-title">Please Sign In</h3>
	                    </div>
	                    <div class="panel-body">
			                    <?php if (isset($_REQUEST['error']) && $_REQUEST['error'] == 'true') { ?>
			                    <div class="alert alert-danger">
	                                Login Error! Either you username/password is incorrect.
	                            </div>
	                            <?php } ?>
		                        <form method="post" action="<?= $self ?>" name="login">
		                            <fieldset>
		                                <div class="form-group">
		                                    <input class="form-control" placeholder="E-mail" name="email" type="username">
		                                </div>
		                                <div class="form-group">
		                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
		                                </div>
		                                <div class="checkbox">
		                                    <label>
		                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
		                                    </label>
		                                </div>
		                                <!-- Change this to a button or input when using this as a form -->
		                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block">
		                            </fieldset>
		                        </form>
	                    </div>
	                    <div class="panel-footer">
		                    <p><a href="lost_pass.php">Forgot your password?</a></p>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- jQuery -->
	    <script src="bower_components/jquery/dist/jquery.min.js"></script>
	
	    <!-- Bootstrap Core JavaScript -->
	    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	    <!-- Metis Menu Plugin JavaScript -->
	    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
	
	    <!-- Custom Theme JavaScript -->
	    <script src="js/jquery-ui.js"></script>
	    <script src="../js/jquery.datetimepicker.js"></script>
	    <script src="js/jquery.nestable.js"></script>
	    <script src="dist/js/sb-admin-2.js"></script>
	
		</body>
	
	</html>
<?php } ?>