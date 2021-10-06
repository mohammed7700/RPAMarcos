<!DOCTYPE html>
<html data-kanlang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular Macros - Scripts</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>

    <header>

        <p class="logo">Formular <span>Macros</span></p>

        <nav>
            <ul class="nav_links">
                <li><a href="index.php">Scripts</a></li>
                <li><a href="doku.html">Doku</a></li>
            </ul>
        </nav>

    </header>

    <div class="center upload">
        <h2 for="">Upload Scripts</h2>
        <div class="notMacroElements">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Upload</button>
            </form> 
        </div>
    </div>

    <div class="center">
        <h2>Macros</h2>
        <div class="notMacroElements" id="searchWrapper" name="">
            <input type="text" id="searchBar" placeholder=" Suche nach Script">
        </div>
    </div>

    <div id="mainContainer" class="contentContainer center">
        
        <div class="macro" name="">
            <label class="h2">Demo Script</label>
            <input id="b" type="button"  value="Run Macro" onclick="Test();">
            <input id="field" type="text" size="50">
        </div>
        
        <div class="macro" id="ScriptfürFormular34c">
            <label class="h2">Script für Formular 34c</label>
            <input id="b" type="button" class="script" value="Run Macro" onclick="formular34c();">

            <!-- <a href="https://www.develop-sr3snxi-ljhiuew5uktdu.eu-4.platformsh.site/antrag/34c">link zum Formular</a> -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="./script.js"></script>
</body>
</html>