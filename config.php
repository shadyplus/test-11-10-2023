<?php

define('LANDING_DIR', '');

$apiKey = 'dabalC6BmXnEZj9D8BBNtHM6n3MCf8XamMCc0Rv7cToFq';          // Ключ доступа к API
$offer_id = 9790;         // для каждого оффера свой айди, надо уточнять его в админке или у суппортов
$stream_hid = '5pyta3eN';     // id потока

$landKey = '1fcd8516f55c183e796ac305514c8d34';

$default_main_site = 'http://api.cpa.tl';
//$default_main_site = 'http://api.tradeblg.ru';
$apiSendLeadUrl = 'http://api.cpa.tl/api/lead/send_archive';
//$apiSendLeadUrl = 'http://api.tradeblg.ru/api/lead/send_archive';
$apiGetLeadUrl = 'http://api.cpa.tl/api/lead/feed';
//$apiGetLeadUrl = 'http://api.tradeblg.ru/api/lead/feed';

$dataOffers = '{"9790":{"id":9790,"name":"Cordis ","country":{"code":"DZ","name":"\u0415\u0433\u0438\u043f\u0435\u0442"},"price":"649","price2":"1298","currency":{"code":"DA","name":"\u0627\u0644\u062c\u0646\u064a\u0647 \u0627\u0644\u0645\u0635\u0631\u0649"}}}';
$dataOffer = '{"id":9790,"name":"Cordis ","country":{"code":"DZ","name":"\u0415\u0433\u0438\u043f\u0435\u0442"},"price":"649","price2":"1298","currency":{"code":"DA","name":"\u0627\u0644\u062c\u0646\u064a\u0647 \u0627\u0644\u0645\u0635\u0631\u0649"}}';
$is_geo_detect = '';
$productName = 'Cordis';
$invoice = 'index.php';
$language = 'ar';
$push_link = '';
$fb_verification = '';
$showcase_url = '';

$keitaro_postback = 'http://217.25.93.249/4c53d67/postback';

$companyInfo = array('address' => '630005, Новосибирская обл., г. Новосибирск, ул. Семьи Шамшиных, д. 85, кв. 9', 'detail' => 'ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ИНТЕР-ТРЕЙД" ОГРН: 1175476059241 ИНН: 5406976113 КПП: 540601001');
$companyInfoEN = array('address' => '129090, Moscow, pereulok Zhivarev, house 8, stroenie 3, flat 16 email: ostrov.prodazh@mail.com Skype: ostrov.prodazh@mail.com', 'detail' => 'OOO "OSTROV PRODAZH" OGRN: 1197746695530 VAT: 7708365555');

$_debug = False; // установите True для вывода дополнительной информации для отладки и поиска ошибок
$pixels = [
    'fb_pixel', 'fb_verify', 'google_pixel', 'google_adw_pixel', 'tiktok_pixel', 'topmail_pixel', 'vk_pixel', 'yandex_metrika'
];

if(!$apiKey){
    echo 'Ключ доступа к API не определен. Получите в личном кабинете или обратитесь в службу поддержки';
    die;
}

if(!$offer_id){
    echo 'ID оффера не определен';
    die;
}

/**
 * Конверсионные элементы для лендинга.
 *
 * Для подключения конверсионного элемента его необходимо внести в массив $plugins. Где ключ - название конверсионного
 * элемента, а значение массив с необходимыми параметрами, если параметры не нужны - пустой массив.
 *
 * Пример:
 * $plugins = [
 *      'online_visitors_top' => [],
 *      'delivery' => [],
 *      'promocode' => ['promocode' => 'super'],
 *      'popup' => ['timeout' => 15],
 * ];
 *
 * Для активации элемента раскомментируйте строку в массиве $plugins, который объявлен ниже.
 * Параметры установлены по умолчанию.
 */

$plugins = [
#    'corona_delivery_top' => [],
#    'corona_delivery_eng_top' => [],
#    'online_visitors_top' => [],
#    'quick_order' => [],
#    'promocode' => ['promocode' => 'sale'],
#    'online_visitors' => [],
#    'made_order' => [],
#    'delivery' => [],
#    'freeze_price' => [],
#    'recall' => ['timeout' => 10],
#    'popup' => ['timeout' => 20],
#    'sale_11_ru_top' => [],
];

/**
 * Из элементов 'corona_delivery_top', 'corona_delivery_eng_top', 'online_visitors_top' одновременно можно
 * выбрать только один. То же самое с элементами 'quick_order', 'promocode'.
 *
 * Элементы у которых доступны все языки, язык зависит от значения переменной $language.
 *
 *
 * Описание конверсионных элементов:
 *
 * 'corona_delivery_top' - Бесконтактное вручение (в условиях вируса).
 * Сверху лендинга отображается информация о бесконтактной доставке. Все языки.
 *
 * 'corona_delivery_eng_top' - Бесконтактное вручение (в условиях вируса).
 * Сверху лендинга отображается информация о бесконтактной доставке на английском. Только английский язык.
 *
 * 'online_visitors_top' - Плашка в шапке "посетители онлайн".
 * Сверху лендинга отображаются показатели продаж и посетителей за день. Все языки.
 *
 * 'quick_order' - Форма быстрого заказа. Закрепленная внизу экрана строка для быстрого заказа. Все языки.
 *
 * 'promocode' - Промо-код. Форма для ввода промокода для получения скидки. Все языки.
 * Необходимо указать значение промокода. Пример: 'promocode' => ['promocode' => 'super']
 *
 * 'online_visitors' - Поплавок "просматривают сейчас сайт".
 * Окошко сбоку с показателями, сколько посетителей сейчас на сайте. Все языки.
 *
 * 'made_order' - Поплавок сделавших заказ справа. Всплывающее каждые 30 секунд окошко о клиентах, оформивших заказ.
 * Только русский язык.
 *
 * 'delivery' - Информация о доставке. Всплывающая плашка с информацией о доставке по ГЕО клиента. Все языки.
 *
 * 'freeze_price' - Мы заморозили цену. Закрепленное справа окошко с "замороженным" курсом доллара. Только русский язык.
 *
 * 'recall' - Кнопка "Перезвоните мне". Через заданное время внизу лендинга появляется кнопка "Перезвонить". Все языки.
 * Необходимо указать время в секундах. Пример: 'recall' => ['timeout' => 10]
 *
 * 'popup' - Попап после открытия ленда в секундах. Через заданное время появляется попап с формой заказа. Все языки.
 * Необходимо указат время в секундах. Пример: 'popup' => ['timeout' => 20]
 *
 * 'sale_11_ru_top' - Вверху лендинга появляется баннер 'Всемирный День Шопинга'. Только русский язык.
 *
 */
