<?php
    include './generate_data.php';
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css"> 
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./js/site.js"></script>
    </head>
    <body>
        <div id="site-container">
            <div>
                <span>Select Your Vehicle:</span>
            </div>
            <div>
                <select id="years">
                    <option>Choose a Year...</option>
                    <?php 
                        for ($i = 0; $i < count($years); $i++) {
                            echo "<option value=\"" . $years[$i] . "\">". $years[$i] ."</option>";
                        }
                    ?>
                </select>
                <select id="makes" disabled><option>...</option></select>
                <select id="models" disabled><option>...</option></select>
            </div>
            <div>
                <span id="selected-car"></span>
            </div>
        </div>
    </body>
</html>