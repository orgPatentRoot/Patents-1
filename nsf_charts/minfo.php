<!DOCTYPE html>
<!-- saved from url=(0032)http://www.chicagolobbyists.org/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Title -->
	<title>Patent Project</title>
	<link rel="Shortcut Icon" href="http://www.chicagolobbyists.org/favicon.ico" type="image/x-icon">
	
	<!-- Info -->
	
  <!-- webmaster-tools <meta name="google-site-verification" content="6oHOT6PXw490mF1qyuiToMoG96gA85-kTbNYyL3UtTo" /> -->
  <meta name="google-site-verification" content="LjG-SeitOaHlivMGUN2L6jXAu_iRkxIfkqDMo0tlZAk">
	
	<!-- Styles -->
	<link rel="stylesheet" type="text/css" media="all" href="./Chicago Lobbyists_files/master.css">

	<!-- JavaScript -->
  <script type="text/javascript" async="" src="./Chicago Lobbyists_files/ga.js" style=""></script><script src="./Chicago Lobbyists_files/jquery.min.js" type="text/javascript"></script>
  <script src="./Chicago Lobbyists_files/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="./Chicago Lobbyists_files/jquery.ezpz_hint.min.js" type="text/javascript"></script>
	<script src="./Chicago Lobbyists_files/jquery.dataTables.js" type="text/javascript"></script>
	<script src="./Chicago Lobbyists_files/dataTables.sorting.js" type="text/javascript"></script>
	<script src="./Chicago Lobbyists_files/jquery.formatCurrency-1.4.0.min.js" type="text/javascript"></script>
	<script src="./Chicago Lobbyists_files/listing.bars.js" type="text/javascript"></script>
  <script src="./Chicago Lobbyists_files/js" type="text/javascript"></script><script src="./Chicago Lobbyists_files/main.js" type="text/javascript"></script>
  <script src="./Chicago Lobbyists_files/analytics_lib.js" type="text/javascript"></script>
	
	<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();
    var map = null;
    var map_bounds = new google.maps.LatLngBounds();

    function defineMap(latlng) {
      var myOptions = {
        zoom: 13,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        scrollwheel: false,
        
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      
      var city_hall_latLang = new google.maps.LatLng(41.883205,-87.630204);
      var city_hall_MarkerImage = 'http://chicagolobbyists.org/images/city-hall.png';
      var city_hall = new google.maps.Marker({
          map: map,
          position: city_hall_latLang,
          icon: city_hall_MarkerImage,
          title: 'City Hall'
        });
    }

    function geocode(address) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (map != null) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
            map_bounds.extend(results[0].geometry.location);
            map.fitBounds(map_bounds);

            if (map.zoom > 13) {
              map.setZoom(13);
            }
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        }
      });
    }
  </script>
<script type="text/javascript" charset="UTF-8" src="./Chicago Lobbyists_files/{common,util,geocoder}.js"></script><script type="text/javascript" charset="UTF-8" src="./Chicago Lobbyists_files/{stats}.js"></script></head>
<body>

<div id="nav">
  <div id="nav-content">
    <ul>
      <li class="current"><a href="./Chicago Lobbyists_files/minfo.php">Home</a></li>
      <li class=""><a href="http://www.chicagolobbyists.org/about">About</a></li>
      <li><a href="http://blog.chicagolobbyists.org/">Blog</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>

<!-- Content -->
<div id="content">
  <!-- Header -->
<div id="header">
  <div id="logo"><a href="./Chicago Lobbyists_files/Chicago Lobbyists.htm"><img alt="Chicago Lobbyists" src="./cfa_brigade_logo.png"></a></div>
  <div id="search">
  	<form action="http://www.chicagolobbyists.org/search" method="get">
	    <input class="hint" type="text" title="Find…" name="q">
	    <input type="submit" value="Search">
	  </form>
  </div>
  <div class="clear"></div>
