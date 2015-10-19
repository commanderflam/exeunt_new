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
	#logotype h1.fat {
		font-size: 6rem;
		margin-left: 0;
	}
	#logotype h2 {
		font-size: 5.9rem;
	}
	#logotype h2.fat {
		letter-spacing: .3em;
		font-size: 3rem;
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
	.chango {
		font-family: 'Chango', cursive;
	}
	.sigmar {
		font-family: 'Sigmar One', cursive;
	}
	hr {
		margin: 10rem 0;
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

		<hr>

		<h1 class="fat chango text-uppercase">Exeunt</h1>
		<h2 class="fat chango text-uppercase">magazine</h2>

		<hr>

		<h1 class="fat sigmar text-uppercase">Exeunt</h1>

		<hr>

		<h1 class="fat chango">exeunt</h1>

		<hr>

	</div>

<?php get_footer(); ?>