let saveCounter = 1;

let isMouseDown = false;
let canvas;
let ctx;
let linesArray = [];

let currentSize = 5;
let currentColor = "rgb(200,20,100)";
let currentBg = "white";

createCanvas();

function createCanvas() {
    const spelDiv = document.querySelector('.spelletje');
    const oldCanvas = document.getElementById("canvas");
    if (oldCanvas) oldCanvas.remove();

    canvas = document.createElement('canvas');
    canvas.id = "canvas";

    const width = spelDiv.offsetWidth;
    const height = spelDiv.offsetHeight;

    canvas.width = width;
    canvas.height = height;
    canvas.style.width = width + "px";
    canvas.style.height = height + "px";
    canvas.style.border = "1px solid black";

    spelDiv.appendChild(canvas);

    ctx = canvas.getContext('2d');
    ctx.fillStyle = currentBg;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    canvas.addEventListener('mousedown', e => mousedown(canvas, e));
    canvas.addEventListener('mousemove', e => mousemove(canvas, e));
    canvas.addEventListener('mouseup', mouseup);
}

function redraw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = currentBg;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    for (let i = 1; i < linesArray.length; i++) {
        ctx.beginPath();
        ctx.moveTo(linesArray[i - 1].x, linesArray[i - 1].y);
        ctx.lineWidth = linesArray[i].size;
        ctx.lineCap = "round";
        ctx.strokeStyle = linesArray[i].color;
        ctx.lineTo(linesArray[i].x, linesArray[i].y);
        ctx.stroke();
    }
}

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

function mouseup() {
    isMouseDown = false;
}

function store(x, y, s, c) {
    linesArray.push({ x, y, size: s, color: c });
}

function save() {
    let activePrompt = localStorage.getItem("currentPrompt") || "masterpiece";
    const cleanName = activePrompt.replace(/[^a-z0-9]/gi, "_").toLowerCase();
    const dataURL = canvas.toDataURL("image/png");

    fetch("/database/push_image.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
            image: dataURL, 
            filename: cleanName,
            prompt: activePrompt
        })
    })
    .then(response => response.json())
    .then(result => {
        if (result.status == 'success') {
            console.log("afbeelding opgeslagen op server, hier is ie:", result.path);
        } else {
            console.error("errortje bij opslaan:", result.error);
        }
    })
    .catch(err => console.error(err));
}

function eraser() {
    currentColor = currentBg;
    currentSize = 20;
}

document.getElementById('colorpicker').addEventListener('change', function () {
    currentColor = this.value;
});
document.getElementById('bgcolorpicker').addEventListener('change', function () {
    currentBg = this.value;
    redraw();
});
document.getElementById('controlSize').addEventListener('change', function () {
    currentSize = this.value;
    document.getElementById("showSize").innerHTML = this.value;
});

document.getElementById('eraser').addEventListener('click', eraser);
document.getElementById('clear').addEventListener('click', createCanvas);
document.getElementById('save').addEventListener('click', save);
