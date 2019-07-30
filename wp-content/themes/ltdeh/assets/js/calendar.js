// Selected time should not be less than current time
function AdjustMinTime(ct) {
	var dtob = new Date(),
  		current_date = dtob.getDate(),
  		current_month = dtob.getMonth() + 1,
  		current_year = dtob.getFullYear();
  			
	var full_date = current_year + '-' + ( current_month < 10 ? '0' + current_month : current_month ) + '-' +  ( current_date < 10 ? '0' + current_date : current_date );

	if(ct.dateFormat('Y-m-d') == full_date){
		this.setOptions({ minTime: 0 });
	} else {
		this.setOptions({ minTime: false });
	}
}

jQuery("#book-success").hide();
jQuery("#book-error").hide();
jQuery("#aditional-info").hide();

// DateTimePicker plugin: http://xdsoft.net/jqplugins/datetimepicker/
jQuery("#event-start-time").datetimepicker({ 
	lazyInit: true,
	format: 'Y-m-d H:i', 
	minDate: 0, 
	minTime: '08:00', 
	maxTime: '23:00', 
	step: 30, 
	dayOfWeekStart: 1,
	lang: 'es',
	onShow: AdjustMinTime, 
	onSelectDate: AdjustMinTime 
});

jQuery("#event-calendar").on('change', function(e) {
	switch (jQuery(this).val()) {
		// Pabellón Multiusos
		case 'dq4085nmcb9svmd9pnkd9hb3g8@group.calendar.google.com':
			jQuery("#aditional-info").hide();
			break;
		// Claustro "El Convento"
		case '7g63qi1hldp6ci6986olel5ijs@group.calendar.google.com':
			jQuery("#aditional-info").show();
			break;
		// Salón de Actos "El Convento"
		case 'hm8m3t1o667so9loes15kfb42o@group.calendar.google.com':
			jQuery("#aditional-info").show();
			break;
		// Pabellón Polideportivo
		case 'l559o05ppas8815rp3dv94m6co@group.calendar.google.com':
			jQuery("#aditional-info").hide();
			break;
		// Pista Pádel
		case 'gh6rh0jhfdc6mgj42occ5qctr4@group.calendar.google.com':
			jQuery("#aditional-info").hide();
			break;
		// Casa de la Juventud
		case '0t3vd0rve6ec4cipcdqka6dd9k@group.calendar.google.com':
			jQuery("#aditional-info").show();
			break;
		// Hogar del Jubilado
		case 'hcq4uc70s28gu6j4kpcab1l7ds@group.calendar.google.com':
			jQuery("#aditional-info").show();
			break;
		// Hogar del Jubilado - Aula de informática
		case '7p9lca7q3rsavhqdal1ftd0dn0@group.calendar.google.com':
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
	if(!blank_reg_exp.test(jQuery("#event-calendar").val())) { error = 1; }
	if(!blank_reg_exp.test(jQuery("#event-start-time").val())) { error = 1; }		
	if(error == 1){ return false; }

    // Cast end time
    var dateTime = jQuery("#event-start-time").val().split(' ');
    var time = dateTime[1];
    var hour = time.split(':');
    var endHour = parseInt(hour[0]) + parseInt(jQuery("#event-duration").val());
    var finalHour = dateTime[0] + ' ' + endHour + ':' + hour[1];

	// Event details
	parameters = { 	
		title: jQuery("#event-title").val(), 
		mail: jQuery("#event-mail").val(), 
		phone: jQuery("#event-phone").val(), 
		dni: jQuery("#event-dni").val(), 
		representation: jQuery("#event-representation").val(), 
		activity: jQuery("#event-activity").val(), 
		event_time: {
			start_time: jQuery("#event-start-time").val().replace(' ', 'T') + ':00',
			end_time: finalHour.replace(' ', 'T') + ':00',
		},
		calendar: jQuery("#event-calendar").val(), 
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
        }
    });
    
});