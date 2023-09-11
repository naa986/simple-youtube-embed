<?php
/*
Plugin Name: Simple YouTube Embed
Version: 1.1.0.4
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
        var $plugin_version = '1.1.0.4';
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
                include_once('extensions/simple-youtube-embed-extensions.php');
            }
            add_action('plugins_loaded', array($this, 'plugins_loaded_handler'));
            add_action('admin_menu', array( $this, 'add_options_menu' ));
            //add_action('wp_head', 'simple_youtube_video_embed_js');
            add_filter('embed_oembed_html', 'simple_youtube_video_embed', 10, 4);
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
            if(is_admin() && current_user_can('manage_options'))
            {
                add_filter('plugin_action_links', array($this, 'add_plugin_action_links'), 10, 2 );
            }
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
            $plugin_tabs = array(
                'simple-youtube-embed-settings' => __('Extensions', 'simple-youtube-embed'),
                //'simple-youtube-embed-settings&action=extensions' => __('Extensions', 'simple-youtube-embed')
            );
            $url = "https://noorsplugin.com/simple-youtube-embed-plugin/";
            $link_text = sprintf(wp_kses(__('Please visit the <a target="_blank" href="%s">Simple YouTube Embed</a> documentation page for usage instructions.', 'simple-youtube-embed'), array('a' => array('href' => array(), 'target' => array()))), esc_url($url));          
            echo '<div class="wrap">';
            echo '<h2>Simple YouTube Embed - v'.$this->plugin_version.'</h2>';
            echo '<div class="notice notice-info">'.$link_text.'</div>';
            echo '<div id="poststuff"><div id="post-body">';
            
            if (isset($_GET['page'])) {
                $current = sanitize_text_field($_GET['page']);
                if (isset($_GET['action'])) {
                    $current .= "&action=" . sanitize_text_field($_GET['action']);
                }
            }
            $content = '';
            $content .= '<h2 class="nav-tab-wrapper">';
            foreach ($plugin_tabs as $location => $tabname) {
                if ($current == $location) {
                    $class = ' nav-tab-active';
                } else {
                    $class = '';
                }
                $content .= '<a class="nav-tab' . $class . '" href="?page=' . $location . '">' . $tabname . '</a>';
            }
            $content .= '</h2>';
            echo $content;

            if(isset($_GET['action']))
            { 
                switch ($_GET['action'])
                {
                    case 'extensions':
                        simple_youtube_embed_display_extensions();
                        break;
                }
            }
            else
            {
                simple_youtube_embed_display_extensions();
            }
        
            echo '</div></div>';
            echo '</div>';
        }
        
    }
    $GLOBALS['simple_youtube_embed'] = new SIMPLE_YOUTUBE_EMBED();
}

function simple_youtube_video_embed($html, $url, $attr, $post_ID)
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
    /* WordPress automatically adds ?feature=oembed to YouTube iframe src. This causes an error in search console: Google could not determine the prominent video on the page */            
    if(strpos($src, 'feature') !== false){
        $src = remove_query_arg('feature', $src);
        $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
    }
    //    
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
    if(isset($data['mute']) && $data['mute']=="1"){
        if(strpos($src, 'mute') === false){
            $src = add_query_arg('mute', '1', $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }
    if(isset($data['playlist']) && !empty($data['playlist'])){
        if(strpos($src, 'playlist') === false){
            $src = add_query_arg('playlist', $data['playlist'], $src);
            $html = preg_replace('/src="(.*?)"/', 'src="'.$src.'"', $html);
        }
    }
    
    $html = apply_filters('simple_youtube_embed_oembed_html', $html, $url, $attr, $post_ID, $data, $src);

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
