<?php get_header(); ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <?php 

            $today = date('j F');
            $yesterday = date('j F', strtotime('yesterday'));

            $highargs = array(
                'child_of' => 23,
                'fields' => 'ids'
            );
            $highs = get_terms( 'featured', $highargs ); 
            $total = count($highs);
            ?>
        
        <div class="row">

            <div class="col-lg-12">

            <div id="carousel-home" class="carousel slide" data-interval="10000" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php for ($i = 1; $i <= $total; $i++) { ?>
                    <li data-target="#carousel-home" data-slide-to="<?php echo $i-1; ?>" <?php if($i == 1){ ?>class="active"<?php } ?>></li>
                <?php } ?>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                
                <?php
                
                $sequence = 0;
                $words = array();
                //$total = count($highs);

                foreach ($highs as $high): 
                    $args = array(
                        'post_type' => 'features',
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
                            $imageid = get_post_thumbnail_id();
                            $imgsrc = wp_get_attachment_image_src($imageid, 'x-large');
                            $cats = wp_get_post_terms( $post->ID, 'category', $args );

                            if($cats):
                                foreach($cats as $cat):
                                    //print_r2($cat);
                                    if($cat->slug !== 'features'){
                                        $catlist[$cat->name] = get_category_link($cat->term_id);
                                    }
                                endforeach;
                            endif;
                            ?>
                            <div class="carousel-item <?php if($sequence == 1){echo 'active';} ?>">

                            <div class="row">

                                <div class="col-lg-8">

                                <?php if ( has_post_thumbnail() ) { ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php $attr = array(
                                            'class' => 'img-responsive',
                                            'title' => trim(strip_tags( get_the_title() )),
                                        ); the_post_thumbnail('full', $attr); ?>
                                    </a>
                                <?php }?>

                                </div><!--col lg 8-->

                                <div class="col-lg-4">
                                    <div class="hero-div">
                                        <div class="hero-text">
                                            <h6 class="feature text-uppercase spaced">Feature <?php if($catlist):
            foreach($catlist as $label => $link):
                echo '<span> &bull; <a href="'.$link.'">'.$label.'</a></span>';
            endforeach;
        endif; ?></h6>
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <br />
                                            <h5 class="george"><?php echo get_the_excerpt(); ?></h5> 
                                        </div>
                                    </div>
                                </div>

                            </div><!--row-->

                            </div><!--carousel item-->


                            <?php endforeach;
                        endif;

                    endforeach;?>
              </div>

            </div>

            </div><!--col 8-->


    </div><!--row-->


    <hr>


    <div class="row posts">

        <div class="col-lg-8">

            <div class="row posts">

        <div class="col-lg-6 border-r">

            <?php 

            $exclude = array();

            $args = array(
                'post_type' => 'review', 
                'posts_per_page' => 1, 
                'post__not_in' => $exclude 
            );

            $latest_review = get_posts( $args );
            
            if($latest_review):
                
                foreach($latest_review as $post): setup_postdata($post); ?>
                    
                    <?php $exclude[] = $post->ID ?>

                    <div class="tile">
                        <div class="tile-img ">    
                            <a href="<?php the_permalink();?>">
                                <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'boots4' ); ?>
                                <img class="img-responsive img-rounded center-block" width="<?php echo $thumbnail['1']; ?>" src="<?php echo $thumbnail['0']; ?>" />
                            </a>
                        </div>

                        <h6 class="text-danger"><a class="review" href="<?php echo get_post_type_archive_link('review'); ?>">Reviews</a></h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>
                    
                        <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>
                    
                    </div>

                <?php endforeach; wp_reset_postdata(); ?>

            <?php endif;?>

        </div><!--col 4-->

        <div class="col-lg-6">
        
            <?php 

            $args = array(
                'post_type' => 'features', 
                'posts_per_page' => 1, 
                'post__not_in' => $exclude
            );

            $latest_feature = get_posts( $args );
            
            if($latest_feature):

                foreach($latest_feature as $post): setup_postdata($post);
                    
                    $exclude[] = $post->ID; ?>

                    <div class="tile">
                        <div class="tile-img ">    
                            <a href="<?php the_permalink();?>">
                                <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'boots4' ); ?>
                                <img class="img-responsive img-rounded center-block" width="<?php echo $thumbnail['1']; ?>" src="<?php echo $thumbnail['0']; ?>" />
                            </a>
                        </div>

                        <h6><a class="features" href="<?php echo get_post_type_archive_link('features'); ?>">Features</a></h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>
                    
                        <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>

                    </div><!--tile-->

                <?php endforeach; wp_reset_postdata();

            endif;?>

        </div>

        </div><!--row sub row-->

        <hr>

        <div class="row posts">

            <?php

            $args = array(
                
                'post_type' => array('review', 'features'), 
                'posts_per_page' => 2, 
                'post__not_in' => $exclude 
            
            );
            
            $lately = get_posts( $args );
            
            if($lately): $count = 0;
            
                foreach($lately as $post): setup_postdata($post); $count++; 

                        $pt = get_post_type($post->ID);

                        $obj = get_post_type_object($pt);
        
                        $type = $obj->label;

                        $tlink = get_post_type_archive_link($pt);

                        $exclude[] = $post->ID;


                ?>
        
        <div class="col-lg-4 <?php if($count !== 2) { echo 'border-r'; } ?>">

            <?php if($count == 5) { ?>

                <div class="card card-inverse tile">

                    <?php $attr = array(
                            'class' => "card-img img-responsive",
                        );
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail('boots4', $attr);
                    } ?>
                  <div class="card-img-overlay">
                    <h3 class="card-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                    <p class="card-text"><?php echo get_the_excerpt(); ?></p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>

            <?php } else { ?>
        
                    <div class="tile">
                                    
                        <h6 class="text-danger"><?php if ($pt == 'features' || $pt == 'review'){ echo '<a class="'.$pt.'" href="'.$tlink.'">'.$type.'</a>'; } else { the_category('<span> &bull; ','</span>'); } ?></h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        
                        <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>

                        <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>
                    
                    </div><!--tile-->

            <?php } ?>
        
        </div><!--col 3-->

            <?php endforeach; wp_reset_postdata();
        
            endif; ?>

        <div class="col-lg-4">

            <div class="full-block yellow">

                <h3 class="text-center fw-400"><span class="amatic">the</span><br/><span class="dancing big">Exeunt</span><br /><span class="amatic spaced">newsletter</span></h3>
                <p class="text-center">Enter your <strong>email address</strong> below to get an occasional email with Exeunt updates and featured articles.</p>
                <hr>
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                <form action="//exeuntmagazine.us2.list-manage.com/subscribe/post?u=11dd1f596e140a1abc054299f&amp;id=d347ea60ae" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div id="mc_embed_signup_scroll">
                    
                <div class="mc-field-group form-group">
                    <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL">
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_11dd1f596e140a1abc054299f_d347ea60ae" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-primary center-block"></div>
                    </div>
                </form>
                </div>

                <!--End mc_embed_signup-->

            </div>

        </div><!-- col lg 4-->

        </div><!--row subrow-->

        <hr>

        <div class="row posts">

            <div class="col-lg-4">
                <div class="full-block blue">

                    <?php $args = array(
                        
                        'post_type' => array('review', 'features'), 
                        'posts_per_page' => 1, 
                        'post__not_in' => $exclude,
                        'category_name' => 'columns'
                    
                    );
                    
                    $opinion = get_posts( $args );

                    if($opinion):

                        foreach($opinion as $post): setup_postdata($post); 

                            $pt = get_post_type($post->ID);

                            $obj = get_post_type_object($pt);
            
                            $type = $obj->label;

                            $tlink = get_post_type_archive_link($pt);

                            $exclude[] = $post->ID;

                    ?>

                            <div class="tile">
                                    
                                <h6><a href="<?php $category_id = get_cat_ID( 'columns' ); echo get_category_link($category_id); ?>">Opinion</a></h6>

                                <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                
                                <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>

                                <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>
                            
                            </div><!--tile-->

                        <?php endforeach;

                    endif; ?>

                </div>
            </div>

            <?php

            $args = array(
                
                'post_type' => array('review', 'features'), 
                'posts_per_page' => 2, 
                'post__not_in' => $exclude 
            
            );
            
            $lately = get_posts( $args );
            
            if($lately): $count = 0;
            
                foreach($lately as $post): setup_postdata($post); $count++; 

                        $pt = get_post_type($post->ID);

                        $obj = get_post_type_object($pt);
        
                        $type = $obj->label;

                        $tlink = get_post_type_archive_link($pt);

                        $exclude[] = $post->ID;


                ?>
        
        <div class="col-lg-4 <?php if($count !== 2) { echo 'border-r'; } ?>">
        
                    <div class="tile">
                                    
                        <h6 class="text-danger"><?php if ($pt == 'features' || $pt == 'review'){ echo '<a class="'.$pt.'" href="'.$tlink.'">'.$type.'</a>'; } else { the_category('<span> &bull; ','</span>'); } ?></h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        
                        <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>

                        <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>
                    
                    </div><!--tile-->
        
        </div><!--col 3-->

            <?php endforeach; wp_reset_postdata();
        
            endif; ?>

        </div><!--row subrow-->

        </div><!--col-lg- 8 -->

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
                        <!-- <p class="text-muted"><small>Advertisement</small></p> -->
                        <a target="_blank" title="Click for more info" href="<?php echo get_post_meta($post->ID, 'Ad Link', true);?>">
                            <?php the_post_thumbnail('full');?>
                        </a><?php }else {echo get_the_excerpt();}?>
                </div>
            <?php endforeach; wp_reset_postdata();

        endif; ?>


        <!-- -->

        <hr>

