<?php
/*
Plugin Name: Spoiler Block
Plugin URI: https://github.com/squiter85/Spoiler-Block
Description: Create spoiler's block in your posts to hide contents.
Version: 1.1
Author: Brunno dos Santos
Author URI: http://brunno.abstraindo.com
License: GPL2
*/

/*  Copyright 2011  Brunno dos Santos  (email : brunno@abstraindo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Let's code guys */


add_action('wp_print_styles', 'add_sb_style');
add_action('wp_enqueue_scripts', 'add_sb_scripts');

/* enfileirando os marotos */

function add_sb_style() {
    $myStyleUrl = plugins_url('css/style.css', __FILE__);
    $myStyleFile = WP_PLUGIN_DIR . '/spoiler_block/css/style.css';
    if ( file_exists($myStyleFile) ) {
        wp_register_style('spoiler_block', $myStyleUrl);
        wp_enqueue_style( 'spoiler_block');
    }
}

function add_sb_scripts() {
	wp_enqueue_script("jquery");
   	wp_enqueue_script('scripts',
    	plugins_url('/js/scripts.js', __FILE__),
    	array('scriptaculous'),
    	'1.0', true );
}


/*
	Fazendo o nego funfar no admin =D
	- Adicionando o botão no editor e adicionando o estilo no texto :D
*/

add_filter('mce_external_plugins', "spoiler_register");
add_filter('mce_buttons', 'spoiler_add_button', 0);

function spoiler_add_button($buttons)
{
    array_push($buttons, "separator", "spoiler");
    return $buttons;
}
 
function spoiler_register($plugin_array){

    $url = plugins_url('/js/spoiler_plugin/spoiler_mce.js', __FILE__);
 
    $plugin_array["spoiler"] = $url;
    return $plugin_array;
}

/* Pra adicionar o estilo no texto tem que colocar esse CSS maroto junto com outros marotos que já estão carregados */

add_filter('mce_css', 'spoiler_editor_css');
function spoiler_editor_css($url) {

	if ( !empty($url) )
		$url .= ',';

	$url .= plugins_url('/css/spoiler_admin_style.css', __FILE__);

  return $url;
}

/* Criando página de configuração do plugin */
add_action('admin_menu', 'spoiler_config_menu');
function spoiler_config_menu(){
	add_plugins_page( "Spoiler Block", "Spoiler Block Config", "activate_plugins", "spoiler-block-config", "spoiler_render_config");
}

function spoiler_render_config(){
	require("spoiler_render_config.php");
}



/* Selecionando a mesagem que vai ser exibida no spoiler */

add_action('wp_head', "spoiler_selected_message");

add_option("spoiler_alert", "Warning! Spoiler area! To read click here!");

function spoiler_selected_message(){
	echo '<script type="text/javascript"> var spoiler_message = "' .get_option("spoiler_alert"). '"</script>';
}

spoiler_selected_message($spoiler_alert);


?>