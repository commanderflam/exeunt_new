<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:url"           content="<?php the_permalink(); ?>" />
        <meta property="og:type"          content="<?php if(is_single){ $pt = get_post_type($post->ID);
    
        $obj = get_post_type_object($pt);
        
        $type = $obj->label; echo $type; }?>" />
        <meta property="og:title"         content="<?php wp_title(''); ?>" />
        <meta property="og:description"   content="<?php if(is_single){ echo get_the_excerpt(); } ?>" />
        <meta property="og:image"         content="<?php if(has_post_thumbnail){$post_thumbnail_id = get_post_thumbnail_id();
$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id ); echo $post_thumbnail_url; } ?>" />

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <!--<link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>-->
        <?php wp_head(); ?>
        <script src="//use.typekit.net/dcx3wyi.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
    </head>
    <body <?php body_class(); $td = get_stylesheet_directory_uri(); ?>>

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
                
                    foreach( $myposts as $post ) : 

                            $adid = $post->ID; 
                            $attr = array(
                                        'class' => "attachment-$size img-responsive pull-right",
                                    );
                            $link = get_post_meta($adid, 'Ad Link', true);
                            if ( has_post_thumbnail($adid) ) :
                                $image = get_the_post_thumbnail($adid, 'full', $attr); 
                            endif;
                            ?>

                    <?php endforeach;

                endif; ?>

     <nav class="navbar navbar-light main-nav navbar-fixed-top shaded invisible amatic" id="fixed-main-nav">
            <a class="navbar-brand dancing" href="<?php echo home_url(); ?>">Exeunt</a>
            <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav hidden-sm-down', 'container' => '', 'menu_id' => 'main-nav-fixed', 'depth' => '2', 'theme_location' => 'primary', 'walker' => new wp_bootstrap_navwalker() ) ); ?>
            
        </nav>

    <div class="container" id="main">
        
        <div id="header" class="">

            <div id="logo">

                <h1 class="dancing"><a href="<?php echo home_url(); ?>">Exeunt</a></h1>

            </div>

            <?php if($adid) : ?>

                <?php if ( $image ) : ?>
            
                    <div id="the-damn-header-ad" class="text-right hidden-sm-down">
                        
                        <a target="_blank" title="Click for more info" href="<?php echo $link; ?>">
                                        
                            <?php echo $image;?>
                                    
                        </a>
                        
                        <div class="clearfix"></div>
                            
                    </div>
        
                <?php endif; ?>
                                                            
            <?php endif; ?>

        </div><!--header-->

        <?php if($adid) : ?>

            <?php if ( $image ) : ?>
        
                <div id="secondary-header-ad" class="text-right hidden-md-up">

                    <hr>
                    
                    <a target="_blank" title="Click for more info" href="<?php echo $link; ?>">
                                    
                        <?php echo $image;?>
                                
                    </a>
                    
                    <hr>
                        
                </div>
    
            <?php endif; ?>
                                                        
        <?php endif; ?>

        <nav class="navbar navbar-light main-nav amatic hidden-sm-down" id="main-nav">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">magazine</a>
            <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav hidden-md-down', 'container' => '', 'depth' => '2', 'theme_location' => 'primary', 'walker' => new wp_bootstrap_navwalker() ) ); ?>
        </nav>
        