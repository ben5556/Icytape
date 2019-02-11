<?php


function dynamic_styles(){

	$primary_color = (theme('default_color')) ? theme('default_color') : '#EE222E'; ?>

	<style type="text/css">

		.primary_color_background { background:<?= $primary_color ?>; }
		.primary_color { color:<?= $primary_color; ?>; }

		.secondary_color_background { background:<?= $primary_color; ?>; }
		.secondary_color { color:<?= $primary_color; ?>; }

	</style>

<?php } ?>