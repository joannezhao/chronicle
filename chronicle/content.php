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

<?php $the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); ?>

<!--Parallax images-->
<div class="wrapper-parallax-image wrapper-parallax-image-lg"
    data-anchor-target="#gap0"
	data-bottom-top="transform: translate3d(0px, 1200px, 0px);"
	data-top-bottom="transform: translate3d(0px, 0px, 0px);">
	  
	<div class="parallax-image parallax-image-lg"
		data-anchor-target="#gap0"
		style="background-image:url('<?php echo $the_url[0]; ?>'); background-position:50% 100%;"
		data-bottom-top="transform: translate3d(0px, -400px, 0px);"
		data-top-bottom="transform: translate3d(0px, 320px, 0px);">
	</div>
</div>

<div class="article" data-id="<?php the_ID(); ?>">
  
  <div class="page-center">
	  <div class="article-category-wrapper">
	  	<div class="article-category">
	  		<?php echo get_the_first_category(true); ?>
	  	</div><div class="article-date">
	  		<?php echo get_the_issue(get_the_ID()); ?>
	  	</div>
	  </div>

	  <div class="article-title"><?php the_title(); ?></div>
	  <?php if (has_excerpt()): ?>
	  	<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
	  <?php endif; ?>
	  <div class="article-author">By <?php echo get_author(get_the_ID(), true); ?></div>
  </div>

  <div class="gap gap-lg" id="gap0"></div>


	<!-- <header class="entry-header">

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
		</div>
	</header> -->

	<?php if ( is_search() ) : ?>
		<div class="article-summary">
			<?php echo get_the_excerpt(); ?>
		</div>
	<?php else : ?>

		<div class="article-content-wrapper">
			<div class="article-content">
				<?php
					the_content('Continue reading <span class="meta-nav">&rarr;</span>');
				?>
			</div>

			<div class="recommended-wrapper">
				<div class="comment-title">Recommended</div>
				<?php
					$loop = get_popular_articles(3);

	    			while ($loop->have_posts()):
	    				$loop->the_post();
	    				$the_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'recommended');
	    		?>

	    			<div class="recommended">
	    				<div class="recommended-category">
	    					<div class="recommended-category-title"><?php echo get_the_first_category(true); ?></div>
	    					<div class="recommended-category-border"></div>
	    				</div>
	    				<a class="recommended-link" href="<?php echo get_permalink(); ?>">
	    					<div class="recommended-img shadow-inset-sm" style="background-image: url('<?php echo $the_url[0]; ?>');"></div>
	    					<div class="recommended-title"><?php the_title(); ?></div>
	    				</a>
	    			</div>

	    		<?php endwhile; ?>
			</div>

			<?php if ( comments_open() || get_comments_number() ): ?>
				
				<div class="comments">
					<div class="comment-title">Comments</div>
					<?php comments_template(); ?>
				</div>
			
			<?php endif; ?>
		</div>

	<?php endif; ?>

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</div><!-- #post-## -->
