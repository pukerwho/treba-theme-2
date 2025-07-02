<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( 'TREBA HAPPYBIRTHDAY Block' )
	->add_fields( array(
		Field::make( 'complex', 'crb_block_happy', 'Привітання' )->add_fields( array(
      Field::make( 'textarea', 'crb_block_happy_text', 'Одне привітання' ),
    )),
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
    <style>
		.happy_b_item_btn.success {
			background-color: #22c55e;
			color: #fff;
		}
    </style>
    <div>
      <?php 
        $i = 0;
        $happy_birthday = $fields['crb_block_happy']; 
        foreach( $happy_birthday as $happy_b ):
      ?>
      <div class="happy_b_item bg-slate-300 dark:bg-slate-800 border-l-8 border-slate-700 dark:border-slate-400 rounded px-4 pl-4 lg:pl-8 py-4 mb-4">
        <div class="happy_b_item_text mb-4" id="copy<?php echo $i; ?>"><?php echo nl2br($happy_b['crb_block_happy_text']); ?></div>
        <div class="happy_b_item_btn inline-block bg-slate-800 dark:bg-slate-400 text-gray-300 dark:text-gray-900 rounded-lg px-4 py-2 cursor-pointer copy-click" data-clipboard-text="<?php echo $happy_b['crb_block_happy_text']; ?>">Копіювати</div>
      </div>
      <?php $i = $i+1; ?>
      <?php endforeach; ?>
    </div>
    <?php
	} );