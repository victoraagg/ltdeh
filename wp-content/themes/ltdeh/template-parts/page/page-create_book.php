<div class="col-xl-12" id="form-container">

    <header class="mb-50">
        <a class="dx-btn" href="<?= get_permalink(96); ?>">Volver al calendario</a>
    </header>

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
                <select required id="event-day">
                    <option value="">Día</option>
                    <?php for ($i=1; $i <= 31; $i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
                </select>
                <select required id="event-month">
                    <option value="">Mes</option>
                    <?php for ($m = date('n'); $m <= date('n')+2; $m++) { 
                        echo '<option value="'.$m.'">'.ltdeh_replace_name_months($m).'</option>'; 
                    } ?>
                </select>
                <select required id="event-start-time">
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
                <select required id="event-duration">
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
            <select required id="event-calendar">
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

</div>