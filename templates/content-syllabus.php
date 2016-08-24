<?php
/**
 * Template part for displaying single page content in a table.
 *
 * @package UFCLAS_UFL_2015
 */
?>
<div class="ufclas-syllabus ufclas-syllabus-single">
  <table class="table table-striped ufclas-syllabus-content">
    <thead>
      <tr>
        <th><?php _e('Course', 'ufclas-syllabus'); ?></th>
        <th><?php _e('Section', 'ufclas-syllabus'); ?></th>
        <th><?php _e('Course Title / Syllabus', 'ufclas-syllabus'); ?></th>
        <th><?php _e('Instructor(s)', 'ufclas-syllabus'); ?></th>
      </tr>
    </thead>
    <tbody>
    
	<?php 
	if ( class_exists( 'Attachments' ) ):
		$attachments = new Attachments( 'syllabus_attachments' ); /* pass the instance name, do not change */
		
		if( $attachments->exist() ) :
			while( $attachments->get() ) : 
			?>
                <tr>
                    <td><?php echo $attachments->field('syllabus_course_number'); ?></td>
                    <td><?php echo $attachments->field('syllabus_section'); ?></td>
                    <td><a href="<?php echo $attachments->url(); ?>" target="_blank"><?php echo $attachments->field('title'); ?></a></td>
                    <td><?php echo $attachments->field('syllabus_instructor'); ?></td>
                </tr>
			<?php 
			endwhile;
		endif; 
	endif;
	?>
  </tbody>
  </table>
</div><!-- .ufclas-syllabus-single --> 