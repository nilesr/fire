<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<script type="text/javascript" defer="defer">

			function DrawBuildings()
			{
				var floors = prompt("How many floors?");
				var rows = prompt("How many rows?");
				floors = Math.abs(floors);
				canvas = document.getElementById("maincanvas");
				canvas.height = document.height;
				var verticalpixelspace = canvas.height / floors;
				var horizontalpixelspace = canvas.width / rows;
				var context = canvas.getContext('2d');
				context.clearRect ( 0 , 0 , canvas.width , canvas.height );
				if (verticalpixelspace < 50)
				{
					canvas.height = 50 * floors;
					canvas.style.height = 50 * floors + "px";
					verticalpixelspace = 50;
				}
				if (horizontalpixelspace < 100)
				{
					canvas.width = 100 * rows;
					canvas.style.width = 100 * rows + "px";
					horizontalpixelspace = 100;
				}
				var tempfloors = floors
				while (tempfloors > -1)
				{
					context.lineWidth=1;
					context.beginPath();
					context.moveTo(0,tempfloors * verticalpixelspace);
					context.lineTo(canvas.width,tempfloors*verticalpixelspace);
					context.stroke();
					tempfloors = tempfloors - 1;
				}
				var temprows = rows;
				while (temprows > -1)
				{
					context.lineWidth=1;
					context.beginPath();
					context.moveTo(temprows * horizontalpixelspace,0)
					context.lineTo(temprows*horizontalpixelspace,canvas.height);
					context.stroke();
					temprows = temprows - 1;
				}
				tempfloors = 0;
				while (tempfloors < floors)
				{
					context.lineWidth=1;
					context.lineStyle="#000000";
					context.font="20px sans-serif";
					context.fillText(tempfloors + 1, 10, ( floors - tempfloors ) * verticalpixelspace - verticalpixelspace / 3);
					tempfloors = tempfloors + 1;
				}
			}
		</script>
		<title><? echo shell_exec('date "+%A, %h %d %G, %r"'); ?></title>
	</head>
	<body id="body">
	<div id="container"></div>
	<script src="http://d3lp1msu2r81bx.cloudfront.net/kjs/js/lib/kinetic-v4.5.3.min.js"></script>
	<script defer="defer">

		var stage = new Kinetic.Stage({
			container: 'container',
			width: document.width,
			height: document.height
		});
		var circleLayer = new Kinetic.Layer();
		function NewThingy() {
			console.log("NewThingy called");
			var circle = new Kinetic.Circle({
				x: document.width - 25,
				y: 25,
				radius: 12.5,
				fill: 'green',
				stroke: 'green',
				strokeWidth: 4,
				draggable: true
			});
			console.log("Circle object defined");
			circleLayer.add(circle);
			console.log("Circle added to circleLayer");
			circle.on('dragstart', function() {
			
			});
			circle.on('dragend', function() { // On the end of the drag
				circle.setStroke("green");
				circle.setFill("green");
				circleLayer.batchDraw();
				setTimeout(function(){ // Start a timer
					circle.setStroke("red"); // At the end of the time, set the stroke to red
					circle.setFill("yellow"); // and the fill to yellow
					circleLayer.batchDraw(); // Then update the layer
					setTimeout(function(){ // Set another timer
						circle.setFill("red"); // At the end of that, make the whole circle red
						circleLayer.batchDraw(); // And update the layer again
					},2*60000); // 2 minutes
				},13*60000); // 13 minutes
//					},1000); // 1 second
//				},1000); // 1 second
				console.log("Circle dropped");
			});
			console.log("Event functions defined");
			stage.add(circleLayer);

		}

		stage.add(circleLayer);
	</script>
		<noscript>
			<h1>Sorry, but you need Javascript for this program to work</h1>
		</noscript>
		<button id="reset" onclick="DrawBuildings();">Change Floors</button>
		<button id="addcircle" onclick="NewThingy();">Add thingy</button>
		<canvas id="maincanvas">
			<p>Your browser does not support the canvas element, sorry</p>
		</canvas>
	</body>
</html>