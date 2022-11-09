<?php  
/**
 * Toggle button
 */

$label = esc_html__('Player', 'erplayer');
if( $btnlabel ){
	$label = $btnlabel;
}
$data = base64_encode($options);
$popup_url = add_query_arg('erplayerpopup', $data, site_url());
?>
<div id="<?php echo esc_attr($customClassButton); ?>" class="erplayer__toggletbutton__container">
	<a href="<?php echo esc_url($popup_url); ?>" target="_blank" class="erplayer__toggletbutton qt-popupwindow" data-name="<?php esc_html_e('Player', 'erplayer' ); ?>" data-width="<?php echo esc_attr( $popupW ); ?>" data-height="<?php echo esc_attr( $popupH ); ?>">
		<span  class="erplayer__toggletbutton__text"><i class="erplayer-icon-play"></i> <?php echo esc_html( $label ); ?></span>
	</a>
</div>
<?php
