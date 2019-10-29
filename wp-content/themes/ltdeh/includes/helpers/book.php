<?php

function ltdeh_get_all_books(){
    $all_books = array();
    $args = array (
        'post_type' => array('book'),
        'post_status' => array( 'publish' ),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'meta_query' => array(
            array(
                'key' => '_book_active',
                'value' => 'Y',
                'compare' => 'LIKE',
            ),
        ),
    );
    $books = new WP_Query( $args );
    if ($books->have_posts()) {
        while ($books->have_posts()) {
            $books->the_post();
            $_book_day = get_post_meta( get_the_ID(), '_book_day', true );
            $_book_month = get_post_meta( get_the_ID(), '_book_month', true );
            $_book_year = get_post_meta( get_the_ID(), '_book_year', true );
            $_book_hour = get_post_meta( get_the_ID(), '_book_hour', true );
            $_book_duration = get_post_meta( get_the_ID(), '_book_duration', true );
            $_book_site = get_post_meta( get_the_ID(), '_book_site', true );
            $_book_hour_desc = explode(':',$_book_hour);
            if (strpos($_book_duration, ':') !== false) {
                $_book_duration_initial = explode(':',$_book_duration);
                $final_hour = $_book_hour_desc[0]+$_book_duration_initial[0];
                if($final_hour > 24){
                    $final_hour = 24;
                }
                $final_mins = $_book_hour_desc[1]+$_book_duration_initial[1];
                if($final_mins == 60){
                    $final_mins = '00';
                    $final_hour = $final_hour+1;
                    if($final_hour > 24){
                        $final_hour = 24;
                    }
                }
                $_end_hour = $final_hour.':'.$final_mins.':'.$_book_hour_desc[2];
            }else{
                $final_hour = $_book_hour_desc[0]+$_book_duration;
                if($final_hour > 24){
                    $final_hour = 24;
                    $final_mins = '00';
                }else{
                    $final_mins = $_book_hour_desc[1];
                }
                $_end_hour = $final_hour.':'.$final_mins.':'.$_book_hour_desc[2];
            }
            switch ($_book_site) {
                case 'Pista Pádel 1':
                case 'Pista Pádel 2':
                    $color = '#16732a';
                    break;
                case 'Pabellón Polideportivo':
                case 'Pabellón Multiusos':
                    $color = '#ecb725';
                    break;
                case 'Claustro - El Convento':
                case 'Salón de Actos - El Convento':
                    $color = '#13609f';
                    break;
                case 'Casa de la Juventud':
                    $color = '#8e1317';
                    break;
                case 'Hogar del Jubilado':
                case 'Hogar del Jubilado - Aula de informática':
                    $color = '#048a90';
                    break;
                default:
                    $color = '#13609f';
                    break;
            }
            $book = [
                'title' => $_book_site.' | Horario: '.$_book_hour. ' - '.$_end_hour,
                'id' => get_the_title(),
                'start' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_book_hour,
                'end' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_end_hour,
                'color' => $color
            ];
            array_push($all_books, $book);
        }
    }
    wp_reset_postdata();
    return $all_books;
}

function ltdeh_check_availability_book($dateTime, $calendar){

    $prev_books = ltdeh_get_all_books();
    $availability = true;

    if(strlen($dateTime['day'])==1){ $day = '0'.$dateTime['day']; }else{ $day = $dateTime['day']; }
    if(strlen($dateTime['month'])==1){ $month = '0'.$dateTime['month']; }else{ $month = $dateTime['month']; }

    $newStart = new DateTime(date('Y').'-'.$month.'-'.$day.'T'.$dateTime['start_time']);
    $bookEnd = explode(':',$dateTime['start_time']);

    if($bookEnd[0]+$dateTime['duration'] > 24){ $max_end_hour = 24; }else{ $max_end_hour = $bookEnd[0]+$dateTime['duration']; }

    $_end_hour = $max_end_hour.':'.$bookEnd[1].':'.$bookEnd[2];
    $newEnd = new DateTime(date('Y').'-'.$month.'-'.$day.'T'.$_end_hour);

    foreach ($prev_books as $prev_book) {
        $oldStart = new DateTime($prev_book['start']);
        $oldEnd = new DateTime($prev_book['end']);
        $calendarBookFull = explode(' | ', $prev_book['title']);
        $calendarBook = $calendarBookFull[0];
        if ($calendar == $calendarBook && $newStart < $oldStart && $newEnd > $oldStart && $newEnd <= $oldEnd) {
            $availability = false;
        }elseif ($calendar == $calendarBook && $newStart >= $oldStart && $newEnd <= $oldEnd) {
            $availability = false;
        }elseif ($calendar == $calendarBook && $newStart >= $oldStart && $newStart < $oldEnd && $newEnd > $oldEnd) {
            $availability = false;
        }elseif ($calendar == $calendarBook && $newStart < $oldStart && $newEnd > $oldEnd) {
            $availability = false;
        }
    }

    return $availability;

}

function ltdeh_replace_name_months($month){
    switch ($month) {
        case '01':
        case '1':
            return 'Enero';
            break;
        case '02':
        case '2':
            return 'Febrero';
            break;
        case '03':
        case '3':
            return 'Marzo';
            break;
        case '04':
        case '4':
            return 'Abril';
            break;
        case '05':
        case '5':
            return 'Mayo';
            break;
        case '06':
        case '6':
            return 'Junio';
            break;
        case '07':
        case '7':
            return 'Julio';
            break;
        case '08':
        case '8':
            return 'Agosto';
            break;
        case '09':
        case '9':
            return 'Septiembre';
            break;
        case '10':
            return 'Octubre';
            break;
        case '11':
            return 'Noviembre';
            break;
        case '12':
            return 'Diciembre';
            break;
    }
}

function get_all_spaces(){
    $sites = array(
        'Pista Pádel 1',
        'Pista Pádel 2',
        'Pabellón Polideportivo',
        'Pabellón Multiusos',
        'Claustro - El Convento',
        'Salón de Actos - El Convento',
        'Casa de la Juventud',
        'Hogar del Jubilado',
        'Hogar del Jubilado - Aula de informática'
    );
    return $sites;
}