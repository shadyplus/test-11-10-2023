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
    <!-- FB Pixel [BEGIN] -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', './fbevents.js');
        fbq('init', '<?= $_COOKIE["pixel"] ?>');
        fbq('track', 'Lead');
        fbq('track', 'Purchase');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $_COOKIE['pixel'] ?>&ev=Lead&noscript=1" />
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $_COOKIE['pixel'] ?>&ev=Purchase&noscript=1" />
    </noscript>
    <!-- FB Pixel [END] -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $thanks_page_array['title']; ?></title>

    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="wrapper">
        <div id="content">
            <div class="mod success-page">
                <h1 class="success-page__title"><?= $thanks_page_array['text-1']; ?></h1>
                <div class="success_icon">
                    <p>&#10003;</p>
                </div>
                <h1><?= $thanks_page_array['text-2']; ?></h1>
                <p><?= $thanks_page_array['text-3']; ?></p>
                <div class="list-info">
                    <ul class="list-info__list">
                        <li class="list-info__item">
                            <span class="list-info__text"><?= $thanks_page_array['name']; ?></span>
                            <span class="list-info__info">
                                <?php echo $_COOKIE['name'] ?>
                            </span>
                        </li>
                        <li class="list-info__item">
                            <span class="list-info__text"><?= $thanks_page_array['phone']; ?></span>
                            <span class="list-info__info">
                                <?php echo $_COOKIE['phone'] ?>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="success-page_back_button">
                    <a onclick="javascript:history.back();"><?= $thanks_page_array['return']; ?></a>
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