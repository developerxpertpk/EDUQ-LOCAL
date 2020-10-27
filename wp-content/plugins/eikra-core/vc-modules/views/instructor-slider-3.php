<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( $orderby_alt == 'name' ) {
	$args = array(
		'role'    => LP_TEACHER_ROLE,
		'number'  => 2,
		'orderby' => 'display_name',
		'order'   => 'ASC',
	);
	$query = new WP_User_Query( $args );
	$item1 = !empty( $query->results[0]->ID ) ? $query->results[0]->ID : false;
	$item2 = !empty( $query->results[1]->ID ) ? $query->results[1]->ID : false;
}

$class = ( $student_dis == 'false' ) ? 'rtin-nostudent' : '';
?>
<div class="rt-vc-instructor-3 <?php echo esc_attr( $class );?>">
	<div class="row">
		<?php for ( $i = 1; $i < 3; $i++ ):?>
			<?php
			$id = ${'item'.$i};

			if ( !$id ) continue;

			$instructor_info = get_the_author_meta( 'rt_lp_instructor_info', $id );
			$name = get_the_author_meta( 'display_name', $id );
			$designation = !empty( $instructor_info['designation'] ) ? $instructor_info['designation'] : '';
			$description = get_user_meta( $id, 'description', true );
			$description = wp_trim_words( $description, $count );

			$args = array(
				'post_type'           => 'lp_course',
				'post_status'         => 'publish',
				'suppress_filters'    => false,
				'ignore_sticky_posts' => 1,
				'author'              => $id
			);

			$courses = get_posts( $args );
			$course_count = sizeof( $courses );

			$enroll_count = 0;
			foreach ( $courses as $each_course ) {
				$course = learn_press_get_course( $each_course->ID );
				$enroll_count += $course->get_users_enrolled();
			}
			?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="rtin-item clearfix">
					<div class="media-left pull-left">
						<a href="<?php echo esc_url( learn_press_user_profile_link( $id ) );?>"><?php echo get_avatar( $id, 130 ); ?></a>
					</div>
					<div class="media-body">
						<div class="rtin-name"><a href="<?php echo esc_url( learn_press_user_profile_link( $id ) );?>"><?php echo esc_html( $name ); ?></a></div>
						<?php if ( $designation_dis == 'true' ): ?>
							<div class="rtin-designation"><?php echo wp_kses_post( $designation ); ?></div>
						<?php endif; ?>
						<div class="rtin-description"><?php echo wp_kses_post( $description ); ?></div>
						<?php if ( $student_dis == 'true' ): ?>
							<div class="rtin-meta"><?php echo sprintf( "<span>%d</span> Students in <span>%d</span> Courses", $enroll_count, $course_count );?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endfor;?>
	</div>
	<?php if ( $button_dis == 'true' && $buttontext ): ?>
		<div class="rtin-btn"><a href="<?php echo esc_html( $buttonurl );?>"><?php echo esc_html( $buttontext );?></a></div>
	<?php endif; ?>
</div>