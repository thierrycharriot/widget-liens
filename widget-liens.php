<?php
/**
 * Plugin Name:     Widget Liens
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     widget-liens
 * Domain Path:     /languages
 * Version:         0.1.0
 * Date: 20220126
 * @package         Widget_Liens
 */

// Your code starts here.

// https://codex.wordpress.org/Widgets_API

class Widget_Liens extends WP_Widget {

	/**
	 * Configurer le nom des widgets, etc.
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget_liens',
			'description' => 'Afficher une liste de liens à partir d\'un fichier json',
		);
		parent::__construct( 'widget_liens', 'Widget Liens', $widget_ops );
	}

	/**
	 * Afficher le contenu du widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// afficher le contenu du widget
		echo $args['before_widget'];
		$requete = ( plugin_dir_path( __FILE__ ) . '/data/liens.json' );
		$reponse = file_get_contents($requete);
		$tableau_liens = json_decode($reponse, true);
		//var_dump($tableau_liens);
		//if (!empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', 'Lien(s) externe(s)' ) . $args['after_title'];
		//}
		//echo esc_html__( 'Hello, Widget_Liens!', 'text_domain' );
		foreach ($tableau_liens as $key => $value):
			# code...
			?>
			<ul style="list-style: none; padding-left: 1.2em;">
				<li><a href="<?php echo($value['url']); ?>"><?php echo($value['name']); ?></a></li>
			</ul>
			<?php
		endforeach;
		?>
        <?php
		
		echo $args['after_widget'];
	}

	/**
	 * Afficher le formulaire d'options sur admin
	 *
	 * @param array $instance The widget options
	 */
	//public function form( $instance ) {
		// afficher le formulaire d'options sur admin
	//}

	/**
	 * Traiter les options du widget lors de l'enregistrement
	 *
	 * @param array $new_instance Les nouvelles options
	 * @param array $old_instance Les options précédentes
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// traiter les options du widget à enregistrer
	}
}

// Cet exemple de widget peut ensuite être enregistré dans le hook 'widgets_init':

// https://developer.wordpress.org/reference/functions/register_widget/
function register_widget_liens() {
    register_widget( 'Widget_Liens' );
}
add_action( 'widgets_init', 'register_widget_liens' );

/// Fin