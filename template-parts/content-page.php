<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wagency
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-icon">
		<?php echo get_field('page_icon'); ?>
	</div>
	

	<div class="entry-content">
		<h1 class="tagline tagline-1"><?php the_field('page_tagline_1'); ?></h1>
		<h1 class="tagline tagline-2"><?php the_field('page_tagline_2'); ?></h1>

		<div class="entry-content__text"><?php the_content(); ?></div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wagency' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'wagency' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

<section class="cta">
	<div class="cta__inner">
		<p class="cta__info"><?php echo get_field('page_cta_text'); ?></p>
		<a href="<?php echo get_field('page_cta_link'); ?>" class="btn">Hire Us</a>
	</div>
</section>
