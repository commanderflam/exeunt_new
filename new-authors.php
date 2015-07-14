<?php
/*
Template Name: New Authors Page
*/
?>
<?php get_header(); ?>
<?php $authors = $wpdb->get_results("SELECT ID FROM $wpdb->users JOIN wp_usermeta ON user_id = ID WHERE meta_key='aim' ORDER BY meta_value");?>
<?php if($authors) :
		echo '<h2>Editorial Board</h2>'; $postvariable = 0;?>
	
	<div class="row">
	<?php
	
	foreach ($authors as $author) : 
		$authorid = $author->ID;
	
	if (get_the_author_meta( 'editboard', $authorid ) == 'Yes'){
	$current_link = get_author_posts_url($authorid);
	$production = get_the_author_meta('aim', $authorid);
	$title = get_the_author_meta('yim', $authorid);
	$postvariable++;
	?>
	<?php if(userphoto_exists($authorid)){ ?>
		<div class="span3">
			<div class="author" id="author-<?php echo $authorid; ?>">
		        <?php // echo $production; ?>
	            <div class="author-img">
					<a href="<?php echo $current_link ?>"><?php userphoto($authorid); ?></a>                   
	            </div><!--top pick img--> 
	            
	            <div class="author-caption">
	            <h6><?php echo $title; ?></h6>
	            <h3><a href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></h3>
	            </div>
	
			</div><!--author-->
		</div>
			<?php } }?>
			<?php if($postvariable%3==0){echo '<div class="clearfix"></div>';}?>
<?php endforeach; ?>
	</div>

	<?php echo '<div class="clearfix"></div>';
		echo '<hr><h2>Contributors</h2>';$postvariable = 0;?>
		<div class="row">

<?php foreach ($authors as $author) : $postvariable++;
			$authorid = $author->ID;
	
		if (get_the_author_meta( 'editboard', $authorid ) == ''){
		 if(userphoto_exists($authorid)){
		
		$current_link = get_author_posts_url($authorid);
		$production = get_the_author_meta('aim', $authorid);
		$title = get_the_author_meta('yim', $authorid);
		
		?>
		<div class="span2">
		<div class="author" id="author-<?php echo $authorid; ?>">
		        <?php // echo $production; ?>
	            <div class="author-img-s">
					<a href="<?php echo $current_link ?>"><?php userphoto_thumbnail($authorid); ?></a>                   
	            </div><!--top pick img--> 
	            
	            <div class="author-caption">
	            <h3><a href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></h3>
	            </div>
		
				</div><!--author-->
		</div>
		<?php } }?>
			<?php if($postvariable%5==0){echo '<div class="clearfix"></div>';}?>
	<?php endforeach; ?>
	</div><!--row-->
	<?php echo '<div class="clearfix"></div><hr><div class="row">';
	$postvariable = 0;
	foreach ($authors as $author) : $postvariable++;
			$authorid = $author->ID;
	
		if (get_the_author_meta( 'editboard', $authorid ) == ''){
		 if(!userphoto_exists($authorid)){
		
		$current_link = get_author_posts_url($authorid);
		$production = get_the_author_meta('aim', $authorid);
		$title = get_the_author_meta('yim', $authorid);
		
		?>
		<div class="span2">
	    	<h3><a href="<?php echo $current_link ?>"><?php the_author_meta('display_name', $authorid); ?></a></h3>
		</div>
		<?php } }?>
		<?php if($postvariable%5==0){echo '<div class="clearfix"></div>';}?>
		
	<?php endforeach; ?>
	</div><!--row-->
	<?php endif; ?>

<?php get_footer(); ?>