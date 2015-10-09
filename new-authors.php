<?php
/*
Template Name: New Authors Page
*/
?>
<?php get_header(); 

	$user_args = array(
		'blog_id' => 'all',
		'meta_key' => 'aim',
		'orderby' => 'meta_value'	
	);
	
	$editorialBoard = get_users($user_args);

?>

<?php if ( $editorialBoard ) :

	echo '<h1>Editorial Board</h1>'; $postvariable = 0; $exclude = array(); ?>

	<hr>
	
	<div class="row">
	
	<?php
	
	foreach ($editorialBoard as $author) : 
		
		$authorid = $author->ID;
		$exclude[] = $authorid;
	
	if (get_the_author_meta( 'editboard', $authorid ) == 'Yes'){
	
		$current_link = get_author_posts_url($authorid);
		
		$production = get_the_author_meta('aim', $authorid);
	
		$title = get_the_author_meta('yim', $authorid);
	
		$postvariable++;
	
	?>

	<?php 

		if(userphoto_exists($authorid)){ ?>
				
				<div class="col-lg-3 col-md-4 col-sm-6">

					<?php if($authorid == 1) { ?>

						<div class="author-img">
							<?php userphoto($authorid, $before = '', $after = '', $attributes = array('class' => 'img-responsive img-thumbnail')); ?>                  
			            </div><!--top pick img--> 
			            
			            <div class="author-caption">
			            	<h4><?php the_author_meta('display_name', $authorid); ?></h4>
			            	<h5 class="text-uppercase"><?php echo $title; ?></h5>
			            </div>

					<?php	} else { ?>
				        
			            <div class="author-img">
							<a href="<?php echo $current_link ?>"><?php userphoto($authorid, $before = '', $after = '', $attributes = array('class' => 'img-responsive img-thumbnail')); ?></a>                   
			            </div><!--top pick img--> 
			            
			            <div class="author-caption">
			            	<h4><a href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></h4>
			            	<h5 class="text-uppercase"><?php echo $title; ?></h5>
			            </div>

			            <?php } ?>
			
				</div>
		<?php } 
	} ?>
			
	<?php if ( $postvariable%4==0 ) { echo '<div class="clearfix"></div>'; } ?>

<?php endforeach;

endif; // end if editorial board ?>
	</div>

	<?php

		$all_user_args = array(
			'blog_id' => 'all',
			'orderby' => 'post_count',
			'exclude' => $exclude	
		);
		
		$theRest = get_users($user_args);

		if($theRest) : 

	?>

	<?php echo '<div class="clearfix"></div>';

		echo '<hr><h2>Contributors</h2>'; $postvariable = 0;?>
		
		<div class="row">

<?php foreach ($theRest as $author) : 
			
		$authorid = $author->ID;
	
		if (get_the_author_meta( 'editboard', $authorid ) == ''){
		 //
			if(userphoto_exists($authorid)){ $postvariable++;
		
				$current_link = get_author_posts_url($authorid);
				$production = get_the_author_meta('aim', $authorid);
				$title = get_the_author_meta('yim', $authorid);
			
			?>
			<div class="col-lg-2 text-center">

					<a href="<?php echo $current_link ?>"><?php userphoto_thumbnail($authorid, $before = '', $after = '', $attributes = array('class' => 'img-responsive img-thumbnail')); ?></a>                   
		            
		            <div class="author-caption">
		            	<p class="author-title gil"><a href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></p>
		            </div>
			
			</div>
		<?php } else { $nonphotos[] = $author; }
		}?>
			<?php if($postvariable%6==0){echo '<div class="clearfix"></div>';}?>
	<?php endforeach; ?>
	</div><!--row-->
	<?php echo '<div class="clearfix"></div><hr><div class="row text-center">';
	$postvariable = 0;
	foreach ($nonphotos as $author) : $postvariable++;
			$authorid = $author->ID;
	
		if (get_the_author_meta( 'editboard', $authorid ) == ''){
		 //if(!userphoto_exists($authorid)){
		
		$current_link = get_author_posts_url($authorid);
		$production = get_the_author_meta('aim', $authorid);
		$title = get_the_author_meta('yim', $authorid);
		
		?>
		<div class="col-lg-2">
	    	<p class="author-title gil"><a class="btn btn-secondary btn-block" href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></p>
		</div>
		<?php //} 
		}?>
		<?php if($postvariable%6==0){echo '<div class="clearfix"></div>';}?>
		
	<?php endforeach; ?>
	</div><!--row-->
	<?php endif; ?>

<?php get_footer(); ?>