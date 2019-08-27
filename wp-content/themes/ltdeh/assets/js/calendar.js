// https://fullcalendar.io/
document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		header: {
			left: '',
			center: 'title',
			right: 'prev,next'
		},
		plugins: [ 'dayGrid', 'interaction' ],
		eventClick: function(event, jsEvent, view) {
			var title_all = event.event._def.title;
			var title = title_all.split(' | ');
			//alert(title[0]);
			Swal.fire(
				title[0],
				title[1],
				'info'
			)
        },
		events: wp_ajax_calendar.all_books
		/*
		events: [
			{
			  	title: 'Event title',
				start: '2019-08-01T19:00:00',
				end: '2019-08-01T21:00:00'
			}
		]
		*/
	});
	calendar.setOption('locale', 'es');
	calendar.setOption('firstDay', 1);
	calendar.render();
});

jQuery("#book-success").hide();
jQuery("#book-error").hide();
jQuery("#aditional-info").hide();

jQuery("#event-calendar").on('change', function(e) {
	switch (jQuery(this).val()) {
		case 'Pabellón Multiusos':
			jQuery("#aditional-info").hide();
			break;
		case 'Claustro - El Convento':
			jQuery("#aditional-info").show();
			break;
		case 'Salón de Actos - El Convento':
			jQuery("#aditional-info").show();
			break;
		case 'Pabellón Polideportivo':
			jQuery("#aditional-info").hide();
			break;
		case 'Casa de la Juventud':
			jQuery("#aditional-info").show();
			break;
		case 'Pista Pádel 1':
			jQuery("#aditional-info").hide();
			break;
		case 'Pista Pádel 2':
			jQuery("#aditional-info").hide();
			break;
		case 'Hogar del Jubilado':
			jQuery("#aditional-info").show();
			break;
		case 'Hogar del Jubilado - Aula de informática':
			jQuery("#aditional-info").show();
			break;
	}
});

jQuery("#create-event").on('click', function(e) {

	e.preventDefault();

	var blank_reg_exp = /^([\s]{0,}[^\s]{1,}[\s]{0,}){1,}$/;
	var error = 0;
	var parameters;

	if(!blank_reg_exp.test(jQuery("#event-title").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-mail").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-phone").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-day").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-month").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-start-time").val())) { error = 1; }	
	if(!blank_reg_exp.test(jQuery("#event-duration").val())) { error = 1; }	
	if(!blank_reg_exp.test(jQuery("#event-calendar").val())) { error = 1; }
	if(error == 1){ return false; }

	// Event details
	parameters = { 	
		title: jQuery("#event-title").val(), 
		mail: jQuery("#event-mail").val(), 
		phone: jQuery("#event-phone").val(), 
		dni: jQuery("#event-dni").val(), 
		representation: jQuery("#event-representation").val(), 
		activity: jQuery("#event-activity").val(), 
		event_time: {
			day: jQuery("#event-day").val(),
			month: jQuery("#event-month").val(),
			start_time: jQuery("#event-start-time").val(),
			duration: jQuery("#event-duration").val()
		},
		calendar: jQuery("#event-calendar").val()
	};

	jQuery.ajax({
        type: 'POST',
        url: wp_ajax_calendar.ajaxurl,
        data: { 
			action: "create_book", 
			event_details: parameters 
		},
        dataType: 'json',
        success: function(response) {
			if(response.message == 'Error'){
				jQuery("#book-success").hide();
				jQuery("#book-error").hide();
				jQuery("#book-error").show().text('No hay disponibilidad en ese horario');
			}else{
				jQuery("#book-success").hide();
				jQuery("#book-error").hide();
				jQuery("#book-success").show().text('Reserva: ' + response.message + ' creada correctamente. Confirmaremos tu reserva en el email indicado.');
			}	
			document.getElementById("form-book").reset();
			window.scrollTo(0, 0);
        }
	});
    
});