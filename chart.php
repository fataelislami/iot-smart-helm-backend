<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smart-helm";

    function show_data($no_wa)
    {
        global $servername,$username,$password,$dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $data = array(
                'status' => "error",
                'message' => "Connection failed: " . $conn->connect_error 
            );
        }

        $sql = "SELECT id, suhu, no_wa FROM suhu WHERE no_wa = $no_wa ORDER BY date_time DESC LIMIT 5";
        $result = $conn->query($sql);

        $data_suhu = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $temp = array(
                    'id' => $row["id"],
                    'suhu' => $row["suhu"],
                    'no_wa' => $row["no_wa"],
                );
                array_push($data_suhu,$temp);
            }
          }

        $data = array(
            'status' => "success",
            'message' => "data show" ,
            'result' => $data_suhu,
        );

		$conn->close();
		
		return $data_suhu;
    } 

    if(!empty($_GET['tipe']) AND $_GET['tipe'] == 'show' AND !empty($_GET['no_wa'])){
		$no_wa = $_GET['no_wa'];

		$list_suhu = show_data($no_wa);
		// var_dump($list_suhu);die;
	}  
?>


<!doctype html>
<html>

<head>
	<title>Line Chart</title>
	<script src="Chart.min.js"></script>
	<script src="utils.js"></script>
	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>

	<?php if (isset($list_suhu)): ?>
		<center>
			<div style="width:75%;">
				<canvas id="canvas"></canvas>
			</div>
		</center>

		<script>
			// var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
			var config = {
				type: 'line',
				data: {
					labels: ['suhu 1', 'suhu 2', 'suhu 3', 'suhu 4', 'suhu 5'],
					datasets: [{
						label: 'suhu',
						backgroundColor: window.chartColors.red,
						borderColor: window.chartColors.red,
						data: [
							<?= (isset($list_suhu[0]['suhu'])) ? $list_suhu[0]['suhu'] : "0" ; ?>,
							<?= (isset($list_suhu[1]['suhu'])) ? $list_suhu[1]['suhu'] : "0" ; ?>,
							<?= (isset($list_suhu[2]['suhu'])) ? $list_suhu[2]['suhu'] : "0" ; ?>,
							<?= (isset($list_suhu[3]['suhu'])) ? $list_suhu[3]['suhu'] : "0" ; ?>,
							<?= (isset($list_suhu[4]['suhu'])) ? $list_suhu[4]['suhu'] : "0" ; ?>,
						],
						fill: false,
					}]
				},
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'RIWAYAT SUHU TUBUH'
					},
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					scales: {
						xAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Month'
							}
						}],
						yAxes: [{
							display: true,
							scaleLabel: {
								display: true,
								labelString: 'Value'
							},
							ticks: {
								suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
								suggestedMax: 45,
							}
						}]
					}
				}
			};

			window.onload = function() {
				var ctx = document.getElementById('canvas').getContext('2d');
				window.myLine = new Chart(ctx, config);
			};

			document.getElementById('randomizeData').addEventListener('click', function() {
				config.data.datasets.forEach(function(dataset) {
					dataset.data = dataset.data.map(function() {
						return randomScalingFactor();
					});

				});

				window.myLine.update();
			});

			var colorNames = Object.keys(window.chartColors);
			document.getElementById('addDataset').addEventListener('click', function() {
				var colorName = colorNames[config.data.datasets.length % colorNames.length];
				var newColor = window.chartColors[colorName];
				var newDataset = {
					label: 'Dataset ' + config.data.datasets.length,
					backgroundColor: newColor,
					borderColor: newColor,
					data: [],
					fill: false
				};

				for (var index = 0; index < config.data.labels.length; ++index) {
					newDataset.data.push(randomScalingFactor());
				}

				config.data.datasets.push(newDataset);
				window.myLine.update();
			});

			document.getElementById('addData').addEventListener('click', function() {
				if (config.data.datasets.length > 0) {
					var month = MONTHS[config.data.labels.length % MONTHS.length];
					config.data.labels.push(month);

					config.data.datasets.forEach(function(dataset) {
						dataset.data.push(randomScalingFactor());
					});

					window.myLine.update();
				}
			});

			document.getElementById('removeDataset').addEventListener('click', function() {
				config.data.datasets.splice(0, 1);
				window.myLine.update();
			});

			document.getElementById('removeData').addEventListener('click', function() {
				config.data.labels.splice(-1, 1); // remove the label first

				config.data.datasets.forEach(function(dataset) {
					dataset.data.pop();
				});

				window.myLine.update();
			});
		</script>
	<?php endif ?>
	
</body>

</html>
