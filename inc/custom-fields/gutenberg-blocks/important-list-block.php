<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( 'TREBA Important List' )
	->add_fields( array(
		Field::make( 'rich_text', 'crb_post_important_list_block', 'Текст' ),
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
    
    <div class="bg-[#ffe5b4] dark:bg-[#836641] border-l-8 border-[#f0a84c] dark:border-[#42361e] rounded px-4 pl-4 lg:pl-8 py-4 mb-4">
      <div class="content">
        <p><?php echo $fields['crb_post_important_list_block']; ?></p>
      </div>
    </div>

		<?php
	} );