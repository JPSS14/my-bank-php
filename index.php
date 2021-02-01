<?php
ob_start();
define("BASE", "https://localhost/my-bank-php/");
define("THEME", "myBank");
define("THEME_PATH", __DIR__ . "/Themes/" . THEME);
define("THEME_LINK", BASE . "Themes/" . THEME);

$configBase = BASE;
$configUrl = explode("/", strip_tags(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$configUrl[0] = (!empty($configUrl[0]) ? $configUrl[0] : "index");
$configThemePath = THEME_PATH;
$configThemeLink = THEME_LINK;
$configSiteName = "mybank";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $configBase; ?>Assets/Styles/fonticon.css">
    <link rel="stylesheet" href="<?= $configBase; ?>Assets/Styles/boot.css">
    <link rel="stylesheet" href="<?= $configThemeLink . "/style.css" ?>">
    <title>MyBank</title>
</head>

<body>
    <main class="main">
        <?php
        //SEARCH
        $searchForm = strip_tags(trim(filter_input(INPUT_POST, "s", FILTER_DEFAULT)));
        if (!empty($searchForm)) {
            header("Location: {$configBase}/pesquisa/{$searchForm}");
            exit;
        }
        //HEADER
        require($configThemePath . "/header.php");
        if (file_exists("{$configThemePath}/{$configUrl[0]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}.php")) {
            //theme root
            require "{$configThemePath}/{$configUrl[0]}.php";
        } elseif (!empty($configUrl[1]) && file_exists("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php")) {
            require "{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php";
        } else {
            //error 404
            if (file_exists("{$configThemePath}/404.php") && !is_dir("{$configThemePath}/404.php")) {
                require "{$configThemePath}/404.php";
                 var_dump($configThemePath . "/" . $configUrl[0]);
            } else {
                echo "<div class='container'>Oppps</div>";
            }
        }
        //FOOTER
        // require($configThemePath . "/footer.php");

        ?>
    </main>

    <script src="<?= $configBase; ?>/Assets/Styles/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?= $configBase; ?>/Assets/Styles/main.js" type="text/javascript"></script>
</body>

</html>
<?php
ob_end_flush();
?>