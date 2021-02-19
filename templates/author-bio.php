<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */
?>

<div class="author_info scheme_default author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$chocorocco_mult = chocorocco_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$chocorocco_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
        <?php echo esc_html__( 'About author', 'chocorocco' );?>
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('%s', 'chocorocco'), '<span class="fn">'.get_the_author().'</span>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
