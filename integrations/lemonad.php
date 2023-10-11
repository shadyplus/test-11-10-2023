<!-- Name and Phone [BEGIN] -->
<?php
if (isset($_POST['name'])) setcookie('name', $_POST['name'], time() + 86400);
if (isset($_POST['phone'])) setcookie('phone', $_POST['phone'], time() + 86400);
?>
<!-- Name and Phone [END] -->

<!-- Integrations [BEGIN] -->
<?php
const WEBMASTER_TOKEN = 'cc802f29f3750bb427f7b31e896e6e2e';

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $args = array(
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'offerId' => $_POST['offer_id'],
        'domain' => "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
        'ip' => getUserIp(),
        'utm_campaign' => $_POST['utm_campaign'],
        'clickid' => $_POST['clickid'],
        'sub2l' => $_POST['sub2'],
    );

    $data = json_encode($args);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sendmelead.com/api/v3/lead/add',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'X-Token: ' . WEBMASTER_TOKEN,
        ),
    ));

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    setcookie('httpcode', $httpcode, time() + 86400);
    setcookie('response', $response, time() + 86400);
    
    header('Location: ./success_page/success.php');
}
?>
<!-- Integrations [END] -->