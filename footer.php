<?php
/**
 * footer.php
 */

global $container_segments, $band_class;

function bs4_footernav($mn_c_class) {
	$ul_class = 'nav';
	if (!empty($mn_c_class)) $ul_class .= ' ' . $mn_c_class;
	return wp_nav_menu( array(
		'menu'	          => 'footer',
		'menu_class'      => $ul_class,
		'container'       => 'nav',
		'container_class' => 'nav-footer',
		'fallback_cb'     => false,
		'depth'	          => 1,
		'walker'	  => new Bootstrap_Walker_Menu_Nav(),
		'theme_location'  => 'footer',
		'echo'	          => false,
		) );
}

function ___cr($cr_class, $cr_text) {
	?><div class="<?= $cr_class ?>"><?php
	echo $cr_text;
	?></div><?php
}

function ___mn($mn_class, $mn_c_class) {
	?><div class="<?= $mn_class ?>"><?php
	echo bs4_footernav($mn_c_class);
	?></div><?php
}

$cr_position = get_theme_mod('copyright_position', 0);  // 0 => left, 1 => center, 2 => right
$cr_text = apply_filters( 'bootstrap4_footer_text', false );
if ($cr_text === false) {
	$cr_text = '&copy; ' . date('Y') . ' ' . get_bloginfo('name');
}
$has_cr = ($cr_text === false) || !empty($cr_text);
$has_mn = has_nav_menu( 'footer' );

if ($has_cr) {
	$cr_class = 'col-12';
	switch ($cr_position) {
		case 1: $cr_class .= ' text-center'; break;
		case 2: $cr_class .= ' text-right'; break;
		default: $cr_class .= ' text-left'; break;
	}
	if ($has_mn && ($cr_position != 1)) $cr_class .= ' col-md-6';
	$cr_class .= ' col-pr-12 copyright';
}
if ($has_mn) {
	$mn_class = 'col-12';
	if ($has_cr && ($cr_position != 1)) $mn_class .= ' col-md-6';
	$mn_c_class = '';
	switch ($cr_position) {
		case 1: $mn_c_class .= 'justify-content-center'; break;
		case 2: $mn_c_class .= 'justify-content-start'; break;
		default: $mn_c_class .= 'justify-content-end'; break;
	}
	$mn_class .= ' hidden-print';
}

?>
</div></div></main>

<?php if ($container_segments != 0) { echo '</div><div class="footer">'; } ?>

<?php do_action('tha_footer_before'); ?>
<footer id="footer" class="section"><div class="<?= $band_class ?>">
<?php
do_action('tha_footer_top');
get_template_part( 'sidebar-footer' );
do_action('tha_footer_bottom');

if ($has_mn || $has_cr) :
	?><div class="row footing"><?php

	switch ($cr_position) {
		case 1:
			if ($has_mn) ___mn($mn_class, $mn_c_class);
			if ($has_cr) ___cr($cr_class, $cr_text);
			break;
		case 2:
			if ($has_mn) ___mn($mn_class, $mn_c_class);
			if ($has_cr) ___cr($cr_class, $cr_text);
			break;
		default:
			if ($has_cr) ___cr($cr_class, $cr_text);
			if ($has_mn) ___mn($mn_class, $mn_c_class);
			break;
	}
	?></div><?php
endif;
?>
</div></footer>
<?php do_action('tha_footer_after'); ?>

<?php echo '</div>'; // .folio or .footer ?>

<div class="ends"><?php wp_footer(); ?></div>
<?php do_action('tha_body_bottom'); ?>
</body>
</html>
