<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0
 */

						// Widgets area inside page content
						chocorocco_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					chocorocco_create_widgets_area('widgets_below_page');

					$chocorocco_body_style = chocorocco_get_theme_option('body_style');
					if ($chocorocco_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$chocorocco_footer_style = chocorocco_get_theme_option("footer_style");
			if (strpos($chocorocco_footer_style, 'footer-custom-')===0) $chocorocco_footer_style = 'footer-custom';
			get_template_part( "templates/{$chocorocco_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (chocorocco_is_on(chocorocco_get_theme_option('debug_mode')) && chocorocco_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(chocorocco_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>