</div>
<!-- /Header -->
  
  <ul id="stats">
	  <?php
		$con = new mysqli('localhost', 'root', '', 'nsf' /*YOUR DATABASE NAME*/ );
		if (mysqli_connect_errno()) {
			die('Could not connect: ' . mysqli_error());
		}
		
		$yr = $_GET['year'];
		$str = "SELECT * FROM Stats WHERE qyear = " . $yr . " AND querytype =\"" . $_GET['type'] . "\";";
		
		$sth = mysqli_query($con, $str);
		
		while( $r = mysqli_fetch_array($sth) ) {
		  echo "<li class=\"\"><a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Scientist\" class=\"stat\"><strong>" . $r['PI'] . "</strong> Scientists </a></li>";
		  echo "<li class=\"\"><a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Institution\" class=\"stat\"><strong>" . $r['Institution'] . "</strong> Institutions </a></li>";
		  echo "<li id = \"paid\"><span class=\"stat\"><strong>" . $r['TotalPatents'] . "</strong> Total Patents in " . $r['QYear'] . "</span></li>";
		  echo "<li class=\"\"><a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Directorate\" class=\"stat\"><strong>" . $r['Directorate'] . "</strong> Directorates </a></li>";
		  echo "<li class=\"\"><a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Division\" class=\"stat\"><strong>" . $r['Division'] . "</strong> Divisions </a></li>";
		}
		
		mysqli_close($con);
	  ?>
