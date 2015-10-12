<?php
/*
Template Name: Logotype
*/
?>
<?php get_header(); ?>

	<style type="text/css">

	#logotype {
		margin: 10rem 0;
	}
	#header, #main-nav, #site-footer, #fixed-main-nav {
		display: none;
		visibility: hidden;
	}
	#logotype h1 {
		margin-bottom: 30px;
		margin-left: -16px;
		font-size: 9rem;
	}
	#logotype h2 {
		font-size: 5.9rem;
	}
	.logotype-inverse {
		background-color: #444;
		color: #fff;
		padding: 4rem 3rem 3rem 3rem;
		display: inline-block;
		border-radius: .25rem;
	}
	#logotype h3 {
		font-size: 4rem;
	}

	</style>

	<div id="logotype" class="text-center">

		<h1 class="dancing">Exeunt</h1>
		<h2 class="amatic">magazine</h2>

		<hr>

		<div class="logotype-inverse">
			<h1 class="dancing">Exeunt</h1>
			<h2 class="amatic">magazine</h2>
		</div>

		<hr>

		<h3 class="dancing">exeunt</h3>

	</div>

<?php get_footer(); ?>