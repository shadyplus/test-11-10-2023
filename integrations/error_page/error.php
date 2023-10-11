<?php
// Multi Languages [BEGIN]
$file_translate = './languages/' . $_COOKIE['language'] . '.php';
if (file_exists($file_translate)) {
    require_once($file_translate);
} else {
    $file_translate = './languages/EN.php';
    require_once($file_translate);
}
// Multi Languages [END]
?>
<!DOCTYPE html>
<html lang="en" dir="<?= ($_COOKIE['language'] === 'AR') ? 'rtl' : 'ltr' ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $error_page_array['title']; ?></title>

    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="wrapper">
        <div id="content">
            <div class="mod error-page">
                <h1 class="error-page__title"><?= $error_page_array['text-1']; ?></h1>
                <p class="error-page__text"><?= $error_page_array['text-2']; ?></p>
                <div class="error-page_back_button">
                    <a onclick="javascript:history.back();"><?= $error_page_array['return']; ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Httpcode & Response [END] -->
    <?php
    function console_log($data)
    {
        if (is_array($data) || is_object($data)) {
            echo ("<script>console.log(json_encode($data));</script>");
        } else {
            echo ("<script>console.log(`$data`);</script>");
        }
    }
    console_log($_COOKIE['httpcode']);
    console_log($_COOKIE['response']);
    ?>
    <!-- Httpcode & Response [END] -->
</body>

</html>