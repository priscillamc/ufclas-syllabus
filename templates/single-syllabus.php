<?php include( get_stylesheet_directory() .  "/header.php"); ?>

	<?php
		ufandshands_breadcrumbs();
	?>
	
	<div id="content-wrap">
	  <div id="content-shadow">
		<div id="content" class="container">
		
		  <article id="main-content" class="span-23 box" role="main">
			<h2>Course Syllabus Archives</h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			  
			  <?php ufandshands_content_title(); //page title ?>
			
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
				
				<!-- Attachments -->
				<?php $attachments = new Attachments( 'my_attachments' ); /* pass the instance name */ ?>
				
				<?php if( $attachments->exist() ) : ?>

				  <ul>
				    <?php while( $attachments->get() ) : ?>
				      <li>
				        <a href="<?php echo $attachments->url(); ?>" target="_blank">
                            <?php if( $attachments->field('syllabus_course_number') ) { 
				        		echo $attachments->field( 'syllabus_course_number' ) . ' - ' . $attachments->field( 'title' ) . ', (' . $attachments->field( 'syllabus_instructor' ) . ')';
				        	} else { 
                            	echo $attachments->field( 'title' );
                            }?>
                        </a>
				      </li>
				    <?php endwhile; ?>
				  </ul>
				<?php endif; ?>
				<!-- End Attachments -->
				
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				
			  <div class="single-navigation clear">
  				<div class="nav-previous"><?php previous_post_link('%link') ?></div>
  				<div class="nav-next"><?php next_post_link('%link') ?></div>
  			</div>
				
			<?php endwhile; ?>
        
  			
  		<?php endif; ?>
			
			<?php if ( is_user_logged_in() ) { ?> <p id="edit" class="clear" style="margin-top:20px;"><?php edit_post_link('Edit this article', '&nbsp; &raquo; ', ''); ?> | <a href="<?php echo wp_logout_url(); ?>" title="Log out of this account">Log out &raquo;</a></p> <?php } ?> 

		</article><!-- end #main-content --> 
		
	  </div>
	</div>
	</div>
<?php include( get_stylesheet_directory() . '/user-role-menu.php'); ?>
<?php include( get_stylesheet_directory() . "/footer.php"); ?>