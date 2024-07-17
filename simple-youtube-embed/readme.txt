=== Simple YouTube Embed ===
Contributors: naa986
Donate link: https://noorsplugin.com/
Tags: youtube, video, embed, iframe, responsive
Requires at least: 3.0
Tested up to: 6.6
Stable tag: 1.1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embed YouTube videos in WordPress beautifully. Embed YouTube video with a URL or shortcode and customize the player using this YouTube embed plugin.

== Description ==

[Simple YouTube Embed](https://noorsplugin.com/simple-youtube-embed-plugin/) plugin is the easiest way to embed YouTube videos in WordPress. This plugin extends the default YouTube embed with advanced player parameters.

https://www.youtube.com/watch?v=-8yCP-CnUSQ&rel=0

Unlike other YouTube plugins, It doesn't replace your on-page video embed code with JavaScript/HTML code. Loading a video with JavaScript doesn't provide any video SEO benefit as a search engine crawler will only see some code instead of the actual video object. 

Simple YouTube Embed is easy to use because there is no setting to configure. It uses the oEmbed API so your videos will be responsive and provide all the benefits that core WordPress YouTube embed has to offer. YouTube videos on your website will continue to work even if you choose to deactivate the plugin.

=== Features ===

* Responsive and mobile friendly.
* Proper YouTube video embed with no additional JavaScript code.
* No setting to configure. Install, activate and start using it.
* No YouTube API key needed.
* Embed YouTube videos in WordPress with the YouTube block.
* Automatically play a video.
* Enable/Disable display of suggested videos when the video finishes.
* Enable/Disable player controls.
* Enable/Disable fullscreen.
* Mute a YouTube Video.

=== Simple YouTube Embed Extensions ===

* [YouTube Advanced Parameters](https://noorsplugin.com/simple-youtube-embed-plugin/)

=== How to Use the YouTube Embed Plugin in WordPress ===

Create a new post/page and add a YouTube block. Copy and paste the YouTube video URL into it. For example:

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g`

**YouTube Video Autoplay**

In order to automatically play a video you can add "autoplay=1" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&autoplay=1`

**Related YouTube Videos**

In order to disable related videos from showing you can add "rel=0" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&rel=0`

**YouTube Video Controls**

If you do not want to show player controls you can add "controls=0" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&controls=0`

**YouTube Video Fullscreen**

If you do not want to allow fullscreen option in the player you can add "fs=0" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&fs=0`

**YouTube Video Mute**

To start a video in the muted state you can add "mute=1" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&mute=1`

**YouTube Video Playlist**

If you want to turn a video into a single-video playlist you can add "playlist=VIDEO_ID" to your YouTube URL.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&playlist=Vpg9yizPP_g`

=== YouTube Advanced Parameters ===

With the Advanced Parameters extension you can use additional advanced parameters in your YouTube videos.

**color**

This parameter specifies the color that will be used in the player's video progress bar to highlight the amount of the video that the viewer has already seen.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&color=white`

Valid parameter values are red and white, and, by default, the player uses the color red in the video progress bar.

Note: Setting the color parameter to white will disable the modestbranding option.

**disablekb**

Setting this parameter's value to 1 causes the player to not respond to keyboard controls. The default value is 0.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&disablekb=1`

**end**

This parameter specifies the time, measured in seconds from the start of the video, when the player should stop playing the video. The parameter value is a positive integer.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&end=10`

The time is measured from the beginning of the video and not from the value of the start player parameter.

**modestbranding**

This parameter lets you use a YouTube player that does not show a YouTube logo. Setting the parameter value to 1 prevent the YouTube logo from displaying in the control bar.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&modestbranding=1`

**start**

This parameter causes the player to begin playing the video at the given number of seconds from the start of the video. The parameter value is a positive integer.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&start=5`

**loop**

This parameter causes the video to play repeatedly. The parameter value is a positive integer (e.g. loop="1").

In order for the loop feature to work, the video needs to be turned into a single-video playlist as well.

`https&#58;//www.youtube.com/watch?v=Vpg9yizPP_g&playlist=Vpg9yizPP_g&loop=1`

For documentation please visit the [YouTube](https://noorsplugin.com/simple-youtube-embed-plugin/) plugin page

== Installation ==

1. Go to the Add New plugins screen in your WordPress Dashboard
1. Click the upload tab
1. Browse for the plugin file (simple-youtube-embed.zip) on your computer
1. Click "Install Now" and then hit the activate button

== Frequently Asked Questions ==

= Can I use this plugin to embed YouTube videos with High Quality Thumbnails? =

Yes.

= Is this plugin responsive? =

Yes.

== Screenshots ==

1. Simple YouTube Embed Demo

== Upgrade Notice ==
none

== Changelog ==

= 1.1.0.4 =
* Additional check for the settings link.

= 1.1.0.3 =
* Added support for the mute parameter.

= 1.1.0.2 =
* Some cleanup for the oEmbed url.

= 1.1.0.1 =
* Added a parameter to turn a video into a playlist.

= 1.1.0 =
* Added support for YouTube advanced parameters.

= 1.0.9 =
* WordPress 5.7 compatibility update.

= 1.0.8 =
* Added native lazy loading support for YouTube videos.

= 1.0.7 =
* Some improvements to make it compatible with the block based editor.

= 1.0.6 =
* A preview of the YouTube video is now shown in the visual editor instead of a blank background.

= 1.0.5 =
* Compatible with WordPress 4.8
* Updated all the permalinks

= 1.0.4 =
* Added an option to prevent video information from displaying in the YouTube player
* Added an option to prevent fullscreen button from displaying in the YouTube player
* Updated the translation files so the plugin can take advantage of language packs
* Simple YouTube Embed is now compatible with WordPress 4.4

= 1.0.3 =
* Simple YouTube Embed is now compatible with WordPress 4.3

= 1.0.2 =
* Fixed "black bars" that would show up on the sides of the video and thumbnail
* If high definition is not available for a video it will embed with a low quality thumbnail
* Added an option to disable related videos
* Added an option to disable player controls

= 1.0.1 =
* First commit
