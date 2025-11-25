//is niet ons script is van gogle afgehaald

// SETTING ALL VARIABLES
let saveCounter = 1;

		var isMouseDown=false;
		var canvas = document.createElement('canvas');
		var body = document.getElementsByTagName("body")[0];
		var ctx = canvas.getContext('2d');
		var linesArray = [];
		currentSize = 5;
		var currentColor = "rgb(200,20,100)";
		var currentBg = "white";

		// INITIAL LAUNCH

		createCanvas();

		// BUTTON EVENT HANDLERS

		document.getElementById('colorpicker').addEventListener('change', function() {
			currentColor = this.value;
		});
		document.getElementById('bgcolorpicker').addEventListener('change', function() {
			ctx.fillStyle = this.value;
			ctx.fillRect(0, 0, canvas.width, canvas.height);
			redraw();
			currentBg = ctx.fillStyle;
		});
		document.getElementById('controlSize').addEventListener('change', function() {
			currentSize = this.value;
			document.getElementById("showSize").innerHTML = this.value;
		});
		document.getElementById('saveToImage').addEventListener('click', function() {
			downloadCanvas(this, 'canvas', 'masterpiece.png');
		}, false);
		document.getElementById('eraser').addEventListener('click', eraser);
		document.getElementById('clear').addEventListener('click', createCanvas);
		document.getElementById('save').addEventListener('click', save);

		// REDRAW 

		function redraw() {
				for (var i = 1; i < linesArray.length; i++) {
					ctx.beginPath();
					ctx.moveTo(linesArray[i-1].x, linesArray[i-1].y);
					ctx.lineWidth  = linesArray[i].size;
					ctx.lineCap = "round";
					ctx.strokeStyle = linesArray[i].color;
					ctx.lineTo(linesArray[i].x, linesArray[i].y);
					ctx.stroke();
				}
		}

		// DRAWING EVENT HANDLERS

		canvas.addEventListener('mousedown', function() {mousedown(canvas, event);});
		canvas.addEventListener('mousemove',function() {mousemove(canvas, event);});
		canvas.addEventListener('mouseup',mouseup);

		// CREATE CANVAS

		function createCanvas() {
            const spelDiv = document.querySelector('.spelletje');
            const oldCanvas = document.getElementById("canvas");
            if (oldCanvas) oldCanvas.remove();

            canvas = document.createElement('canvas');
            canvas.id = "canvas";

            // gebruik de afmetingen van spelDiv direct
            const width = spelDiv.offsetWidth;
            const height = spelDiv.offsetHeight;

            // zet interne resolutie gelijk aan visuele grootte
            canvas.width = width;
            canvas.height = height;
            canvas.style.width = width + "px";
            canvas.style.height = height + "px";

            canvas.style.border = "1px solid black";
            canvas.style.position = "relative";
            canvas.style.zIndex = 1;

            spelDiv.appendChild(canvas);
            ctx = canvas.getContext('2d');
            ctx.fillStyle = currentBg;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
}


		// DOWNLOAD CANVAS

		function downloadCanvas(link, canvas, filename) {
			link.href = document.getElementById(canvas).toDataURL();
			link.download = filename;
		}

		// SAVE FUNCTION

        function save() {
  const saveItem = {
    name: "img" + saveCounter,
    data: [...linesArray] // kopie van huidige lijnen
  };

  // haal bestaande saves op
  let saves = JSON.parse(localStorage.getItem("savedCanvas")) || [];
  saves.push(saveItem);

  // sla opnieuw op
  localStorage.setItem("savedCanvas", JSON.stringify(saves));

  // log netjes in console
  console.clear();
  saves.forEach(item => {
    console.log(item.name, item.data);
  });

  saveCounter++;
}

		// LOAD FUNCTION

		function load() {
			if (localStorage.getItem("savedCanvas") != null) {
				linesArray = JSON.parse(localStorage.savedCanvas);
				var lines = JSON.parse(localStorage.getItem("savedCanvas"));
				for (var i = 1; i < lines.length; i++) {
					ctx.beginPath();
					ctx.moveTo(linesArray[i-1].x, linesArray[i-1].y);
					ctx.lineWidth  = linesArray[i].size;
					ctx.lineCap = "round";
					ctx.strokeStyle = linesArray[i].color;
					ctx.lineTo(linesArray[i].x, linesArray[i].y);
					ctx.stroke();
				}
				console.log("Canvas loaded.");
			}
			else {
				console.log("No canvas in memory!");
			}
		}

		// ERASER HANDLING

		function eraser() {
            currentColor = currentBg;
            currentSize = 20;

		}

		// GET MOUSE POSITION

		

		// ON MOUSE DOWN

                    function mousedown(canvas, evt) {
            isMouseDown = true;
            ctx.beginPath();
            ctx.moveTo(evt.offsetX, evt.offsetY);
            ctx.lineWidth = currentSize;
            ctx.lineCap = "round";
            ctx.strokeStyle = currentColor;
            }

            function mousemove(canvas, evt) {
            if (!isMouseDown) return;
            ctx.lineTo(evt.offsetX, evt.offsetY);
            ctx.stroke();
            store(evt.offsetX, evt.offsetY, currentSize, currentColor);
            }

		// STORE DATA

		function store(x, y, s, c) {
			var line = {
				"x": x,
				"y": y,
				"size": s,
				"color": c
			}
			linesArray.push(line);
		}

		// ON MOUSE UP

		function mouseup() {
			isMouseDown=false
			store()
		}