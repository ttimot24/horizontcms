<header>

	<div class="col-md-6 col-md-offset-3">
		<?php Website::require_theme_file("messages.php"); ?>
	</div>


	<section class="jumbotron rounded-0" style="<?= Website::$_HEADER_IMAGES->count()>0 ? "background-image:url(storage/images/header_images/".Website::$_HEADER_IMAGES->first()->image.");" : ""; ?> background-size:cover;text-align:center;padding:125px 0px 125px 0px;margin:0px;">
		<center>
		<div class="p-4" style="padding:10px 20px 10px 20px;width:450px;background-color:rgba(0,0,0,0.8);color:white;">
			<h2><?= Settings::get('site_name') ?></h2>
			<hr style="width:50%;">
			<h5><?= Website::$_SETTINGS->slogan; ?></h5>
		</div>
		</center>
	</section>
</header>

<?php Website::require_theme_file("sitelinks.php"); ?>

<section class="container pt-3">

	<div class="col-md-8 pt-4">
		<?php Website::handle_routing(); ?>
	</div>
	<div class="col-md-4">
		<?php Website::require_theme_file("sidebar.php"); ?>
	</div>

</section>