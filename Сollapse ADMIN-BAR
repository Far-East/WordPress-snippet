<?php

if( 'Сollapse Toolbar' ){
	
	/**
	 * Сollapse ADMIN-BAR (Toolbar) into left-top corner
	 * v 0.9
	 */
	add_action( 'admin_bar_init', function(){
		remove_action( 'wp_head', '_admin_bar_bump_cb' ); // html margin bumps
		add_action( 'wp_before_admin_bar_render', 'kama_adminbar_styles' );
		//add_action( 'wp_after_admin_bar_render', 'set_adminbar_styles_show' );
	});
	function kama_adminbar_styles(){
		// Выходим если админка, можно закомментить...
		if( is_admin() ) return;
		
		ob_start();
		?>
		<style>
			#wpadminbar{ background:none; float:left; width:auto; height:auto; bottom:0; min-width:0 !important; }
			#wpadminbar > *{ float:left !important; clear:both !important; }
			#wpadminbar .ab-top-menu li{ float:none !important; }
			#wpadminbar .ab-top-secondary{ float: none !important; }
			#wpadminbar .ab-top-menu>.menupop>.ab-sub-wrapper{ top:0; left:100%; white-space:nowrap; }
			#wpadminbar .quicklinks>ul>li>a{ padding-right:17px; }
			#wpadminbar .ab-top-secondary .menupop .ab-sub-wrapper{ left:100%; right:auto; }
			html{ margin-top:0!important; }
			
			#wpadminbar{ overflow:hidden; width:33px; height:30px; }
			#wpadminbar:hover{ overflow:visible; width:auto; height:auto; background:rgba(102,102,102,.7); }
			
			/* цвет главной иконки */
			#wp-admin-bar-<?= is_multisite() ? 'my-sites' : 'site-name' ?> .ab-item:before{ color:#797c7d; }
			
			/* прячем wp-logo */
			#wp-admin-bar-wp-logo{ display:none; }
			/* #wp-admin-bar-search{ display:none; } */
			
			/* правка для twentysixteen */
			body.admin-bar:before{ display:none; }
			
			/* Для админки --- */
			@media screen and ( min-width: 782px ) {
				html.wp-toolbar{ padding-top:0 !important; }
				#wpadminbar:hover{ background:rgba(102,102,102,1); }
				#adminmenu{ margin-top:48px !important; }
			}
			
			/* Gutenberg */
			#wpwrap .edit-post-header{ top:0; }
			#wpwrap .edit-post-sidebar{ top:56px; }
		</style>
		<?php
		$styles = ob_get_clean();
		
		echo preg_replace( '/[\n\t]/', '', $styles ) ."\n";
	}
	
}
