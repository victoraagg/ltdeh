<?php
$capi = new GoogleCalendarApi();
$valid_token = true;
//$login_url = 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode('https://www.googleapis.com/auth/calendar').'&redirect_uri='.urlencode(CLIENT_REDIRECT_URL).'&response_type=code&client_id='.CLIENT_ID.'&access_type=online';

try {
    //$calendars = $capi->GetCalendarsList(ACCESS_TOKEN);
    $calendars = array(
        array(
            'id' => 'latorredeestebanhambran@gmail.com',
            'summary' => 'latorredeestebanhambran@gmail.com'
        ),
        array(
            'id' => 'dq4085nmcb9svmd9pnkd9hb3g8@group.calendar.google.com',
            'summary' => 'Pabellón Multiusos'
        ),
        array(
            'id' => '7g63qi1hldp6ci6986olel5ijs@group.calendar.google.com',
            'summary' => 'Claustro "El Convento"'
        ),
        array(
            'id' => 'hm8m3t1o667so9loes15kfb42o@group.calendar.google.com',
            'summary' => 'Salón de Actos "El Convento"'
        ),
        array(
            'id' => 'l559o05ppas8815rp3dv94m6co@group.calendar.google.com',
            'summary' => 'Pabellón Polideportivo'
        ),
        array(
            'id' => 'gh6rh0jhfdc6mgj42occ5qctr4@group.calendar.google.com',
            'summary' => 'Pista Pádel'
        ),
        array(
            'id' => '0t3vd0rve6ec4cipcdqka6dd9k@group.calendar.google.com',
            'summary' => 'Casa de la Juventud'
        ),
        array(
            'id' => 'hcq4uc70s28gu6j4kpcab1l7ds@group.calendar.google.com',
            'summary' => 'Hogar del Jubilado'
        ),
        array(
            'id' => '7p9lca7q3rsavhqdal1ftd0dn0@group.calendar.google.com',
            'summary' => 'Hogar del Jubilado - Aula de informática'
        )
    );
} catch (\Throwable $th) {
    $valid_token = false;
    //echo '<a class="dx-btn dx-btn-lg mb-50" href="'.$login_url.'">Solicitar código de autorización</a>';
    //echo '<div class="dx-separator mb-50"></div>';
}
?>
<div class="col-xl-12" id="form-container">

    <header class="mb-50">
        <a class="dx-btn" href="<?= get_permalink(96); ?>">Volver al calendario</a>
    </header>

    <?php if($valid_token == true): ?>
        <h1>Solicitar reserva de espacio</h1>
        <div class="alert alert-success" id="book-success"></div>
        <div class="alert alert-danger" id="book-error"></div>
        <form id="form-book">
            <div class="dx-box-content">
                <div class="dx-form-group">
                    <input class="form-control form-control-style-2" type="text" id="event-title" placeholder="Nombre" />
                </div>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-box-content">
                <div class="dx-form-group">
                    <input class="form-control form-control-style-2" type="email" id="event-mail" placeholder="Email" />
                </div>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-box-content">
                <div class="dx-form-group">
                    <input class="form-control form-control-style-2" type="tel" id="event-phone" placeholder="Teléfono" />
                </div>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-box-content">
                <div class="dx-form-group">
                    <input class="form-control form-control-style-2" type="text" id="event-start-time" placeholder="Horario" autocomplete="off" />
                </div>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-box-content">
                <div class="dx-form-group">
                    <select id="event-duration" autocomplete="off">
                        <option value="1">1 hora</option>
                        <option value="2">2 horas</option>
                        <option value="3">3 horas</option>
                        <option value="4">4 hora</option>
                        <option value="5">5 horas</option>
                        <option value="10">10 horas</option>
                        <option value="24">24 horas</option>
                    </select>
                </div>
            </div>
            <div class="dx-separator"></div>
            <div class="dx-box-content">
                <div class="dx-form-group">
                <select id="event-calendar" autocomplete="off">
                    <?php foreach ($calendars as $value) {
                        if($value['id']!='latorredeestebanhambran@gmail.com'){
                            echo '<option value="'.$value['id'].'">'.$value['summary'].'</option>';
                        }
                    } ?>
                </select>
                </div>
            </div>
            <div class="dx-box-content pt-0" id="aditional-info">
                <p>Información adicional</p>
                <div class="dx-form-group">
                    <input class="form-control form-control-style-2" type="text" id="event-dni" placeholder="D.N.I." />
                </div>
                <div class="dx-form-group mt-20">
                    <input class="form-control form-control-style-2" type="text" id="event-representation" placeholder="En representación de:" />
                </div>
                <div class="dx-form-group mt-20">
                    <input class="form-control form-control-style-2" type="text" id="event-activity" placeholder="Actividad" />
                </div>
            </div>
            <a href="#" class="dx-btn dx-btn-lg" id="create-event">Solicitar reserva</a>
        </form>
    <?php endif; ?>

</div>