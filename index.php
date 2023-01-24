<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Json Decode -->
    <?php
    $json = file_get_contents("config.json");
    $configJson = json_decode($json,true);
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $configJson["title"];?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="<?php echo $configJson["logopath"];?>" type="image/x-icon">
</head>
<body>
    
    <!-- Navbar -->
    <div class="navbar-container">
        <div class="navbar-logo">
            <h1><?php echo $configJson["h1title"]; ?></h1>
        </div>
        <div class="navbar-links">
            <?php $links = $configJson['links'];?>
            <?php foreach($links as $link){?>
                <a href="./index.php"><?php echo $link["documentation"];?></a>
                <a href="./summary.php"><?php echo $link["summary"];?></a>
            <?php }?>
        </div>
        <div class="navbar-found">
            
        </div>
    </div>
    <div class="content">
        <div class="documentation-content">
        <div class="logo-content">
            <img src="<?php echo $configJson["imglogoprincipal"];?>" alt="">
        </div>
            <h2><?php echo $configJson["subtitle1"];?></h2>
            <p><?php echo $configJson["documentation1"];?></p>
            <h2><?php echo $configJson["subtitle2"];?></h2>
            <p><?php echo $configJson["documentation2"];?></p>
        </div>
    </div>
</body>
</html>