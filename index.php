<html>
<head>
<title>iiSpeed</title>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highstock/4.2.7/highstock.js" integrity="sha256-JA86G72B7L7ORMIAmfbGoqsH1pPGjuT7YEuVOIRd3H8=" crossorigin="anonymous"></script>
</head>
<body>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

<?php
$servername = "localhost";
$username = "iiSpeed";
$password = "password";
$dbname = "iiSpeed";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data";
$varping = '';
$vardlspeed = '';
$varulspeed = '';
$result = $conn->query($sql); if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
      $varping .= "[". ($row["sample_date_utc"]). ", ". $row["ping"]. "], ";
      $vardlspeed .= "[". ($row["sample_date_utc"]). ", ". $row["downspeed"]. "], ";
      $varulspeed .= "[". ($row["sample_date_utc"]). ", ". $row["upspeed"]. "], ";
   }
} else {
	echo "0 results";
}
$conn->close();

$varping = rtrim($varping, ', ');
$vardlspeed = rtrim($vardlspeed, ', ');
$varulspeed = rtrim($varulspeed, ', ');
?>

<script>
var tmpdate = new Date();
var tzoffset_mins = tmpdate.getTimezoneOffset();
var chart = new Highcharts.StockChart({
      chart: {
         renderTo: 'container'
      },
      title: {
         text: 'Speedtest'
      },
      xAxis: {
         type: 'datetime'
      },
      yAxis: {
         title: {
	    text: 'Speed (Mbps)'
         }
      },
      rangeSelector: {
      buttons: [{
         type: 'hour',
         count: 6,
         text: '6h'
      }, {
         type: 'day',
         count: 1,
         text: '1d'
      }, {
         type: 'day',
         count: 3,
         text: '3d'
      }, {
         type: 'day',
         count: 7,
         text: '1w'
      }, {
         type: 'month',
         count: 1,
         text: '1m'
      }, {
         type: 'all',
         text: 'All'
      }],
      selected: 2
      },
      series: [{
         name: 'ping',
         data: [<?php echo "$varping" ?>]
      }, {
         name: 'Download Speed',
         data: [<?php echo "$vardlspeed" ?>]
      }, {
         name: 'Upload Speed',
         data: [<?php echo "$varulspeed" ?>]
      }]
});

var chartoptions = Highcharts.setOptions({
   global: {
      useUTC: false,
      timezoneOffset: (tzoffset_mins * -1) * 60
   }
});
</script>

</body>
</html>
