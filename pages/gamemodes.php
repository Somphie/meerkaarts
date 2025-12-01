<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gamemodes.css">
    <title>GAmemodes</title>
    <link rel="icon" type="image/x-icon" href="/pages/images/favi.ico">
</head>

<body>
    <?php include("../presets/nav.php"); ?>
    <main>
        <div class="grootediv">
        <div class="blauw">
            <h1>De GAme</h1>

        <div class="games">
    
        <div class="original">
            <h2>Original Mode</h2>
            <button class="join">Create party</button><br>
            <form action="gamepage.php"></form>
            <label for="join" class="join">enter code</label><br>
            <input type="text" class="join" name="join" value=""><br>
            <!--<input type="submit" class="join-button" value="Submit"> is voor later maar nu is button zodat die soort van werkt -->
            <a href="gamepage.php" class="join-button">join</a>
        </div>

        <div class="promtmode">
            <h2>Prompt Mode</h2>
            <button class="join">Create party</button><br>
            <form action="gamepage.php"></form>
            <label for="join" class="join">enter code</label><br>
            <input type="text" class="join" name="join" value=""><br>
            <!--<input type="submit" class="join-button" value="Submit"> is voor later maar nu is button zodat die soort van werkt -->
            <a href="gamepage.php" class="join-button">join</a>
        </div>
    </div>
        </div>

        </div>
    </main>

    

</body>

</html>