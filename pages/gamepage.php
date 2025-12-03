<?php
$dir = "savedimg/";
if (!is_dir($dir)) mkdir($dir, 0777, true);

include("../database/database.php");


if (isset($_POST['imgBase64']) && isset($_POST['filename'])) {
    $filename = preg_replace('/[^a-z0-9_]/', '_', strtolower($_POST['filename'])) . ".png";
    $filepath = $dir . $filename;

    $data = $_POST['imgBase64'];
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $fileData = base64_decode($data);

    file_put_contents($filepath, $fileData);

    // Opslaan in database
    $stmt = $conn->prepare("INSERT INTO images (filename) VALUES (?)");
    $stmt->bind_param("s", $filename);
    $stmt->execute();
    $stmt->close();

    echo "Opslaan gelukt!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gamepage.css">
    <link rel="stylesheet" href="css/teken.css">
    <title>De GAme</title>
    <link rel="icon" type="image/x-icon" href="/pages/images/favi.ico">
</head>

<body>
    <?php include("../presets/nav.php"); ?>
    <main>
        <div class="alles">

            <div class="partyblock">
                <h1>PArty</h1>
                <div class="uservlak"></div>
            </div>

            <div class="grootediv">

                <div class="blauw">
                <div class="samuel">
                    <h1>De GAme</h1>
                    <h2 class= "prompt-display"></h2>
                </div>
                        
                    <div class="speelvlak"> 
                        <div id="sidebar">
                            <div class="colorButtons">
                                <h3>Colour</h3>
                                <input type="color" id="colorpicker" value="#c81464" class="colorpicker">
                            </div>
                            <div class="colorButtons">
                                <h3>Bg Color</h3>
                                <input type="color" value="#ffffff" id="bgcolorpicker" class="colorpicker">
                            </div>

                            <div class="toolsButtons">
                                <h3>Tools</h3>
                                <button id="eraser" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span></button>
                                <button id="clear" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></button>
                            </div>

                            <div class="buttonSize">
                                <h3>Size (<span id="showSize">5</span>)</h3>
                                <input type="range" min="1" max="50" value="5" step="1" id="controlSize">
                            </div>
                            
                            <div class="Storage">
                                <h3>Storage</h3>
                                <input type="button" value="Save" class="btn btn-warning" id="save">
                            </div>
                            <div class="halloffame">    
                            <h3>hall of fame</h3>
                                <a href="./halloffame.php">enter</a>
                            </div>
                        </div>
                        <div class="spelletje">

  

                        </div>
                    </div>
                </div>
            </div>
                <div class="rechts">

                </div>
        </div>
    </main>

    <?php include("../presets/footer.php"); ?>
<script src="scripts/PromptScript.js"></script>
<script src="scripts/TekenScript.js"></script>
</body>

</html>