<!--         <h4 class="gil"><span class="offset">Recent</span> Features</h4>
 -->
            <?php

            $args = array(
                
                'post_type' => 'features', 
                'posts_per_page' => 4, 
                'post__not_in' => $exclude 
            
            );
            
            $features = get_posts( $args );
            
            if($features): $count = 0; ?>

                <h6 class="text-uppercase spaced"><a class="feature" href="<?php echo get_post_type_archive_link('features'); ?>">Features</a></h6>

                <?php

                foreach($features as $post): setup_postdata($post); $count++; 

                $authorlink = get_author_posts_url( get_the_author_meta( 'ID' ));
        
                $author = get_the_author();

                $exclude[] = $post->ID;

                ?>

                <div class="feature-list">
                        
                    <!-- <h6 class="feature-date text-muted gil"><?php the_time('j F Y'); ?></h6> -->
                    
                    <h5 class="author-title gil"><a href="<?php echo $authorlink; ?>" title="See all articles written by <?php echo $author; ?>"><?php echo $author; ?></a></h5>

                    <h3 class="gil archive-entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                    
                    <p class="george"><?php echo get_the_excerpt();?></p>

                </div>

                <?php if($count == 1){ vertad(); } ?>
                    


            <?php endforeach; wp_reset_postdata(); ?>

                <p class="text-uppercase spaced"><a class="btn btn-primary">See All Features</a></p>
        
            <?php endif; ?>

        </div>


    </div><!--row-->

    <hr>

    <div class="row">
        
        <div class="col-lg-2 text-right fw-400">

            <h5 class="m-b-0 p-t-md">the</h5>
            <h2 class="text-uppercase m-b-0">Latest</h2>
            <h2 class="text-uppercase">Podcast</h2>

            <h6 class="gil"><a href="<?php echo get_post_type_archive_link('podcast'); ?>" class="">View All</a> &nbsp;</h6>

        </div>

        <div class="col-lg-10">

            <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/216483991&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>

        </div>

    </div>

    <hr>

    <?php if($latest_review):
                
                foreach($latest_review as $post): setup_postdata($post); ?>
    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
    <!-- <div class="row center" id="full-row" style="background-size: contain; background-image: url('<?php echo $thumbnail[0]; ?>')">
     <div class="shade">

            <h1><?php the_title(); ?></h1>

            <?php 
    $str = wpautop( get_the_content() );
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags($str, '<a><strong><em>');
    echo '<p>' . $str . '</p>';?>
            <div class="george"><?php the_excerpt(); ?></div>

            </div>
    </div> -->


    <?php endforeach; wp_reset_postdata(); ?>

            <?php endif;?>

            <div class="clearfix"></div>

    <div class="row posts">

            <?php

            $args = array(
                
                'post_type' => array('review', 'features'), 
                'posts_per_page' => 4, 
                'post__not_in' => $exclude 
            
            );
            
            $lately = get_posts( $args );
            
            if($lately): $count = 0;
            
                foreach($lately as $post): setup_postdata($post); $count++; 

                        $pt = get_post_type($post->ID);

                        $obj = get_post_type_object($pt);
        
                        $type = $obj->label;

                        $tlink = get_post_type_archive_link($pt);

                        $exclude[] = $post->ID;


                ?>
        
        <div class="col-lg-3 <?php if($count !== 4) { echo 'border-r'; } ?>">
        
                    <div class="tile">
                                    
                        <h6 class="text-danger"><?php if ($pt == 'features' || $pt == 'review'){ echo '<a class="'.$pt.'" href="'.$tlink.'">'.$type.'</a>'; } else { the_category('<span> &bull; ','</span>'); } ?></h6>

                        <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        
                        <p class="george"><span class="author"><?php echo get_the_author(); ?></span> on <?php echo get_the_excerpt();?></p>

                        <p class="text-muted"><small><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } elseif ($yesterday == $pubDate) { echo 'Published Yesterday'; } else echo $pubDate; ?></small></p>
                    
                    </div><!--tile-->
        
        </div><!--col 3-->

            <?php endforeach; wp_reset_postdata();
        
            endif; ?>


    </div><!--row-->
