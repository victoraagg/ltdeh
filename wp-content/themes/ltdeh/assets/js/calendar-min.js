document.addEventListener("DOMContentLoaded",function(){var e=document.getElementById("calendar"),a=new FullCalendar.Calendar(e,{header:{left:"",center:"title",right:"prev,next"},plugins:["dayGrid","interaction"],eventClick:function(e,a,n){var i=e.event._def.title.split(" | ");Swal.fire(i[0]+" - "+e.event._def.publicId,i[1],"info")},events:wp_ajax_calendar.all_books});a.setOption("locale","es"),a.setOption("firstDay",1),a.render()}),jQuery("#book-success").hide(),jQuery("#book-error").hide(),jQuery("#aditional-info").hide(),jQuery("#event-calendar").on("change",function(e){switch(jQuery(this).val()){case"Pabellón Multiusos":jQuery("#aditional-info").hide();break;case"Claustro - El Convento":case"Salón de Actos - El Convento":jQuery("#aditional-info").show();break;case"Pabellón Polideportivo":jQuery("#aditional-info").hide();break;case"Casa de la Juventud":jQuery("#aditional-info").show();break;case"Pista Pádel 1":case"Pista Pádel 2":jQuery("#aditional-info").hide();break;case"Hogar del Jubilado":case"Hogar del Jubilado - Aula de informática":jQuery("#aditional-info").show()}});