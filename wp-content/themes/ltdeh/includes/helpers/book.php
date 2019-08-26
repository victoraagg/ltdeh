<?php

function ltdeh_get_all_books(){
    $all_books = array();
    $args = array (
        'post_type' => array('book'),
        'post_status' => array( 'publish' ),
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order'
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
            $_book_duration_desc = explode(':',$_book_hour);
            $initial_end_hour = $_book_duration_desc[0]+$_book_duration;
            if($initial_end_hour > 24){
                $initial_end_hour = 24;
            }
            $_end_hour = $initial_end_hour.':'.$_book_duration_desc[1].':'.$_book_duration_desc[2];
            $book = [
                'title' => $_book_site,
                'start' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_book_hour,
                'end' => $_book_year.'-'.$_book_month.'-'.$_book_day.'T'.$_end_hour
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

    $newStart = new DateTime(date('Y').'-'.$dateTime['month'].'-'.$dateTime['day'].'T'.$dateTime['start_time']);
    $bookEnd = explode(':',$dateTime['start_time']);
    $_end_hour = $bookEnd[0]+$dateTime['duration'].':'.$bookEnd[1].':'.$bookEnd[2];
    $newEnd = new DateTime(date('Y').'-'.$dateTime['month'].'-'.$dateTime['day'].'T'.$_end_hour);

    foreach ($prev_books as $prev_book) {
        $oldStart = new DateTime($prev_book['start']);
        $oldEnd = new DateTime($prev_book['end']);
        $calendarBook = $prev_book['title'];
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