<hr>

    <h1 class="gil center col-lg-offset-3">More Features</h1>

            <?php

            $args = array(
                
                'post_type' => 'features', 
                'posts_per_page' => 4, 
                'post__not_in' => $exclude 
            
            );
            
            $features = get_posts( $args );
            
            if($features): $count = 0;
            
                foreach($features as $post): setup_postdata($post); $count++; 

                $authorlink = get_author_posts_url( get_the_author_meta( 'ID' ));
        
                $author = get_the_author();

                ?>

                <div class="row list">

                    <div class="col-lg-2 col-lg-offset-1 text-right">
                        
                        <h6 class="feature-date text-muted gil"><?php $pubDate = get_the_time('j F'); if ($today == $pubDate) { echo 'Published Today'; } else echo $pubDate; ?></h6>
        
                        <h5 class="author-title gil"><a href="<?php echo $authorlink; ?>" title="See all articles written by <?php echo $author; ?>"><?php echo $author; ?></a></h5>

                    </div>

                    <div class="col-lg-2">
                        <?php twentyfifteen_post_thumbnail('medium'); ?>
                    </div>
        
                    <div class="col-lg-6">

                        <h3 class="gil archive-entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                        
                        <p class="george"><?php echo get_the_excerpt();?></p>
                    
                    </div><!--col 6-->

                </div><!--row-->

            <?php endforeach; wp_reset_postdata();
        
            endif; ?>

 
<?php get_footer(); ?>