</ul>
<hr>

  
  <script type="text/javascript">
    $(function(){
    	setUlBarWidthByNumber('home-lobbyists');
    	setUlBarWidthByNumber('home-firms');
    	setUlBarWidthByNumber('home-clients');
    	setUlBarWidthByNumber('home-agencies');
    });
    
  </script>
  
  <div class="clear"></div>
  
  <div id="dashboard">
    <div class="c2l">
      <div class="section">
      	<?php
      	$yr = $_GET['year'];
      	$yr = $_GET['year'];

        echo "<h2> Directorate <a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Directorate";
        echo "\">All Directorates »</a></h2><ul class=\"chartlist\" id=\"home-lobbyists\">";

				$con = mysqli_connect("localhost","root","","nsf");
				if( mysqli_connect_errno() ) {
				  die('Could not connect: ' . mysqli_error());
				}
				
				$str = "";
				
				if($_GET['type'] == 'P') {
					$str = "select Count(OrganizationDirectorate) as Count, OrganizationDirectorate from Award a, P2A p, Patent_All pa where a.awardid=p.awardid and p.patno=pa.patentno and year(pa.patpubdate)=" . $yr . " group by OrganizationDirectorate order by Count desc limit 5;";
				}
				else {
					$str = "select count(*) as Count, OrganizationDirectorate from Award a, P2A p where a.awardid=p.awardid  and year(AwardEffectiveDate)=" . $yr . " group by OrganizationDirectorate order by Count desc limit 5;";
				}
				
				$sth = mysqli_query($con, $str);
				
				while($r = mysqli_fetch_array($sth)) {
					$num = $r['Count'];
					$name = $r['OrganizationDirectorate'];
					
					echo "<li><a href = \"details.php?type=" . $_GET['type'] ."&year=" . $yr . "&category=dir&orgdir=" . urlencode( $name ) . "\">" . $name . "</a><span class=\"index\"> style=\"width: 100%;\"></span><span class=\"count\">" . $num ."</span></li>";
					
				}
				
				mysqli_close($con);
			?>
        </ul>
      </div>
      
      <div class="section">
      	<?php
      	$yr = $_GET['year'];
      	echo "<h2> Division <a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Division";
      	echo "\">All Divisions »</a></h2><ul class=\"chartlist\" id=\"home-firms\">";
			
				$con = mysqli_connect("localhost","root","","nsf");
				if( mysqli_connect_errno() ) {
				  die('Could not connect: ' . mysqli_error());
				}
				
				$str = "";
				
				if($_GET['type'] == 'P') {
					$str = "select Count(OrganizationDivision) as Count, OrganizationDivision from Award a, P2A p, Patent_All pa where a.awardid=p.awardid and p.patno=pa.patentno and year(pa.patpubdate)=" . $yr . " group by OrganizationDivision order by Count desc limit 5;";
				}
				else {
					$str = "select count(*) as Count, OrganizationDivision from Award a, P2A p where a.awardid=p.awardid  and year(AwardEffectiveDate)=" . $yr . " group by OrganizationDivision order by Count desc limit 5;";
				}
				
				$sth = mysqli_query($con, $str);
				
				while($r = mysqli_fetch_array($sth)) {
					$num = $r['Count'];
					$name = $r['OrganizationDivision'];
					
					echo "<li><a href = \"details.php?type=" . $_GET['type'] ."&year=" . $yr . "&category=div&orgdiv=" . urlencode( $name ) . "\">" . $name . "</a><span class=\"index\"> style=\"width: 100%;\"></span><span class=\"count\">" . $num ."</span></li>";
				}
				
				mysqli_close($con);
			?>
        </ul>
      </div>
    </div>
    
    <div class="c2r">
      <div class="section">
      	<?php
      	$yr = $_GET['year'];
        echo "<h2>Scientists <a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Scientist";
        echo "\">All Scientists »</a></h2><ul class=\"chartlist\" id=\"home-clients\">";
			
				$con = mysqli_connect("localhost","root","","nsf");
				if( mysqli_connect_errno() ) {
				  die('Could not connect: ' . mysqli_error());
				}
				
				$str = "";
				
				if($_GET['type'] == 'P') {
					$str = "select FirstName as firstname, LastName as lastname, concat( FirstName,' ',LastName) as Name, count( concat(FirstName,' ',LastName )) as Count  from PI, P2A, Patent_All p where year(patpubdate)=" . $yr . " and patno=patentno and PI.AwardID=P2A.awardid group by Name order by Count desc limit 5;";
				}
				else {
					$str = "select FirstName as firstname, LastName as lastname, concat( FirstName, ' ', LastName ) as Name, count( concat(FirstName,' ', LastName) ) as Count from PI i, P2A p where i.AwardID = p.AwardID and Year(StartDate)=" . $yr . " group by firstname, lastname order by Count desc limit 5;";
				}
				
				$sth = mysqli_query($con, $str);
				
				//echo $str;
				
				while($r = mysqli_fetch_array($sth)) {
					$num = $r['Count'];
					$name = $r['Name'];
					$firstname = $r['firstname'];
					$lastname = $r['lastname'];
					
					echo "<li><a href = \"details.php?type=" . $_GET['type'] ."&year=" . $yr . "&category=pi&firstname=" . urlencode( $firstname ) . "&lastname=" . urlencode( $lastname ) . "\">" . $name . "</a><span class=\"index\"> style=\"width: 100%;\"></span><span class=\"count\">" . $num ."</span></li>";
				}
				
				mysqli_close($con);
			?>
        </ul>
      </div>
      
      <div class="section">
      	<?php
      	$yr = $_GET['year'];

        echo "<h2>Institution <a href=\"lists.php?type=" . $_GET['type'] . "&year=" . $yr . "&category=Institution";
        echo "\">All institutions »</a></h2><ul class=\"chartlist\" id=\"home-agencies\">";

				$con = mysqli_connect("localhost","root","","nsf");
				if(mysqli_connect_errno()) {
				  die('Could not connect: ' . mysqli_error());
				}
				
				$str = "";
				
				if($_GET['type'] == 'P') {
					$str = "select Name, Count(name) as Count from Institution i, P2A,Patent_All p where year(patpubdate)=" . $yr . " and patno=patentno and i.awardid=P2A.awardid group by Name order by Count desc limit 5;";
				}
				else {
					$str = "select Name, Count(name) as Count from Institution where AwardID in (select a.awardid from Award a, P2A p where a.awardid=p.awardid and year(a.AwardEffectiveDate)=" . $yr . ") group by name order by Count desc limit 5;";
				}
				
				$sth = mysqli_query($con, $str);
				
				while($r = mysqli_fetch_array($sth)) {
					$num = $r['Count'];
					$name = $r['Name'];
					
					echo "<li><a href = \"details.php?type=" . $_GET['type'] ."&year=" . $yr . "&category=inst&name=" . urlencode( $name ) . "\">" . $name . "</a><span class=\"index\"> style=\"width: 100%;\"></span><span class=\"count\">" . $num ."</span></li>";
					
				}
				
				mysqli_close($con);
			?>
        </ul>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  
  <hr>
  <div class="content-secondary">
  	<script src="./Chicago Lobbyists_files/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 1,
  interval: 6000,
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: '#B8E4F5',
      color: '#027ab6'
    },
    tweets: {
      background: '#ffffff',
      color: '#000000',
      links: '#027BB6'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'all'
  }
}).render().setUser('chilobbyists').start();
</script>
  </div>
  <h2>About this project</h2>
    <p>This project was based off of ChicagoLobbyists.org, which is an open data, open government, and open source project by <a href="http://opencityapps.org/">Open City</a> intended to improve the transparency of interactions between the City of Chicago and lobbyists and their clients. All data comes from the <a href="http://data.cityofchicago.org/">City of Chicago Data Portal</a>. <a href="http://www.chicagolobbyists.org/about">Read more »</a></p>

<h2>Contact us</h2>
    <p> If you have any questions, comments, concern, or would like to contribute, please email <a href = "fakemail.com"> fake_email@yes.com </a>. </p>
  
  <!-- Footer -->
<div id="footer">
  <p>This site was based off of Chicago Lobbyists, which was designed and developed by <a href="http://opencityapps.org/">Open City</a>. Copyright © 2012.</p>
</div>
<!-- /Footer -->

</div>
<!-- /Content -->



</body></html>
