<div class="col-xl-12" id="form-container">

    <header class="mb-50">
        <a class="dx-btn" href="<?= ltdeh_get_permalink('calendario'); ?>">Volver al calendario</a>
    </header>

    <h1>Solicitar reserva de espacio</h1>
    <?php 
        if( isset($_GET['error-book']) ): 
            switch ($_GET['error-book']) {
                case 'availability':
                    echo '<div class="alert dx-alert dx-alert-danger" role="alert">No hay disponibilidad en esa fecha</div>';
                    break;
                case 'data':
                    echo '<div class="alert dx-alert dx-alert-danger" role="alert">Error en los datos enviados</div>';
                    break;
            }
        endif;
    ?>
    <div class="alert alert-success" id="book-success"></div>
    <div class="alert alert-danger" id="book-error"></div>
    <form id="form-book" action="" method="POST">
        <div class="dx-box-content">
            <div class="dx-form-group">
                <input class="form-control form-control-style-2" name="book-name" type="text" id="event-title" placeholder="Nombre" />
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <input required class="form-control form-control-style-2" name="book-mail" type="email" id="event-mail" placeholder="Email" />
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <input class="form-control form-control-style-2" name="book-phone" type="tel" id="event-phone" placeholder="Teléfono" />
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <select required id="event-day" name="book-day">
                    <option value="">Día</option>
                    <?php for ($i=1; $i <= 31; $i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
                </select>
                <select required id="event-month" name="book-month">
                    <option value="">Mes</option>
                    <option value="<?= date("n",strtotime("+1 Months")); ?>"><?= ltdeh_replace_name_months(date("n",strtotime("+1 Months"))); ?></option>
                    <option value="<?= date("n",strtotime("+2 Months")); ?>"><?= ltdeh_replace_name_months(date("n",strtotime("+2 Months"))); ?></option>
                </select>
                <select required id="event-start-time" name="book-start">
                    <option value="">Hora inicio</option>
                    <?php 
                    date_default_timezone_set("Europe/Madrid");
                    $range = range( strtotime("08:00"), strtotime("23:00"), 30*60 );
                    foreach($range as $time){ echo '<option value="'.date("H:i:s",$time).'">'.date("H:i",$time).'</option>'; }
                    ?>
                </select>
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
                <select required id="event-duration" name="book-duration">
                    <option value="">Duración</option>
                    <option value="1">1 hora</option>
                    <option value="1:30">1:30 horas</option>
                    <option value="2">2 horas</option>
                    <option value="3">3 horas</option>
                    <option value="4">4 horas</option>
                    <option value="5">5 horas</option>
                    <option value="24">Día completo</option>
                </select>
            </div>
        </div>
        <div class="dx-separator"></div>
        <div class="dx-box-content">
            <div class="dx-form-group">
            <select required id="event-calendar" name="book-calendar">
                <option value="">Instalación</option>
                <?php foreach (get_all_spaces() as $value) {
                    echo '<option value="'.$value.'">'.$value.'</option>';
                } ?>
            </select>
            </div>
        </div>
        <div class="dx-box-content pt-0" id="aditional-info">
            <p>Información adicional</p>
            <div class="dx-form-group">
                <input class="form-control form-control-style-2" name="book-dni" type="text" id="event-dni" placeholder="D.N.I." />
            </div>
            <div class="dx-form-group mt-20">
                <input class="form-control form-control-style-2" name="book-representation" type="text" id="event-representation" placeholder="En representación de:" />
            </div>
            <div class="dx-form-group mt-20">
                <input class="form-control form-control-style-2" name="book-activity" type="text" id="event-activity" placeholder="Actividad" />
            </div>
        </div>
        <?php wp_nonce_field( 'noncename_book', 'book-request'); ?>
        <input class="dx-btn dx-btn-lg" id="create-event" type="submit" value="Solicitar reserva" />
    </form>

</div>