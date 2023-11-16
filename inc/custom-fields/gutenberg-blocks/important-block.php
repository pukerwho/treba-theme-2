<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( 'TREBA Important Block' )
	->add_fields( array(
		Field::make( 'textarea', 'crb_post_important_block', 'Текст' ),
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
    
    <div class="bg-slate-300 dark:bg-slate-800 border-l-8 border-slate-700 dark:border-slate-400 rounded px-4 pl-4 lg:pl-8 py-4 mb-4">
      <div class="content">
        <p><?php echo esc_html( $fields['crb_post_important_block'] ); ?></p>
      </div>
    </div>

		<?php
	} );