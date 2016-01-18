<?php

include_once('functions.inc.php');
include_once('db.inc.php');

showHead("Ambasadorzy","&nbsp;");

$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
$amb = mysqli_query($link, "SELECT * FROM ambassadors WHERE zaakceptowany = 1");

?>

<div class="row">
	<div class="col-md-6">
		<div id="voteListBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Lista ambasadorów i ambasadorek</h2>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div id="mapBlock" class="block blackBlock">
			<div class="blockContent">
				<h2>Jawność wspierają</h2>
				<div style="height:450px" id="map"></div>
			</div>
		</div>
		<div id="voteBlock" class="block redBlock">
			<div class="blockContent">
				<div id="voteCount"><?php echo $amb->num_rows; ?></div>
				<h2>Ambasadorów Jawności</h2>
				<?php /* TODO: Display list with paggination*/ ?>
			</div>
		</div>
	</div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">

	var map;
	var geocoder;

	function initMap() {
		var latlng = new google.maps.LatLng(52.25, 18.66);
		var mapOptions = {
			zoom: 5,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById("map"), mapOptions);
		geocoder = new google.maps.Geocoder();
	}

	initMap();

	function codeAddressAmb(arg1,tit) {
		var address = arg1;
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: tit,
					label: "A"
				});
			} else {

			}
		});
	}

	<?php

	while($u = mysqli_fetch_array($amb, MYSQLI_ASSOC)) {
		echo "codeAddressAmb('".htmlspecialchars($u['miasto'])."', '".htmlspecialchars($u['imie']." ".$u['nazwisko']." / ".$u['miasto'])."');
		";
	}

	?>

</script>

<?php

showFooter();

?>
