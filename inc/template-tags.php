<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package libero
 */

if ( ! function_exists( 'libero_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function libero_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'libero' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'libero' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'libero_post_info' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function libero_post_info($date = true,$comment = true, $view = false) {
?>
	<?php if( $date ) { ?>
	<time class="libero-date" datetime="<?php echo get_the_modified_date('c') ?>"><i><?php echo get_the_modified_date() ?></i></time>
	<?php } ?>
	
	<?php if( $comment ) { ?>
	<a class="libero-comment" href="<?php the_permalink() ?>/#comment"><?php comments_number('<span class="count">0</span> Comment', '<span class="count">1</span> Comment', '<span class="count">%</span> Comments') ?></a>
	<?php } ?>
	
	<?php if( $view ) { ?>
	<span class="libero-comment libero-view-count"><span class="count"><?php echo libero_get_views(get_the_ID()) ?></span> <?php esc_html_e('Views','libero') ?></span>
	<?php } ?>
	
<?php
}
endif;


if ( ! function_exists( 'libero_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function libero_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'libero' ) );
		if ( $categories_list && libero_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'libero' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'libero' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'libero' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'libero' ), esc_html__( '1 Comment', 'libero' ), esc_html__( '% Comments', 'libero' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'libero' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function libero_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'libero_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'libero_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so libero_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so libero_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in libero_categorized_blog.
 */
function libero_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'libero_categories' );
}
add_action( 'edit_category', 'libero_category_transient_flusher' );
add_action( 'save_post',     'libero_category_transient_flusher' );
