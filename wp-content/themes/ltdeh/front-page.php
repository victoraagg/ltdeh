<?php
get_header();
?>

<div class="dx-main">

	<header class="dx-header dx-box-4">
		<div class="bg-image bg-image-parallax">
			<img src="<?= get_template_directory_uri(); ?>/assets/images/bg-home.jpg" class="jarallax-img" alt="">
			<div style="background-color: rgba(27, 27, 27, .50);"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9 col-xl-9">
					<h1 class="display-3 text-white t-600">Ayuntamiento de La Torre de Esteban Hambrán</h1>
					<p class="lead text-1">Información local acerca del coronavirus (CoVid-19)</p>
					<a href="<?= get_tag_link(25); ?>" class="dx-btn dx-btn-lg text-center">Más información</a>
				</div>
			</div>
		</div>
	</header>

	<div class="row no-gutters">
		<div class="container">
			<div class="mt-50 col-sm-12 mb-50 text-center">
				<p class="h3">Buscador</p>
				<?php get_search_form(); ?>
				<div class="mt-50">
					<h3>Información importante</h3>
					<p>En virtud de la Disposición adicional tercera del Real Decreto 463/2020, de 14 de marzo, por el que se declara el estado de alarma para la gestión de la situación de crisis sanitaria ocasionada por el COVID-19, se establece la suspensión e interrupción de los plazos para la tramitación de los procedimientos de las entidades del sector público. Esta medida se aplica a todo el sector público definido en la LPAC, que según su artículo 2 comprende a la Administración General del Estado, las Administraciones de las Comunidades Autónomas y las Entidades que integran las Administraciones Locales.</p>
					<p>El mismo Real Decreto establece que la duración de esta situación excepcional tendrá un plazo máximo de quince días, si bien el artículo sexto de la Ley Orgánica 4/1981, de 1 de junio, de los estados de alarma, excepción y sitio, habilita su prórroga siempre que la misma sea aprobada por el Congreso de los Diputados.</p>
					<p>Solamente se reanuda el cómputo de los plazos una vez que el Real Decreto pierda su vigencia o la pierdan las prórrogas que se realicen sobre el mismo.</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="dx-box-1 bg-grey-6">
		<div class="container">
			<div class="row vertical-gap">
				<div class="col-sm-6 col-lg-4 text-center">
					<p class="h5">¿Conoces nuestra Sede Electrónica?</p>
					<p>Dentro podrás realizar todos los trámites administrativos del Ayuntamiento sin necesidad de desplazarte. Además, te llegarán todas las notificaciones directamente a tu perfil.</p>
					<a href="https://latorredestebanhambran.sedelectronica.es/" target="_blank" class="dx-btn dx-btn-lg text-center">Acceder</a>
					<div class="divider"></div>
					<small><a target="_blank" href="https://www.sede.fnmt.gob.es/certificados/persona-fisica/obtener-certificado-software">¿Cómo obtener mi Certificado Digital?</a></small>
					<div class="divider mb-50"></div>
					<p class="h5">Cita previa SESCAM</p>
					<p>Solicita cita previa en el consultorio médico de nuestra localidad</p>
					<img class="img-fluid" src="<?= get_template_directory_uri(); ?>/assets/images/sescam.png" alt="">
					<a href="https://sescam.jccm.es/csalud/citas/inicioCita.jsf" target="_blank" class="mt-30 dx-btn dx-btn-lg text-center">Solicitar cita previa</a>
					<div class="divider mb-50"></div>
					<p class="h5">OAPGT - Organismo Autónomo Provincial de Gestión Tributaria de Toledo</p>
					<img class="img-fluid mt-10" src="<?= get_template_directory_uri(); ?>/assets/images/oapgt.png" alt="">
					<div class="divider mb-30"></div>
					<a href="https://sede.oapgt.es/Paginas/inicio.aspx" target="_blank" class="dx-btn dx-btn-lg text-center">Acceder</a>
				</div>
				<div class="col-sm-6 col-lg-8">
					<?php get_template_part('template-parts/post/featured',''); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row no-gutters">
		<div class="col-lg-6 bg-secondary-color-2">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10">
					<div class="container">
						<div class="dx-box-1">
							<h2>Documentación y descargas</h2>
							<p>Accede rápidamente a todos los documentos necesarios para realizar diferentes solicitudes en el Ayuntamiento</p>
							<a href="<?= get_post_type_archive_link('document'); ?>" class="dx-btn dx-btn-lg">Acceder</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 bg-main-1">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10">
					<div class="container">
						<div class="dx-box-1">
							<h2 class="text-white">Reserva de espacios</h2>
							<p class="text-white">Consulta la disponibilidad de las instalaciones municipales y realiza reservas pagando directamente desde la web</p>
							<a href="<?= ltdeh_get_permalink('calendario'); ?>" class="dx-btn dx-btn-lg dx-btn-transparent">Acceder</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?php
get_footer();