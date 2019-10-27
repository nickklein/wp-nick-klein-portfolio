<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( '_partials', '_views', '_layouts', '_modules' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
include 'custom_posts/projects.php';
include 'custom_posts/taxonomy-project_categories.php';
include 'custom_posts/taxonomy-project_skills.php';

class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	public function add_to_context($context) {
		$context['options'] = get_fields('options');
		return $context;
	}

	public function slugify($text) {
			  // replace non letter or digits by -
			  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

			  // transliterate
			  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

			  // remove unwanted characters
			  $text = preg_replace('~[^-\w]+~', '', $text);

			  // trim
			  $text = trim($text, '-');

			  // remove duplicate -
			  $text = preg_replace('~-+~', '-', $text);

			  // lowercase
			  $text = strtolower($text);

			  if (empty($text)) {
			    return 'n-a';
			  }

			  return $text;
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	public function get_category_classes($project) {
		$string = '';
		$categories = $project->terms( 'project_categories' );
		if (!empty($categories)) {
			foreach($categories as $category) {
				$string .= $category->slug . ' ';
			}
		}
		return $string;
	}

	public function get_category() {
		$terms = get_terms( 'project_categories', array(
		    'hide_empty' => false,
		) );
		return $terms;
	}

	public function get_skills($project) {
		$return = array();
		$categories = $project->terms( 'project_skills' );
		if (!empty($categories)) {
			foreach($categories as $category) {
				$return[] = $category->slug;
			}
			return $return;
		}
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( new Twig_SimpleFilter( 'slugify', array( $this, 'slugify' ) ) );
		$twig->addFilter( new Twig_SimpleFilter( 'get_category_classes', array( $this, 'get_category_classes' ) ) );
		$twig->addFilter( new Twig_SimpleFilter( 'get_category', array( $this, 'get_category' ) ) );
		$twig->addFilter( new Twig_SimpleFilter( 'get_skills', array( $this, 'get_skills' ) ) );
		return $twig;
	}

}

new StarterSite();



//Save & load ACF fields to folder
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}



function script_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js',false, '3.3.1', true);
		wp_enqueue_script('jquery');
	}

	wp_register_script('app', get_bloginfo('template_url') . '/js/app.js', array('jquery'), true, true);
	wp_enqueue_script('app');
}
add_action('wp_enqueue_scripts', 'script_init');


// Register the global option page for editing templates
if(function_exists('register_options_page')) {
  register_options_page('General');
}
