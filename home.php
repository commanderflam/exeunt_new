<?php get_header(); ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <?php $highargs = array(
                    'child_of' => 23,
                    'fields' => 'ids'
                ); 
            $highs = get_terms( 'featured', $highargs ); 
            $total = count($highs);
            ?>
                
                
        
        <div class="row">

            <div class="col-lg-8">

            <div id="carousel-example-generic" class="carousel slide" data-interval="10000" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php for ($i = 1; $i <= $total; $i++) { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i-1; ?>" <?php if($i == 1){ ?>class="active"<?php } ?>></li>
                <?php } ?>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                
                <?php
                
                $sequence = 0;
                //$total = count($highs);

                foreach ($highs as $high): 
                    $args = array(
                        'post_type' => 'home_carousel',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'featured',
                                'field' => 'id',
                                'terms' => $high
                            )
                        ),
                        'posts_per_page' => 1,
                    );
                    $carousel_features = get_posts( $args ); 
                        
                        if ( $carousel_features):
                            foreach($carousel_features as $post): setup_postdata($post);
                            $sequence++;
                            ?>
                            <div class="item <?php if($sequence == 1){echo 'active';} ?>">
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <a href="<?php echo get_post_meta($post->ID, 'Image Link', true);?>">
                                        <?php $attr = array(
                                            'title' => trim(strip_tags( get_the_title() )),
                                        ); the_post_thumbnail('home-carousel', $attr); ?>
                                    </a>
                                <?php }?>
                            </div>
                            <?php endforeach;
                        endif; 

                    endforeach;?>
              </div>

            </div>

            </div><!--col 8-->

            <div class="col-lg-3 text-center" id="hero-div">

                <div id="hero-text">

                    <h1>Title</h1>
                    <h2>Caption</h2>

                </div>

            </div><!--col 3-->
            

    </div><!--row-->

    <hr>

    <div class="row">

        <div class="col-lg-4 text-center border-r">

            <?php $args = array(
                'post_type' => 'review', 
                'posts_per_page' => 1, 
                'post__not_in' => $exclude )
            ;
            $latest_review = get_posts( $args );
            if($latest_review):
                foreach($latest_review as $post): setup_postdata($post); ?>
                    <?php $exclude[] = get_the_ID(); ?>

                    <div class="tile">
                                    
                        <a href="<?php the_permalink();?>">
                            <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'boots3' ); ?>
                            <img class="img-responsive center-block" width="<?php echo $thumbnail['1']; ?>" src="<?php echo $thumbnail['0']; ?>" />
                        </a>

                        <h6 class="text-danger">Reviews</h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt();?>
                    </div>

                <?php endforeach;?>
            <?php endif;?>

        </div><!--col 4-->

        <div class="col-lg-4 text-center">
        
            <?php $args = array(
                'post_type' => 'features', 
                'posts_per_page' => 1, 
                'post__not_in' => $exclude
                );

            $latest_review = get_posts( $args );
            
            if($latest_review):
                foreach($latest_review as $post): setup_postdata($post); ?>
                    <?php $exclude[] = get_the_ID(); ?>

                    <div class="tile">
                                    
                        <a href="<?php the_permalink();?>">
                            <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'boots3' ); ?>
                            <img class="img-responsive center-block" width="<?php echo $thumbnail['1']; ?>" src="<?php echo $thumbnail['0']; ?>" />
                        </a>

                        <h6 class="text-danger">Features</h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt();?>
                    </div><!--tile-->

                <?php endforeach;?>
            <?php endif;?>

        </div>

        <div class="col-lg-4 border-l">

        <?php $args = array(
            'post_type' => 'adverts',
            'adtype' => 'mpu',
            'tax_query' => array(
                array(
                    'taxonomy' => 'adpos',
                    'field' => 'slug',
                    'terms' => 'mpu-1'
                )
            ), 
            'meta_key' => 'Ad Status', 
            'meta_value' => 'Active', 
            'posts_per_page' => 1 );
        $mpu1 = get_posts( $args );
        if($mpu1):
            foreach( $mpu1 as $post ) : setup_postdata($post);?>
                <div class="some-damn-ad p5 text-right">
                    <?php if ( has_post_thumbnail() ) {?>
                        <p class="text-muted"><small>Advertisement</small></p>
                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
                            <?php the_post_thumbnail('full');?>
                        </a><?php }else {echo get_the_excerpt();}?>
                </div>
            <?php endforeach;
        endif; ?>

        </div>

    </div><!--row-->

 
<?php get_footer(); ?>