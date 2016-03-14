<?php

include_once('functions.inc.php');
include_once('db.inc.php');

showHead("Ambasadorzy", "&nbsp;");

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);
$amb = mysqli_query($link, "SELECT * FROM ambassadors WHERE zaakceptowany = 1");

?>

<div class="row">
	<div class="col-md-6">
		<div id="voteListBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Lista Ambasadorów i Ambasadorek</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Imię i nazwisko</th>
							<th>Miejscowość</th>
						</tr>
					</thead>
						<tbody>
						<?php
                            $id_amb = 1;
                        while ($row = mysqli_fetch_array($amb)) {
                            $name = htmlspecialchars($row['imie']." ".$row['nazwisko']);
                            $city = htmlspecialchars($row['miasto']);
                            echo "<tr><td>$id_amb</td><td>$name</td><td>$city</td></tr>";
                            $id_amb++;
                        }
                        ?>
						</tbody>
				</table>
			</div>
		</div>
		<div id="descriptionBlock" class="block">
			<div class="blockContent" style="margin: 0 auto">
				<img src="/static/images/tabliczki.jpg" style="display: block; margin: 0 auto; max-width: 100%; max-height: 15em" alt="Jawność sprzyja!" title="Jawność sprzyja!" />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div id="mapBlock" class="block blackBlock">
			<div class="blockContent">
				<h2 style="margin-bottom: 0.5em">Jawność wspierają</h2>
				<div style="height:450px" id="map"></div>
			</div>
		</div>
		<div id="voteBlock" class="block redBlock">
			<div class="blockContent">
				<div id="voteCount"><?php echo $amb->num_rows; ?></div>
				<h2>Ambasadorów i Ambasadorek Jawności</h2>
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
		var style = [{
			"featureType": "administrative", "elementType": "geometry.fill",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "administrative",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "on"
			}, {
				"color": "#8e8e8e"
			}]
		}, {
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [{
				"color": "#7f7f7f"
			}]
		}, {
			"featureType": "administrative",
			"elementType": "labels.text.stroke",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "administrative.country",
			"elementType": "geometry.stroke",
			"stylers": [{
				"color": "#bebebe"
			}]
		}, {
			"featureType": "administrative.province",
			"elementType": "geometry.stroke",
			"stylers": [{
				"visibility": "on"
			}, {
				"color": "#cbcbcb"
			}, {
				"weight": "0.69"
			}]
		}, {
			"featureType": "administrative.locality",
			"elementType": "geometry",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [{
				"color": "#e4e4e4"
			}]
		}, {
			"featureType": "poi",
			"elementType": "all",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road",
			"elementType": "all",
			"stylers": [{
				"saturation": -100
			}, {
				"lightness": 45
			}, {
				"visibility": "simplified"
			}]
		}, {
			"featureType": "road",
			"elementType": "geometry.stroke",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road",
			"elementType": "labels",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [{
				"visibility": "simplified"
			}, {
				"color": "#dadada"
			}]
		}, {
			"featureType": "road.highway",
			"elementType": "labels",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road.highway",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "road.arterial",
			"elementType": "all",
			"stylers": [{
				"visibility": "on"
			}]
		}, {
			"featureType": "road.arterial",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road.local",
			"elementType": "all",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "road.local",
			"elementType": "geometry",
			"stylers": [{
				"color": "#eeeeee"
			}]
		}, {
			"featureType": "road.local",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "simplified"
			}]
		}, {
			"featureType": "transit",
			"elementType": "all",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "water",
			"elementType": "all",
			"stylers": [{
				"color": "#cbcbcb"
			}, {
				"visibility": "on"
			}]
		}, {
			"featureType": "water",
			"elementType": "geometry.fill",
			"stylers": [{
				"color": "#d9d9d9"
			}]
		}, {
			"featureType": "water",
			"elementType": "geometry.stroke",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "water",
			"elementType": "labels.text",
			"stylers": [{
				"visibility": "simplified"
			}]
		}];
		var mapOptions = {
			zoom: 5,
			center: latlng,
			styles: style
		};

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
    
    $amb = mysqli_query($link, "SELECT * FROM ambassadors WHERE zaakceptowany = 1");
    while ($u = mysqli_fetch_array($amb, MYSQLI_ASSOC)) {
        echo "codeAddressAmb('".htmlspecialchars($u['miasto'])."', '".htmlspecialchars($u['imie']." ".$u['nazwisko']." / ".$u['miasto'])."');
		";
    }

    ?>

</script>

<?php

showFooter();

?>
