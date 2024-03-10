<?php
	the_posts_pagination( array(
		'prev_text' => esc_html__( 'Previous page', 'medical-clinic-lite' ),
		'next_text' => esc_html__( 'Next page', 'medical-clinic-lite' ),
	) );