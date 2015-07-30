<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!--<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>-->
        <?php wp_head(); ?>
        <script src="//use.typekit.net/dcx3wyi.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
    </head>
    <body <?php body_class(); ?>>

    <div class="container" id="main">

    <?php
        $args = array( 
            'post_type' => 'adverts', 
            'tax_query' => array(
                array(
                    'taxonomy' => 'adtype',
                    'field' => 'slug',
                    'terms' => 'banner'
                )
            ),
            'meta_key' => 'Ad Status', 
            'meta_value' => 'Active', 
            'posts_per_page' => 1 
        );
        $myposts = get_posts( $args );
        if($myposts):
        foreach( $myposts as $post ) :  setup_postdata($post); $size = 'full'?>
                <div id="the-damn-header-ad" class="text-center">
                    <?php if ( has_post_thumbnail() ) {?>
                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
                            <?php $attr = array(
                                'class' => "attachment-$size img-responsive center-block",
                            );
                            the_post_thumbnail('full', $attr);?>
                        </a>
                    <?php }
                        else {
                            echo get_the_excerpt();
                        }?>
                </div>
        <?php endforeach;
        endif; ?>

    <div id="navbar-placeholder">

    <nav class="navbar navbar-default gil" id="main-nav">
        <div class="container-fluid">

                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php bloginfo('url');?>">Exeunt</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


        <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav', 'container' => '', 'depth' => '2', 'theme_location' => 'primary', 'walker' => new wp_bootstrap_navwalker() ) ); ?>
        <?php //get_search_form();?>

            <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>

          </div><!-- /.navbar-collapse -->

        </div>
    </nav>
    </div><!--navbar placeholder-->
        