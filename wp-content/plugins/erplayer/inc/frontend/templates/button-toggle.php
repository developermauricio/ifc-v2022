<?php  
/**
 * Toggle button
 */
if('fixed' === $position && $showToggle ){
	$label = esc_html__('Player', 'erplayer');
	if( $btnlabel ){
		$label = $btnlabel;
	}
	?>
	<div id="<?php echo esc_attr($customClassButton); ?>" class="erplayer__toggletbutton__container">
		<a data-erplayer-togglerbutton="<?php echo esc_attr( $customClass ); ?>" class="erplayer__toggletbutton" >
			<span  class="erplayer__toggletbutton__text"><i class="erplayer-icon-play"></i> <?php echo esc_html( $label ); ?></span>
		</a>
	</div>
	<?php
}