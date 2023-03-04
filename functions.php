<?php
add_action('wp_head',function(){
    echo '
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
});

// display color field in category
add_action( 'announcement-cat_add_form_fields',  function ($taxonomy ) {
    // $color = get_term_meta( $term->term_id, 'cat_color', true );
	?>
		<div class="form-field">
			<label for="cat_color">Choose color</label>
			<input type="color" name="cat_color" id="cat_color" />
			<p>Choose a color to display in front page</p>
		</div>
	<?php
});



// display color field in category while editing

add_action( 'announcement-cat_edit_form_fields', function ( $term, $taxonomy ) {

	// get meta data value
	$text_field = get_term_meta( $term->term_id, 'cat_color', true );

	?><tr class="form-field">
		<th><label for="cat_color">Text Field</label></th>
		<td>
			<input name="cat_color" id="cat_color" type="color" value="<?php echo esc_attr( $text_field ) ?>" />
            <p>Choose a color to display in front page</p>

		</td>
	</tr><?php
}, 10, 2 );


//save data
add_action( 'created_announcement-cat', 'color_save_term_fields' );
add_action( 'edited_announcement-cat', 'color_save_term_fields' );
function color_save_term_fields( $term_id ) {
	
	update_term_meta(
		$term_id,
		'cat_color',
		sanitize_text_field( $_POST[ 'cat_color' ] )
	);
	
}

add_action( 'wp_footer', function(){
	echo "<script>
	for (let i = 0; i < $('.cat-item').length; i++) {
		var styleTag = $('<style>'+$('.cat-item').eq(i)+'::before { background-color: ' + $('.cat-item[data-color]').eq(i).data('color') + '}</style>');
		$('html > head').append(styleTag); 
	}
	</script>";
});

    // 1. #fcb900
    // 2. #75daad
    // 3. #0693e3
    // 4. #fc5c65
    // 5. #0fb9b1
    // 6. #8854d0