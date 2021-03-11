<?php
/*
Plugin Name: Simple YouTube Embed
Version: 1.0.9
Plugin URI: https://noorsplugin.com/simple-youtube-embed-plugin/
Author: naa986
Author URI: https://noorsplugin.com/
Description: Embed YouTube videos in WordPress with native lazy loading support
Text Domain: simple-youtube-embed
Domain Path: /languages 
*/

if(!defined('ABSPATH')) exit;
if(!class_exists('SIMPLE_YOUTUBE_EMBED'))
{
    class SIMPLE_YOUTUBE_EMBED
    {
        var $plugin_version = '1.0.9';
        var $plugin_url;
        var $plugin_path;
        function __construct()
        {
            define('SIMPLE_YOUTUBE_EMBED_VERSION', $this->plugin_version);
            define('SIMPLE_YOUTUBE_EMBED_SITE_URL',site_url());
            define('SIMPLE_YOUTUBE_EMBED_URL', $this->plugin_url());
            define('SIMPLE_YOUTUBE_EMBED_PATH', $this->plugin_path());
            $this->plugin_includes();
            //add_action( 'wp_enqueue_scripts', array( $this, 'plugin_scripts' ), 0 );
        }
        function plugin_includes()
        {
            if(is_admin( ) )
            {
                add_filter('plugin_action_links', array($this,'add_plugin_action_links'), 10, 2 );
            }
            add_action('plugins_loaded', array($this, 'plugins_loaded_handler'));
            add_action('admin_menu', array( $this, 'add_options_menu' ));
            //add_action('wp_head', 'simple_youtube_video_embed_js');
            add_filter('embed_oembed_html', 'simple_youtube_video_embed', 10, 3);
        }
        function plugin_scripts()
        {
            if (!is_admin()) 
            {
                wp_enqueue_script('jquery');
                wp_register_script('waitforimages', SIMPLE_YOUTUBE_EMBED_URL.'/jquery.waitforimages.min.js', array('jquery'), SIMPLE_YOUTUBE_EMBED_VERSION);
                wp_enqueue_script('waitforimages');
                wp_register_script('prettyembed', SIMPLE_YOUTUBE_EMBED_URL.'/jquery.prettyembed.min.js', array('jquery'), SIMPLE_YOUTUBE_EMBED_VERSION);
                wp_enqueue_script('prettyembed');
                wp_register_script('fitvids', SIMPLE_YOUTUBE_EMBED_URL.'/jquery.fitvids.js', array('jquery'), SIMPLE_YOUTUBE_EMBED_VERSION);
                wp_enqueue_script('fitvids');
            }
        }
        function plugin_url()
        {
            if($this->plugin_url) return $this->plugin_url;
            return $this->plugin_url = plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
        }
        function plugin_path(){ 	
            if ( $this->plugin_path ) return $this->plugin_path;		
            return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
        }
        function add_plugin_action_links($links, $file)
        {
            if ( $file == plugin_basename( dirname( __FILE__ ) . '/main.php' ) )
            {
                $links[] = '<a href="options-general.php?page=simple-youtube-embed-settings">'.__('Settings', 'simple-youtube-embed').'</a>';
            }
            return $links;
        }
        
        function plugins_loaded_handler()
        {
            load_plugin_textdomain('simple-youtube-embed', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
        }

        function add_options_menu()
        {
            if(is_admin())
            {
                add_options_page(__('Simple YouTube Embed', 'simple-youtube-embed'), __('Simple YouTube Embed', 'simple-youtube-embed'), 'manage_options', 'simple-youtube-embed-settings', array($this, 'display_options_page'));
            }
        }
        
        function display_options_page() 
        {
            $url = "https://noorsplugin.com/simple-youtube-embed-plugin/";
            $link_text = sprintf(wp_kses(__('Please visit the <a target="_blank" href="%s">Simple YouTube Embed</a> documentation page for usage instructions.', 'simple-youtube-embed'), array('a' => array('href' => array(), 'target' => array()))), esc_url($url));
            ?>
            <div class="wrap"><h2>Simple YouTube Embed - v<?php echo $this->plugin_version; ?></h2>
            <div class="update-nag"><?php echo $link_text;?></div>
            </div>
            <?php
        }
        
    }
    $GLOBALS['simple_youtube_embed'] = new SIMPLE_YOUTUBE_EMBED();
}

function simple_youtube_video_embed($html, $url, $attr)
{
    if(is_admin()){ //do not filter in visual mode so the video preview is shown
        return $html;
    }
    $data = array();
    $parsed_url = parse_url($url); //parse the url to get query parameters
    if(isset($parsed_url['query']) && !empty($parsed_url['query'])){
        parse_str($parsed_url['query'], $data); //get query parameters into an array
    }
    else{
        return $html; 
    }
    $src = '';
    preg_match('/src="(.*?)"/', $html, $matches);
    if(isset($matches[1]) && !empty($matches[1])){
        $src = $matches[1];
    }
    else{
        return $html;
    }
    if(isset($data['autoplay']) && $data['autoplay']=="1"){
        if(strpos($src, 'autoplay') === false){
            $src = add_query_arg('autoplay', '1', $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }
    if(isset($data['controls']) && $data['controls']=="0"){
        if(strpos($src, 'controls') === false){
            $src = add_query_arg('controls', '0', $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }
    if(isset($data['fs']) && $data['fs']=="0"){
        if(strpos($src, 'fs') === false){
            $src = add_query_arg('fs', '0', $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }
    if(isset($data['rel']) && $data['rel']=="0"){
        if(strpos($src, 'rel') === false){
            $src = add_query_arg('rel', '0', $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }

    return $html; 
}

function simple_youtube_video_embed_js()
{
    $output = <<<EOT
    <script type="text/javascript" charset="utf-8">
        /* <![CDATA[ */
        jQuery(document).ready(function($){
            $(function(){
                $().prettyEmbed({ useFitVids: true });
            });
        });
        /* ]]> */
        </script>
EOT;
    echo $output;
}
