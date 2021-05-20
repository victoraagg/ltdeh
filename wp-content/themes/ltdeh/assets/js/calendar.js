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
				title[0]+' - '+event.event._def.publicId,
				title[1],
				'info'
			)
        },
		events: wp_ajax_calendar.all_books
		/*
		events: [
			{
				title: 'Event title',
				id: '0123456789',
				start: '2019-08-01T19:00:00',
				end: '2019-08-01T21:00:00',
				color: '#048a90'
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