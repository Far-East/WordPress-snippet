<?php

// Подключаю

wp_enqueue_style( 'modal', get_template_directory_uri() . '/remodal/remodal.css', array());

wp_enqueue_script( 'modal', get_template_directory_uri() . '/remodal/remodal.min.js', array( 'jquery' ),
	true );
  
 // Вызов 
<a href="#modal">Call the modal with data-remodal-id="modal"</a>
  
 // Содержимое
<div class="remodal" data-remodal-id="modal">

  <button data-remodal-action="close" class="remodal-close"></button>
  <h3>Remodal</h3>
  <p>
    Responsive, lightweight, fast, synchronized with CSS animations, fully customizable modal window plugin with declarative configuration and hash tracking.
  </p>
</div>
  
  
  
