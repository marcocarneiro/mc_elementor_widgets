<?php
/*
Plugin Name: MC Elementor Widgets
Plugin URI: https://marco-carneiro.com.br/
Description: Componentes do Elementor para adicionar aos componentes já instalados.
Version: 2.0
Author: Marco Carneiro - Lima Digital
Author URI: https://marco-carneiro.com.br/
License: GPLv2 or later
Text Domain: mc_elementor_widgets
*/

//INCLUDES
$arqCoreInit = plugin_dir_path( __FILE__ ). 'core_init.php';

//Aborta se não for executado pelo WP
if( ! defined('WPINC')){die();}

if(file_exists($arqCoreInit)){
    require_once($arqCoreInit);
}

