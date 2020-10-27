<li>
    <div class="review-author"><?php echo get_avatar( $review->user_email ); ?></div>
    <div class="review-text">
        <h3 class="user-name"><?php echo esc_html( $review->display_name ); ?></h3>
        <div class="review-meta clearfix">
            <h4 class="review-title"><?php echo esc_html( $review->title ); ?></h4> 
            <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $review->rate ) );?>
        </div>
        <div class="review-content"><?php echo wp_kses_post( $review->content ); ?></div>
    </div>
</li>