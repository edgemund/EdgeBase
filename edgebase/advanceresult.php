<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EdgeBase - A Cooperative Database for Ghana SHS</title>
<meta name="description" content="Coming Soon Responsive Template">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>
<body>

<!--main-->
<section class="main">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6"> 
        <!--logo-->
        <div class="logo"><img src="img/logo.png" alt="logo"></div>
        <!--logo end--> 
      </div>
      <div class="col-md-6 col-sm-6"> 
        
        <!--social-->
        <div class="social text-center">
          <ul>
            <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
        <!--social end--> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        
        <!--welcome-message-->
        <header class="welcome-message text-center">
          <h1><span class="rotate">Ghana SHS Database, It's easy to Use! </span></h1>
        </header>
        <!--welcome-message end--> 
        
      </div>
    </div>
  </div>
</section>
<!--main end--> 

<!--Features-->
<section class="features section-spacing">
    <h2 class="text-center">Featered services</h2>
      <?php
$servername = "localhost";
$username = "v3dgegro_ghshs";
$password = "ghshs2018";
$dbname = "v3dgegro_ghanashs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$search=$_POST["search"];
	$dropsch="DROP VIEW sch_View";
	$sql_drop_view= $conn->query($dropsch);
	$sch_sql = "CREATE VIEW sch_View AS SELECT Sch_name, Gend, Resd, Cour, EMIS FROM school WHERE MATCH (Sch_name, Gend, Resd, Cour, EMIS) AGAINST ('%$search%' IN NATURAL LANGUAGE MODE)";
	$sql_sch_sql = $conn->query($sch_sql);
	$schview="SELECT v.Sch_name, v.Gend, v.Resd, v.Cour, v.EMIS, s.TT_Studs, s.P_Rate, s.TT, s.TD, l.Reg, l.Dis FROM sch_View AS v JOIN school AS s ON s.Sch_name = v.Sch_name JOIN location AS l ON s.Loc_ID = l.Loc_ID;";
	$sresult = $conn->query($schview);
	$num_rows = mysqli_num_rows($sresult);

if ($sresult->num_rows > 0) {
    echo "<div style='position:relative; overflow: hidden; z-index= 10; width: 1500px; height: 400px;'>
            <table id='st2' style='position: center; left: 0px;' border='1' cellpadding='2' cellspacing='0'>
						<thead>
						<tr><th>School Name</th>
						<th>Gender</th>
						<th>Residence Type</th>
						<th>Programmes</th>
                        <th>EMIS</th>
						<th>Total Students</th>
						<th>Pass Rate</th>
						<th>Teachers</th>
						<th>Trained Trs.</th>
						<th>Region</th>
						<th>District</th></tr>
						<thead>";
	// output data of each row
    while($srow = $sresult->fetch_assoc()) {
        echo "<div class='body'>
					<tbody>
						<tr>
						<td>" . $srow["Sch_name"]. "</td>
						<td>" . $srow["Gend"]. "</td>
						<td>" . $srow["Resd"]. "</td>
						<td>" . $srow["Cour"]. "</td>
						<td>" . $srow["EMIS"]. "</td>
                                                <td>" . $srow["TT_Studs"]. "</td>
						<td>" . $srow["P_Rate"]. "</td>
						<td>" . $srow["TT"]. "</td>
						<td>" . $srow["TD"]. "</td>
						<td>" . $srow["Reg"]. "</td>
						<td>" . $srow["Dis"]. "</td>
						</tr>
					</tboby>
				</div>";
    }
		echo "</table>
			</div>
		</div>";
	echo "<div id='details'> Table 1.1 Results for your query '$search'. $num_rows schools found.</div>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	
} else {
    echo "<div class='schoolecho'>There were NO matches for '$search' in our schools' record. You can add school names or gender to improve your search.</div>"; echo "<br>";
}
$conn->close();
?></div>
</section>
<!--Features end-->

<!--CONTACT-->

<section class="contact section-spacing" id="contact">
  <div class="container">
    <h2 class="text-center">Connect with EdgeBase Developers</h2>
    <div class="row">
      <div class="col-md-7"> 
        <!--map-->
        <div class="wow fadeInUp map">
          <div id="map-canvas"></div>
          
          <!--address-->
          
          <ul class="wow fadeInUp address">
            <li><i class="fa fa-map-marker"></i>EdgeMcSow </li>
            <li><i class="fa fa-phone"></i>+86 135 84 04 24 94 </li>
            <li><i class="fa fa-envelope"></i>info@edgebase.com </li>
          </ul>
          
          <!--address end--> 
          
        </div>
        <!--map end--> 
      </div>
      <div class="col-md-5"> 
        
        <!--contact form-->
        
        <div class="contact-form">
          <form role="form" action="php/contact.php" method="post" id="contact-form">
            <input type="text" class="wow fadeInUp form-control" name="name" id="name" placeholder="Your Name" required>
            <input type="email" class="wow fadeInUp form-control" name="email" id="email" placeholder="Email Address" required>
            <textarea class="wow fadeInUp form-control" name="message" id="message" rows="3" placeholder="Enter Your Message" required></textarea>
            <button type="submit" class="wow fadeInUp btn btn-default submit-btn" id="submit-btn" value="Send">SUBMIT</button>
          </form>
          
          <!--contact form end-->
          <div class="success-cf">
            <p>Thank You! Your message has been sent.</p>
          </div>
          <div class="error-cf">
            <p>Something went wrong, try refreshing and submitting the form again.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--CONTACT END--> 

<!--site-footer-->
<footer class="site-footer section-spacing">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center"> 
        
        <!--social-->
        
        <ul class="social">
          <li class="wow fadeInUp"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li class="wow fadeInUp"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li class="wow fadeInUp"><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
        </ul>
        
        <!--social end--> 
        
        <small class="wow fadeInUp">© 2018 All rights reserved. An EdgeMcSow Project <i class="fa fa-university"></i> by <a href="https://edgemcsow.com/">EdgeMcSow</a></small> </div>
    </div>
  </div>
</footer>
<!--site-footer end--> 

<!--PRELOAD-->
<div id="preloader">
  <div id="status"></div>
</div>
<!--end PRELOAD--> 

<script src="js/jquery-1.11.1.min.js"></script> 
<script src="js/jquery.backstretch.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/retina.min.js"></script> 
<script src="js/tweetie.min.js"></script> 
<script src="js/jquery.form.min.js"></script> 
<script src="js/jquery.validate.min.js"></script> 
<script src="js/jquery.simple-text-rotator.min.js"></script> 
<script src="js/main.js"></script> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script src="js/gmap.js"></script>
<script src="js/scrollingtable.js"></script>
<script src="js/headersticker.js"></script>
</body>
</html>
