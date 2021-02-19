<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage CHOCOROCCO
 * @since CHOCOROCCO 1.0.14
 */
$chocorocco_header_video = chocorocco_get_header_video();
$chocorocco_embed_video = '';
if (!empty($chocorocco_header_video) && !chocorocco_is_from_uploads($chocorocco_header_video)) {
	if (chocorocco_is_youtube_url($chocorocco_header_video) && preg_match('/[=\/]([^=\/]*)$/', $chocorocco_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$chocorocco_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($chocorocco_header_video) . '[/embed]' ));
			$chocorocco_embed_video = chocorocco_make_video_autoplay($chocorocco_embed_video);
		} else {
			$chocorocco_header_video = str_replace('/watch?v=', '/embed/', $chocorocco_header_video);
			$chocorocco_header_video = chocorocco_add_to_url($chocorocco_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$chocorocco_embed_video = '<iframe src="' . esc_url($chocorocco_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php chocorocco_show_layout($chocorocco_embed_video); ?></div><?php
	}
}
?>