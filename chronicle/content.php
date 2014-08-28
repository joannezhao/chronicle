<?php
	/**
	 * The default template for displaying content
	 *
	 * Used for both single and index/archive/search.
	 *
	 * @package WordPress
	 * @subpackage Dartmouth Chronicle
	 * @since Dartmouth Chronicle 1.0
	 */
?>

<?php $the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large'); ?>

<!--Parallax images-->
<div class="wrapper-parallax-image wrapper-parallax-image-lg"
    data-anchor-target="#gap1"
	data-bottom-top="transform: translate3d(0px, 1200px, 0px);"
	data-top-bottom="transform: translate3d(0px, 0px, 0px);">
	  
	<div class="parallax-image parallax-image-lg"
		data-anchor-target="#gap1"
		style="background-image:url('http://thedartmouthchronicle.com/wp-content/uploads/2014/08/xmas-1024x768.jpg'); background-position:50% 100%;"
		data-bottom-top="transform: translate3d(0px, -400px, 0px);"
		data-top-bottom="transform: translate3d(0px, 320px, 0px);">
	</div>
</div>

<div class="article" data-id="<?php the_ID(); ?>">
  
  <div class="article-category-wrapper">
  	<div class="article-category">
  		<?php echo get_the_first_category(true); ?>
  	</div><div class="article-date">
  		<?php echo get_the_issue(get_the_ID()); ?>
  	</div>
  	<br><div class="article-border"></div>
  </div>

  <div class="article-title"><?php the_title(); ?></div>
  <?php if (has_excerpt()): ?>
  	<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
  <?php endif; ?>
  <div class="article-author">By <?php echo get_author(get_the_ID(), true); ?></div>

  <div class="gap gap-lg" id="gap1"></div>


	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					twentyfourteen_posted_on();

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</div><!-- #post-## -->
