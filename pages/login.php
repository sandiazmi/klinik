<?php
	session_start();
	include_once "../library/koneksi.php";
	
	// Baca Jam pada Komputer
	date_default_timezone_set("Asia/Jakarta");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIN FORM</title>

   <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Masukan Username dan Password</h3>
                    </div>
                    <div class="panel-body">
						<?php
							if(isset($_POST['btnLogin'])){			
								# Baca variabel form
								$txtUser 	= $_POST['txtUser'];
								$txtUser 	= str_replace("'","&acute;",$txtUser);
								
								$txtPassword=$_POST['txtPassword'];
								$txtPassword= str_replace("'","&acute;",$txtPassword);
														
								// Jika yang login Administrator
								$mySql = "SELECT * FROM user WHERE username='".$txtUser."' AND password='".md5($txtPassword)."'";
								$myQry = mysqli_query($koneksidb, $mySql);
								$myData= mysqli_fetch_array($myQry);
									
								if(mysqli_num_rows($myQry) >=1) {
									$_SESSION['SES_USER'] = $myData['username'];
									header("Location: menu.php");
								}
								
								
							} // End POST
						
						?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method='post' target='_self' role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="txtUser" type='text' autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="txtPassword" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
								<button name="btnLogin" class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                                <!-- Change this to a button or input when using this as a form -->
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
