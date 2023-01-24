<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Json Decode -->
    <?php
    $json = file_get_contents("config.json");
    $configJson = json_decode($json, true);
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $configJson["title"]; ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="<?php echo $configJson["logopath"]; ?>" type="image/x-icon">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar-container">
        <div class="navbar-logo">
            <h1><?php echo $configJson["h1title"]; ?></h1>
        </div>
        <div class="navbar-links">
            <?php $links = $configJson['links']; ?>
            <?php foreach ($links as $link) { ?>
                <a href="./index.php"><?php echo $link["documentation"]; ?></a>
                <a href="./summary.php"><?php echo $link["summary"]; ?></a>
                <?php $xmlstrse = simplexml_load_file($configJson["xmlpath"]); ?>
                <?php $i = 1; ?>
                <?php $programNamese = [] ?>
                <?php foreach ($xmlstrse->members->member as $xmlstre) { ?>
                    <?php $atributoe = $xmlstre->attributes(); ?>
                    <?php $nombre1 = $atributoe['name'];
                    $nombre1 = substr($nombre1, strpos($nombre1, '.') + 1);
                    $nombre1 = substr($nombre1, strpos($nombre1, '.') + 1); ?>
                    <?php $programNamese[$i - 1] = $nombre1; ?>
                    <?php $i++; ?>
                <?php } ?>
        </div>
        <div class="metodes">
            <?php $cont = 0; ?>
            <p><?php echo $configJson["selectFunction"]; ?></p>
            <form action="./functions.php" method="POST">
                <select name="seleccio">
                    <?php while ($cont < sizeof($programNamese)) { ?>
                        <option value="<?php echo $programNamese[$cont]; ?>"><?php echo $programNamese[$cont]; ?></option>
                        <?php $cont++; ?>
                    <?php } ?>
                    <input class="find" type="submit" value="Buscar">
                </select>
            </form>
        </div>
    <?php } ?>
    </div>
    </div>
    <div class="content">
        <div class="documentation-content-summary">
            <?php $xmlstrs = simplexml_load_file($configJson["xmlpath"]); ?>
            <?php $i = 1; ?>
            <?php $programNames = [] ?>
            <?php foreach ($xmlstrs->members->member as $xmlstr) { ?>
                <?php $sections = $configJson['sections']; ?>
                <?php foreach ($sections as $section) { ?>
                    <?php $noms = []; ?>
                    <div class="summaries">
                        <?php $atributo = $xmlstr->attributes(); ?>
                        <?php $nombre = $atributo['name'];
                        $nombre = substr($nombre, strpos($nombre, '.') + 1);
                        $nombre = substr($nombre, strpos($nombre, '.') + 1); ?>
                        <?php $noms[$i] = $nombre; ?>
                        <div class="divButton <?php echo $i; ?>" onclick="copyText('<?php echo $nombre; ?>', <?php echo $i; ?>)">Copy</div>
                        <h2><?php echo $i; ?> - <?php echo $nombre; ?></h2>
                        <p><b><?php echo $section["description"]; ?></b> <?php echo $xmlstr->summary; ?></p>
                        <p><b><?php echo $section["totalParameters"]; ?></b> <?php echo count($xmlstr->param); ?></p>
                        <?php $j = 0; ?>
                        <?php while ($j < $contador = count($xmlstr->param)) { ?>
                            <p><b><?php echo $section["parameters"]; ?> <?php echo $j + 1; ?>:</b> <?php echo $xmlstr->param[$j]; ?></p>
                        <?php $j++;
                        } ?>
                        <?php $programNames[$i - 1] = $atributo['name']; ?>
                        <p><b><?php echo $section["return"]; ?></b> <?php echo $xmlstr->returns; ?></p>
                    </div>
                <?php } ?>
                <?php $i++; ?>
            <?php } ?>
        </div>
        <script src="./js/jquery.min.js"></script>
        <script>
            function copyText(valor, clase) {
                var name = valor;
                navigator.clipboard.writeText(name);
                $('.' + clase).css("background-color", "green");
                $('.' + clase).text("Copied ✔");

                function ChangeColorOld() {
                    $('.' + clase).css("background-color", "white");
                    $('.' + clase).text("Copy");
                }
                setInterval(ChangeColorOld, 1000);
            }
        </script>
</body>

</html>