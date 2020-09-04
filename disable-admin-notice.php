<?php
add_action('admin_head', 'tgmpa_styles');

function tgmpa_styles() {
    echo '<style>
		#setting-error-tgmpa {
			display:none !important;
		}
    </style>';
}
