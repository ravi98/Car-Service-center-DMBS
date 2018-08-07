<?php 
session_start();


	$db = mysqli_connect('localhost', 'root', '', 'carservice');

?>
<!DOCTYPE html>
<html>
<head>
    <style>
    #section1 {
	padding-top:50px;
	padding-bottom: 5px;
	height:100%;
	color: black;
	opacity: 0.8;
	background-image: url(images/car_repair.jpg);
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center;
	opacity: 0.7;
}
    </style>
	<title>Mechanics history</title>
	<link rel="stylesheet" type="text/css" href="style.css">
      <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
</head>
    <body bgcolor="beige" data-spy="scroll" data-target=".navbar" data-offset="50">
		<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                                    <a class="navbar-brand"  href="#" style="font-family: Gill Sans, Gill Sans MT, Myriad Pro, DejaVu Sans Condensed, Helvetica, Arial,' sans-serif'; font-size: 22px">Home</a>
                                        </div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav pull-right">
                                                <li>
                                                <a href="mechlog.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
                                                </li>
					</ul>
				</div>
            </div>
		</nav>
	<div id="section1">
    <div class="container">
        <div class="jumbotron">
    <h1>Welcome <?php echo $_SESSION['user']['fname']; ?></h1>
    <h4>Your records are as follows</h4>

    <?php $mid= $_SESSION['user']['id']; 
    $dt = date("Y/m/d"); 
    $query="SELECT * FROM purchase WHERE mechid='$mid' AND dob<='$dt'";
    $proc = mysqli_query($db,$query);  

    ?>
    
    
    <div class="container">           
  <table class="table table-striped">
    <thead>
      <tr>
            <th>Pid</th>
			<th>Cid</th>
			<th>Oid</th>
            <th>Sid</th>
            <th>Amount</th>
            <th>Serviced date</th>

		</tr>
	</thead>
      <?php while ($row = mysqli_fetch_array($proc)) { ?>
		<tr>
            <td><?php echo $row['pid']; ?></td>
            <td><?php echo $row['carid']; ?></td>
			<td><?php echo $row['oid']; ?></td>
            <td><?php echo $row['sid']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            
        </tr>
      <?php }?>
    </div>
            </div>
    </body>
        </div>
</html>
