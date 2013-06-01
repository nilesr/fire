<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<script type="text/javascript" src="http://d3lp1msu2r81bx.cloudfront.net/kjs/js/lib/kinetic-v4.5.3.min.js"></script>
		<script type="text/javascript">

			function drawImage(imageObj)
			{
				if (!stage)
				{
					console.log("Creating new stage");
					var stage = new Kinetic.Stage({
						container: "body",
						width: document.width,
						height: document.height
					});
				}
				if (!layer)
				{
					console.log("Creating new layer");
					var layer = new Kinetic.Layer();
				}
				console.log("Creating new image");
				var thingy = new Kinetic.Image({
					image: imageObj,
					x: 0,
					y: 0,
					width: 25,
					height: 25,
					draggable: true
				});
				console.log("Adding image to layer");
				layer.add(thingy);
				console.log("Adding layer to stage");
				stage.add(layer);


			}
			function DrawBuildings()
			{
				var floors = prompt("How many floors?");
				floors = Math.abs(floors);
				canvas = document.getElementById("maincanvas");
				canvas.height = document.height;
				var pixelspace = canvas.height / floors;
				var context = canvas.getContext('2d');
				context.clearRect ( 0 , 0 , canvas.width , canvas.height );
				if (pixelspace < 50)
				{
					canvas.height = 50 * floors;
					canvas.style.height = 50 * floors + "px";
					pixelspace = 50;
				}
				var tempfloors = floors
				while (tempfloors > -1)
				{
					context.lineWidth=1;
					context.beginPath();
					context.moveTo(0,tempfloors * pixelspace);
					context.lineTo(canvas.width,tempfloors*pixelspace);
					context.stroke();
					tempfloors = tempfloors - 1;
				}
				context.beginPath();
				context.lineWidth=1;
				context.moveTo(0,0);
				context.lineTo(0,canvas.height);
				context.stroke();
				context.beginPath();
				context.lineWidth=1;
				context.moveTo(canvas.width,0);
				context.lineTo(canvas.width,canvas.height);
				context.stroke();
				tempfloors = 0;
				while (tempfloors < floors)
				{
					context.lineWidth=1;
					context.lineStyle="#000000";
					context.font="20px sans-serif";
					context.fillText(tempfloors + 1, 10, ( floors - tempfloors ) * pixelspace - pixelspace / 3);
					tempfloors = tempfloors + 1;
				}
			}
			function NewThingy() {
				var imageObj = new Image();
				imageObj.onload = function() {
					drawImage(this);
				};
				imageObj.src = 'green.png';
			}
		</script>
		<title><? echo shell_exec('date "+%A, %h %d %G, %r"'); ?></title>
	</head>
	<body id="body">
		<noscript>
			<h1>Sorry, but you need Javascript for this program to work</h1>
		</noscript>
		<button class="button" onclick="DrawBuildings();">Change Floors</button>
		<button class="button" onclick="NewThingy();">Add thingy</button>
		<canvas id="maincanvas">
			<p>Your browser does not support the canvas element, sorry</p>
		</canvas>
		<span id="box">
		</span>
	</body>
</html>