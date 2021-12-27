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
        )
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
            $_book_recurrence = get_post_meta( get_the_ID(), '_book_recurrence', true );
            $_book_end_recurrence = get_post_meta( get_the_ID(), '_book_end_recurrence', true );
            $_book_days_recurrence = get_post_meta( get_the_ID(), '_book_days_recurrence', true );
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
                $_end_hour = $final_hour.':'.$final_mins.':00';
            }else{
                $final_hour = $_book_hour_desc[0]+$_book_duration;
                if($final_hour > 24){
                    $final_hour = 24;
                    $final_mins = '00';
                }else{
                    $final_mins = $_book_hour_desc[1];
                }
                $_end_hour = $final_hour.':'.$final_mins.':00';
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
            if($_book_recurrence == 'Y'){
                $days = explode(',',$_book_days_recurrence);
                $book = [
                    'ref' => get_the_ID(),
                    'title' => $_book_site.' | Horario: '.$_book_hour. ' - '.$_end_hour,
                    'id' => get_the_title(),
                    'color' => $color,
                    'daysOfWeek' => $days,
                    'startRecur' => $_book_year.'-'.$_book_month.'-'.$_book_day,
                    'endRecur' => $_book_end_recurrence,
                    'startTime' => $_book_hour,
                    'endTime' => $_end_hour,
                    'start' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_book_hour,
                    'end' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_end_hour
                ];
            }else{
                $book = [
                    'ref' => get_the_ID(),
                    'title' => $_book_site.' | Horario: '.$_book_hour. ' - '.$_end_hour,
                    'id' => get_the_title(),
                    'color' => $color,
                    'start' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_book_hour,
                    'end' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_end_hour
                ];
            }
            array_push($all_books, $book);
        }
    }
    wp_reset_postdata();
    return $all_books;
}

function ltdeh_check_availability_book($dateTime, $calendar){

    $availability = true;

    $day = adjust_lenght_date($dateTime['day']); 
    $month = adjust_lenght_date($dateTime['month']); 

    $newStart = new DateTime(date('Y').'-'.$month.'-'.$day.'T'.$dateTime['start_time']);
    $duration = explode(':', $dateTime['duration']);
    if(!isset($duration[1])){
        $duration[1] = 0;
    }
    $newEnd = new DateTime(date('Y').'-'.$month.'-'.$day.'T'.$dateTime['start_time']);
    $newEnd = $newEnd->modify($duration[0].' hours '.$duration[1].' minutes');

    $prev_books = ltdeh_get_all_books();
    $prev_books = include_books_recurrent($prev_books);
    $prev_books = clean_books_different_today($prev_books, $newStart);
    
    //reference: https://codereview.stackexchange.com/questions/45784/test-2-time-ranges-to-see-if-they-overlap
    foreach ($prev_books as $prev_book) {
        $calendarBookFull = explode(' | ', $prev_book['title']);
        $oldStart = new DateTime($prev_book['start']);
        $oldEnd = new DateTime($prev_book['end']);
        $calendarBook = $calendarBookFull[0];
        if($calendar != $calendarBook){
            continue;
        }
        if( ($oldEnd <= $newStart) || ($newEnd <= $oldStart) ){
            //not overlap
            $availability = true;
        }else{
            //overlap
            $availability = false;
            break;
        }
    }

    return $availability;

}

function clean_books_different_today($books, $newStart){
    foreach($books as $key => $one) {
        $expire_dt = new DateTime($one['start']);
        $firstDate = $newStart->format('Y-m-d');
        $secondDate = $expire_dt->format('Y-m-d');
        if ($firstDate != $secondDate) { 
            unset($books[$key]);    
        }
    }
    return $books;
}

function include_books_recurrent($prev_books){
    foreach ($prev_books as $prev_book) {
        $post_id = $prev_book['ref'];
        $book_recurrence = get_post_meta( $post_id, '_book_recurrence', true );
        $book_days_recurrence = get_post_meta( $post_id, '_book_days_recurrence', true );
        if($book_recurrence == 'Y'){
            $days = explode(',', $book_days_recurrence);
            foreach ($days as $day) {
                $prevStart = new DateTime($prev_book['start']);
                $prevEnd = new DateTime($prev_book['end']);
                $a = 0;
                do {
                    $nameDay = strtolower(jddayofweek($day-1, 1));

                    $hourStart = $prevStart->format('H');
                    $minStart = $prevStart->format('i');
                    $prevStart->modify('next '.$nameDay);
                    $prevStart->setTime($hourStart, $minStart, 00);

                    $hourEnd = $prevEnd->format('H');
                    $minEnd = $prevEnd->format('i');
                    $prevEnd->modify('next '.$nameDay);
                    $prevEnd->setTime($hourEnd, $minEnd, 00);

                    $book = [
                        'title' => $prev_book['title'],
                        'start' => $prevStart->format('Y-m-d H:i:s'),
                        'end' => $prevEnd->format('Y-m-d H:i:s')
                    ];

                    $a++;
                    array_push($prev_books, $book);
                } while ($a <= 8);
            }
        }
    }
    return $prev_books;
}

function ltdeh_check_book_is_sunday($post_id){
    $post_day = get_post_meta( $post_id, '_book_day', true );
    $post_month = get_post_meta( $post_id, '_book_month', true );
    $post_year = get_post_meta( $post_id, '_book_year', true );
    $post_hour = get_post_meta( $post_id, '_book_hour', true );
    $hours = explode(':',$post_hour);
    $date = $post_year.'-'.$post_month.'-'.$post_day;
    $timestamp = strtotime($date);
    $weekday = date("l", $timestamp);
    $normalized_weekday = strtolower($weekday);
    if ($normalized_weekday == "sunday" && $hours[0] > '14') {
        return true;
    } else {
        return false;
    }
}

function ltdeh_clear_old_books(){
    $args = array(
        'fields' => 'ids',
        'post_type' => array( 'book' ),
        'posts_per_page' => '-1',
        'date_query' => array(
            'column' => 'post_date',
            'before' => '-4 months'
        )
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            wp_trash_post( get_the_ID() ); //use this function if you have custom post type
            //wp_delete_post(get_the_ID(), true); //use this function if you are working with default posts
        }    
    } else {
        return false;
    }
    die();
    wp_reset_postdata();
}
add_action('init', 'ltdeh_clear_old_books');

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
        //'Pabellón Polideportivo',
        //'Pabellón Multiusos',
        //'Claustro - El Convento',
        //'Salón de Actos - El Convento',
        //'Casa de la Juventud',
        //'Hogar del Jubilado',
        //'Hogar del Jubilado - Aula de informática'
    );
    return $sites;
}

function adjust_lenght_date($date){
    if(strlen($date)==1){ 
        $date = '0'.$date; 
    }
    return $date;
}