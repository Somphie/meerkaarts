<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/header.css">
</head>

<body>

    <nav>
        <ul>
            <li><a id="word" href="">Over ons</a></li>
            <li><a id="word" href="">Gamemodes</a></li>
            <li><a id="word" href="">Home</a></li>
            <li><a id="word" href="">Prompts inzenden</a></li>
            <li><a id="word" href="">de samballen</a></li>
        </ul>
    </nav>

    <div class="list">
    </div>
    <style>
        nav {
            display: flex;
            flex-direction: row;

        }

        a {
            color: inherit;
            text-decoration: none;
        }

        ul {
            list-style-type: none;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            width: 100%;
            background: linear-gradient(90deg, rgba(133, 133, 133, 1) 0%, rgba(191, 189, 189, 1) 50%, rgba(133, 133, 133, 1) 100%);

            margin: 0;
            padding: 0;
            overflow: hidden;
            padding-top: 30px;
            padding-bottom: 32px;
        }

        li :hover {
            background-color: #212cf5ff;
            color: white;
            padding-top: 30px;
            padding-bottom: 32px;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        #word {
            padding: 14px 16px;
            padding-top: 31px;
            padding-bottom: 32px;
        }

        .list {
            height: 645px;
            display: flex;
            border-style: solid;
            border-color: gray;
            margin: 0;
        }
    </style>
</body>

</html>