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

        <img src="./assets/images/publicplan_logo_ohne-claim_320x56.png" alt="">

        <nav>
            <ul class="nav_links">
                <li><a href="index.php">Scripts</a></li>
                <li><a href="doku.html">Doku</a></li>
            </ul>
        </nav>

    </header>

    <div class="center upload">
        <h2 for="">Upload automatisierter Test Skripts</h2>
        <div class="notMacroElements">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Upload</button>
            </form> 
        </div>
    </div>

    <div class="center">
        <h2>Test Skripts</h2>
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
            <form action="deletefile.php" method="POST">
                <input style="display: none" type="text" name="filename" value="${json['Name']}">
                <button type="submit" class="delete" name="submit">X</button>
            </form> 

            <label class="h2">Script für Formular 34c</label>
            <input id="b" type="button" class="script" value="Run Macro" onclick="formular34c();">

            <!-- <a href="https://www.develop-sr3snxi-ljhiuew5uktdu.eu-4.platformsh.site/antrag/34c">link zum Formular</a> -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
</body>
</html>

<script>
        var json34c;

        const searchBar = document.getElementById('searchBar');
        const macros = document.getElementsByClassName('macro');
        console.log(document.getElementById('searchBar'));
        console.log(document.getElementsByClassName('macro'));


        //display none jedes Macro div welches substring, aus searchBar nicht enthält
        searchBar.addEventListener('keyup', (e) => {

            var searchStr = e.target.value.toLowerCase();

            console.log("Die Suche: "+searchStr);

            for (let i = 0; i < macros.length; i++) {

                macros[i].style.display = "block";
            }

            if(searchStr != ""){

                for (let i = 0; i < macros.length; i++) {

                    if(!macros[i].firstElementChild.innerHTML.toLowerCase().includes(searchStr)) {

                        macros[i].style.display = "none";
                    }
                }
            }
        });

        const loadEntries = (data) => {

            document.getElementById("mainContainer").innerHTML = "";

            for(var i = 0; i < data.length; i++){

                if(!!data[i]) {

                    intoHTMLDOM(data[i]);
                    loadScript(data[i]);
                }
            }
        }

        function loadScript(script) {

            document.getElementById(script['Name'].replace(/\s/g, '')).addEventListener('click', () => {

                //RPA script for embedding Macros
                (function (detail) {
                    var isExtensionLoaded = function () {
                        var $root = document.documentElement
                        return !!$root && !!$root.getAttribute('data-kantu')
                    }
                    var openExternal = function (url) {
                        const $el = document.createElement('a')
                        $el.setAttribute('target', '_blank')
                        $el.setAttribute('href', url)
                        $el.style.position = 'absolute'
                        $el.style.top = '-9999px'
                        $el.style.left = '-9999px'
                        document.body.appendChild($el)
                        $el.click()
                        setTimeout(() => {
                            $el.remove()
                        }, 200)
                    }
                    var openWebsite = function () {
                        openExternal('https://ui.vision/rpa/home/getrpa')
                    }
                    if (!isExtensionLoaded()) {
                        if (confirm('UI.Vision RPA is not installed yet. Do you want to download it now?')) {
                            return openWebsite()
                        }
                    } else {
                        return window.dispatchEvent(new CustomEvent('kantuSaveAndRunMacro', { detail: detail }))
                    }
                })
                    ({
                        direct: true, //If the website URL is whitelisted, run the macro without prompt
                        json: script
                    })
            });
        }


        function intoHTMLDOM(json) {

            var container = document.getElementById("mainContainer");
            container.innerHTML += createHtmlElements(json);
        }

        function createHtmlElements (json) {

            var tmpHTML = "";

            var exURL = locateURL(json);
            var linkTag = '';

            if(exURL != ''){
                linkTag = `
                    <a href="${exURL}" target="_blank">link zum Formular</a>
                    `
            }

            tmpHTML += `
            <div class="macro" id="${json['Name'].replace(/\s/g, '')}">
                <form action="deletefile.php" method="POST">
                    <input style="display: none" type="text" name="filename" value="${json['Name']}">
                    <button type="submit" class="delete" name="submit">Löschen</button>
                </form> 

                <label class="h2">${json['Name']}</label>
                <input id="b" class="script" type="button" value="Run Macro">
                ${linkTag}
            </div>`;

            return tmpHTML;
        }

        //sucht nach "open" command und dessen Link zum Formular
        function locateURL(json) {

            var commands = json['Commands'];

            for(var i = 0; i < commands.length; i++){

                var command = commands[i];
                console.log("war ich hier?");

                if(command['Command'] == 'open'){
                    return command['Target'];
                }
            }

            return '';
        }


        window.onload = function () {

            console.log("test script6");

            /*fetch('load.php').then(response => {

                return response.json();
            }).then(data => {

                loadEntries(data);
            }); */

            var json = 
            <?php //scripts laden 
                foreach (new DirectoryIterator('./assets/scripts') as $file) {

                if($file -> getExtension() === 'json')
                    $array[] = json_decode(file_get_contents($file -> getPathname()), true);
                }

                $result = json_encode($array, JSON_PRETTY_PRINT);

                echo $result;
            ?>;    

            console.log(json);

            loadEntries(json);
        }

        function Test() {
            // Embedded UI.Vision RPA Macros V3.61, License: MIT License (Open-Source), (c) 2020 a9t9
            //This code snippet checks if UI.Vision RPA is installed, and if yes, tells the RPA software to import and run the macro.
            //In UI.Vision RPA itself the user can allow/not allow to run embedded web macros (OFF by default)
            //To run web macros from specific websites without warning prompt, they URLs of certain websites can be whitelisted
            //For more details please see https://ui.vision/docs#embed

            (function (detail) {
                var isExtensionLoaded = function () {
                    var $root = document.documentElement
                    return !!$root && !!$root.getAttribute('data-kantu')
                }
                var openExternal = function (url) {
                    const $el = document.createElement('a')
                    $el.setAttribute('target', '_blank')
                    $el.setAttribute('href', url)
                    $el.style.position = 'absolute'
                    $el.style.top = '-9999px'
                    $el.style.left = '-9999px'
                    document.body.appendChild($el)
                    $el.click()
                    setTimeout(() => {
                        $el.remove()
                    }, 200)
                }
                var openWebsite = function () {
                    openExternal('https://ui.vision/rpa/home/getrpa')
                }
                if (!isExtensionLoaded()) {
                    if (confirm('UI.Vision RPA is not installed yet. Do you want to download it now?')) {
                        return openWebsite()
                    }
                } else {
                    return window.dispatchEvent(new CustomEvent('kantuSaveAndRunMacro', { detail: detail }))
                }
            })
                ({
                    direct: true, //If the website URL is whitelisted, run the macro without prompt
                    json: {
                        //Macro JSON code here. You can copy and paste the code directly from the source tab, https://ui.vision/docs#sourcecodetab
                        "Name": "EmbeddedMacro_FillOutGoogleForm",
                        "CreationDate": "2019-11-25",
                        "Commands": [

                            {
                                "Command": "type",
                                "Target": "id=field",
                                "Value": "hat geklappt!"
                            }

                        ]
                    }
                })
        }

        function formular34c() {
            // Embedded UI.Vision RPA Macros V3.61, License: MIT License (Open-Source), (c) 2020 a9t9
            //This code snippet checks if UI.Vision RPA is installed, and if yes, tells the RPA software to import and run the macro.
            //In UI.Vision RPA itself the user can allow/not allow to run embedded web macros (OFF by default)
            //To run web macros from specific websites without warning prompt, they URLs of certain websites can be whitelisted
            //For more details please see https://ui.vision/docs#embed

            (function (detail) {
                var isExtensionLoaded = function () {
                    var $root = document.documentElement
                    return !!$root && !!$root.getAttribute('data-kantu')
                }
                var openExternal = function (url) {
                    const $el = document.createElement('a')
                    $el.setAttribute('target', '_blank')
                    $el.setAttribute('href', url)
                    $el.style.position = 'absolute'
                    $el.style.top = '-9999px'
                    $el.style.left = '-9999px'
                    document.body.appendChild($el)
                    $el.click()
                    setTimeout(() => {
                        $el.remove()
                    }, 200)
                }
                var openWebsite = function () {
                    openExternal('https://ui.vision/rpa/home/getrpa')
                }
                if (!isExtensionLoaded()) {
                    if (confirm('UI.Vision RPA is not installed yet. Do you want to download it now?')) {
                        return openWebsite()
                    }
                } else {
                    return window.dispatchEvent(new CustomEvent('kantuSaveAndRunMacro', { detail: detail }))
                }
            })
                ({
                    direct: true, //If the website URL is whitelisted, run the macro without prompt
                    json: json34c
                })
        }

            /*var phpJson = ?<php echo $JsonData ?>;*/


            /*searchBar.addEventListener('keyup', (e) => {

            var searchStr = e.target.value.toLowerCase();

            console.log(searchStr);

            const filteredDataset = dataset.filter( macro => {
                
                return macro.Name.toLowerCase().includes(searchStr);
            });

                loadEntries(filteredDataset);
            });*/
</script>
