<?php include( get_stylesheet_directory() .  "/header.php"); ?>

	<?php
		ufandshands_breadcrumbs();
	?>
	
	<div id="content-wrap">
	  <div id="content-shadow">
		<div id="content" class="container">
		
		  <article id="main-content" class="span-23 box" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			  
			  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>  
              <?php the_excerpt(); ?>
				
			<?php endwhile; ?>
        
  			
  		<?php endif; ?>
			
			<?php if ( is_user_logged_in() ) { ?> <p id="edit" class="clear" style="margin-top:20px;"><?php edit_post_link('Edit this article', '&nbsp; &raquo; ', ''); ?> | <a href="<?php echo wp_logout_url(); ?>" title="Log out of this account">Log out &raquo;</a></p> <?php } ?> 

		</article><!-- end #main-content --> 
		
	  </div>
	</div>
	</div>
<?php include( get_stylesheet_directory() . '/user-role-menu.php'); ?>
<?php include( get_stylesheet_directory() . "/footer.php"); ?>