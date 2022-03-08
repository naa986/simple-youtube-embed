<?php

function simple_youtube_embed_display_extensions()
{
    //echo '<div class="wrap">';
    //echo '<h2>' .__('Simple YouTube Embed Extensions', 'simple-youtube-embed') . '</h2>';
    echo '<link type="text/css" rel="stylesheet" href="'.SIMPLE_YOUTUBE_EMBED_URL.'/extensions/simple-youtube-embed-extensions.css" />' . "\n";
    
    $extensions_data = array();

    $extension_1 = array(
        'name' => 'Advanced Parameters',
        'thumbnail' => SIMPLE_YOUTUBE_EMBED_URL.'/extensions/images/simple-youtube-embed-advanced-parameters.png',
        'description' => 'Embed a YouTube video with advanced parameters',
        'page_url' => 'https://noorsplugin.com/simple-youtube-embed-plugin/',
    );
    array_push($extensions_data, $extension_1);
    
    //Display the list
    $output = '';
    foreach ($extensions_data as $extension) {
        $output .= '<div class="simple_youtube_embed_extensions_item_canvas">';

        $output .= '<div class="simple_youtube_embed_extensions_item_thumb">';
        $img_src = $extension['thumbnail'];
        $output .= '<img src="' . $img_src . '" alt="' . $extension['name'] . '">';
        $output .= '</div>'; //end thumbnail

        $output .='<div class="simple_youtube_embed_extensions_item_body">';
        $output .='<div class="simple_youtube_embed_extensions_item_name">';
        $output .= '<a href="' . $extension['page_url'] . '" target="_blank">' . $extension['name'] . '</a>';
        $output .='</div>'; //end name

        $output .='<div class="simple_youtube_embed_extensions_item_description">';
        $output .= $extension['description'];
        $output .='</div>'; //end description

        $output .='<div class="simple_youtube_embed_extensions_item_details_link">';
        $output .='<a href="'.$extension['page_url'].'" class="simple_youtube_embed_extensions_view_details" target="_blank">View Details</a>';
        $output .='</div>'; //end detils link      
        $output .='</div>'; //end body

        $output .= '</div>'; //end canvas
    }
    echo $output;
    
    //echo '</div>';//end of wrap
}
