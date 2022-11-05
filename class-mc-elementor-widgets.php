<?php
/**
 * MC Elementor_Widget class.
 *
 * @category   Class
 * @package    MC Elementor widgets Class
 * @subpackage WordPress
 * @author    Marco Carneiro
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since      1.0.0
 * php version 7.3.9
 */


if ( ! defined( 'ABSPATH' ) ) {
	// Encerra se for chamado diretamente (fora do WP).
	exit;
}
/**
 * Main MC Elementor widgets Class
 *
 * A classe init que executa o plugin MC Elementor Widgets.
 * Destinado a garantir que os requisitos mínimos do plugin sejam atendidos.
 *
 * Você só deve modificar as constantes para atender às necessidades do seu plugin.
 *
 * Qualquer código personalizado deve ir dentro da classe Plugin no arquivo class-widgets.php.
 */
final class Mc_Elementor_Widgets {
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Carrega a tradução.
		add_action( 'init', array( $this, 'i18n' ) );
		// Iniciliza o plugin.
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'mc_elementor_widgets' );
	}
	/**
	 * Inicializa o plug-in
    *
    * Valida que o Elementor já está carregado.
    * Verifica os requisitos básicos do plug-in, se uma verificação falhar, não continue,
    * se todas as verificações foram aprovadas, inclua a classe do plugin.
    *
    * Acionado pelo hook action `plugins_loaded`.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		// Verifica se Elementor está instalado e ativado.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}
		// Verifica a versão do Elementor.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}
		// Verifica a versão do PHP.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
		// Quando chegarmos aqui, passamos em todas as verificações de validação para que possamos 
        //incluir nossos widgets com segurança.
		require_once 'class-widgets.php';
	}
	/**
	 * Admin notice
	 *
	 * Avisa quando o site não possui o Elementor instalado ou ativado.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		deactivate_plugins( plugin_basename( MC_ELEMENTOR_WIDGETS ) );
		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
				array(
					'div' => array(
						'class'  => array(),
						'p'      => array(),
						'strong' => array(),
					),
				)
			),
			'MC Elementor Widgets',
			'Elementor'
		);
	}
	/**
	 * Admin notice
	 *
	 * Avisa quando o site não tem a versão mínima do Elementor instalada.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		deactivate_plugins( plugin_basename( MC_ELEMENTOR_WIDGETS ) );
		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
				array(
					'div' => array(
						'class'  => array(),
						'p'      => array(),
						'strong' => array(),
					),
				)
			),
			'MC Elementor Widgets',
			'Elementor',
			self::MINIMUM_ELEMENTOR_VERSION
		);
	}
	/**
	 * Admin notice
	 *
	 * Avisa quando não há a versão mínima do PHP.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		deactivate_plugins( plugin_basename( MC_ELEMENTOR_WIDGETS ) );
		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
				array(
					'div' => array(
						'class'  => array(),
						'p'      => array(),
						'strong' => array(),
					),
				)
			),
			'MC Elementor Widgets',
			'Elementor',
			self::MINIMUM_ELEMENTOR_VERSION
		);
	}
}
// Instantiate Mc_Elementor_Widgets.
new Mc_Elementor_Widgets();


