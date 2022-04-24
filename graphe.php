<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="chart.js/Chart.min.js"></script>
	<script src="chart.js/Chart.js"></script>
</head>
<body>
	<h1>Exemple de Chart.js </h1>
	<div style="width: 30%">
		<div>
			<canvas id="canvas" height="204" width="273" style="width: 273px; height: 204px;"></canvas>
		</div>
	</div>
	
	


	<script>
		var ctx = document.getElementById("canvas").getContext("2d");
		
		var chart = new Chart(ctx,{
			type: 'line',

			data: {
				labels:["Jan","Feb","Mar","Avr","May","June","July"],
				datasets:[{
					label:"My first dataset",
					backgroundColor:'rgb(222,99,132)',
					borderColor: 'rgb(45,99,132)',
					data: [0,10,5,2,20,36,45],
				}]
			},
			options:{}
		});
	</script>

	<script>
		
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	
	</script>
</body>
</html>