
<?php
//Registro CSS e Javascrip

function dm_base(){
	global $organic_ver, $theme_dir;

	//remover o registro nativo do jquery
	wp_deregister_script ('jquery');

	//registrar os arquivoss necessários
	wp_register_style('organic', $theme_dir.'/panel/assets/css/organic.css', array(), $organic_ver, 'all');
	wp_register_style('style', $theme_dir.'style.css', array('organic'), $organic_ver, 'all');

	//TRUE para FOOTER e FALSE para Hedaer
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), $organic_ver, TRUE);
	wp_register_script('libs', $theme_dir.'panel/assets/js/libs.js', array('jquery'), $organic_ver, TRUE);

	//carregar os arquivos css
	wp_enqueue_style('organic');
	wp_enqueue_style('style');

	//carregar os arquivos js	
	wp_enqueue_script('jquery');
	wp_enqueue_script('libs');	
}
	add_action('wp_enqueue_scripts', 'dm_base');

////////////////////////////////////////
/*    Registro thumbnails            */
//////////////////////////////////////

	add_theme_support('post-thumbnails');
	

//Registro Menu

function dm_menus(){
	register_nav_menus(
		array(
			'nav-topo' => 'Menu principal',
			'nav-rodape' => 'Menu do rodapé',
			)
		);
	}
add_action('init', 'dm_menus');
	
//Cache de menu

function dm_mostra_menu($nome_menu='nav-topo'){
	$output = '';
	if($nome_menu=='nav-topo'):
	if (get_transient('dm_menu_principal') === false):
		$output = wp_nav_menu(array(
			'theme_location' => 'nav-topo',
			'container' => false,
			'items_wrap' => '<ul class="right">%3$s</ul>',
			'echo' => 0
		));
		set_transient('dm_menu_principal', $output, 60*60*24);
	else:
		$output = get_transient('dm_menu_principal');
	endif;
	
	
elseif($nome_menu=='nav-rodape'):
	if (get_transient('dm_menu_rodape') === false):
		$output = wp_nav_menu(array(
			'theme_location' => 'nav-rodape',
			'container' => false,
			'items_wrap' => '<ul class="inline-list">%3$s</ul>',
			'echo' => 0
		));
		set_transient('dm_menu_rodape', $output, 60*60*24);
	else:
		$output = get_transient('dm_menu_rodape');
	endif;			
endif;
return $output;
	}
