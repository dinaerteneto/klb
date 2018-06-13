<?php
/**
 * Plugin Name:     Connect Plugin
 * Plugin URI:      http://
 * Description:     Este plugin vai ler uma API e mostrar em uma página
 * Author:          Dinaerte de assis Neto
 * Author URI:      http://
 * Text Domain:     connect-plugin
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Connect_Plugin
 */

/**
 * Função para conectar
 */
add_action('my_action','connect_plugin');
function connect_plugin() {	
	Timber::render( './views/search.twig');
}

add_action('wp_ajax_nopriv_weather', 'ajax_weather');
function ajax_weather()
{

	$key = '5e4f36758091a45aa43122896c1dd2b7';
	$city = $_POST['city'];
	$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$key}";
	$obj = json_decode(file_get_contents($url));

	$return = [
		'icon' => $obj->weather[0]->icon,
		'name' => $obj->name,
		'country' => $obj->sys->country,
		'temperature' => [
			'description' => $obj->weather[0]->description,
			'current' => number_format($obj->main->temp - 273.15, 1, '.', ''),
			'min' => $obj->main->temp_min - 273.15,
			'max' => $obj->main->temp_max - 273.15,
		]
	];

	Timber::render('./views/return.twig', ['return' => $return]);
	exit;
}

add_action('wp_enqueue_scripts', 'register_plugin_styles');
function register_plugin_styles()
{
	wp_register_style('css-connect', plugins_url('connect/assets/css/connect.css'));
	wp_register_style('css-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css');
	wp_enqueue_style('css-connect');
	wp_enqueue_style('css-bootstrap');
	wp_enqueue_script('js-connect', plugins_url('connect/assets/js/connect.js'), array('jquery'), '1.01', true);

	wp_localize_script(
		'js-connect',
		'ajax_object',
		array('ajax_url' => admin_url('admin-ajax.php'))
	);
}




/* function json_response($message = null, $code = 200)
{
    // clear the old headers
	header_remove();
    // set the actual code
	http_response_code($code);
    // set the header to make sure cache is forced
	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
	header('Content-Type: application/json');
	$status = array(
		200 => '200 OK',
		400 => '400 Bad Request',
		422 => 'Unprocessable Entity',
		500 => '500 Internal Server Error'
	);
    // ok, validation error, or failure
	header('Status: ' . $status[$code]);
    // return the encoded json
	return json_encode(array(
		'status' => $code < 300, // success or not?
		'message' => $message
	), JSON_PRETTY_PRINT);
} */