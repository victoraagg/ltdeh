<?php

$capi = new GoogleCalendarApi();
//$login_url = 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode('https://www.googleapis.com/auth/calendar').'&redirect_uri='.urlencode(CLIENT_REDIRECT_URL).'&response_type=code&client_id='.CLIENT_ID.'&access_type=online';
$login_url = get_permalink(120);

$string_params = '';
$params['src1'] = 'src=Z2g2cmgwamhmZGM2bWdqNDJvY2M1cWN0cjRAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ';
$params['src2'] = 'src=bDU1OW8wNXBwYXM4ODE1cnAzZHY5NG02Y29AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ';
$params['src3'] = 'src=MHQzdmQwcnZlNmVjNGNpcGNkcWthNmRkOWtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ';
$params['src4'] = 'src=N2c2M3FpMWhsZHA2Y2k2OTg2b2xlbDVpanNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ';
$params['src5'] = 'src=ZHE0MDg1bm1jYjlzdm1kOXBua2Q5aGIzZzhAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ';
$params['title'] = 'title=Reserva%20de%20Espacios';
$params['zone'] = 'ctz=Europe%2FMadrid';
$params['bgcolor'] = 'bgcolor=%23ffffff';
$params['color1'] = 'color=%23F09300';
$params['color2'] = 'color=%239E69AF';
$params['height'] = 'height=600';
$params['wkst'] = 'wkst=2';
$params['print'] = 'showPrint=0';
$params['tz'] = 'showTz=0';
$params['tabs'] = 'showTabs=0';    
foreach ($params as $key => $param) {
    $string_params .= $param.'&amp;';
}

?>
<div class="col-xl-11 bg-white pb-30">
    <header class="mb-50">
        <a class="dx-btn" href="<?= $login_url; ?>">Solicitar reserva</a>
    </header>
    <div class="dx-box-decorated">
        <iframe src="https://calendar.google.com/calendar/embed?<?= $string_params ?>" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
</div>