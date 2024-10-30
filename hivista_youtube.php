<?php
/*
Plugin Name: Hivista youtube
Plugin URI: http://www.wordpresstalk.net
Description: Hivista YouTube embed video with thumbnail image.
Version: 1.0
Author: Guriev Eugen
Author URI: http://www.wordpresstalk.net
*/

class HivistaYouTube{
	//                          __              __      
	//   _________  ____  _____/ /_____ _____  / /______
	//  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
	// / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
	// \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
	const PLUGIN_FOLDER = 'hivista_youtube';
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	protected $plugin_path;
	protected $plugin_url;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		$this->plugin_path = dirname(__FILE__);
		$this->plugin_url  = WP_PLUGIN_URL.'/'.self::PLUGIN_FOLDER;
		// =========================================================
		// HOOKS
		// =========================================================
		add_shortcode('hivista_youtube', array($this, 'displayYouTube'));
		// =========================================================
		// Just for theme
		// =========================================================
		if(!is_admin())
		{
			wp_enqueue_style('hivista_youtube', $this->plugin_url.'/css/hivista_youtube.css'); 
			wp_enqueue_script('hivista_youtube', $this->plugin_url.'/js/hivista_youtube.js');
		}
	}

	/**
	 * Replace short code to embed video from YouTube
	 * @param  array  $args    
	 * @param  string $content 
	 * @return string          
	 */
	public function displayYouTube($args, $content = 'lgT1AidzRWM')
	{
		$args     	= $this->setDefaultArgs($args);
		extract($args);
		$youtube  	= '<embed style="visibility: hidden;" allowScriptAccess="always" id="'.$id.'" src="http://www.youtube.com/v/'.$content.'?fs=1&hl=en_US&enablejsapi=1&playerapiid=yt" type="application/x-shockwave-flash"     width="'.$width.'" height="'.$height.'"></embed>';
		$thumb      = (isset($args['thumbnail'])) ? strip_tags($args['thumbnail']) : 'http://placehold.it/'.$width.'x'.$height;
		$str 		= '<div class="media">		
							'.$youtube.'		
							<div id="youtube-controls" style="position: absolute; top: 0;">		
								<a href="#" class="btn big pink btn-youtube" onclick="playYouTube(); return false;"><span>play video</span><i class="video"></i></a>
								<img src="'.$thumb.'" alt="image description" class="youtube-thumb">
							</div>
						</div>';
		return $str;
	}

	/**
	 * Set default args
	 * @param  array $args
	 * @return array
	 */
	private function setDefaultArgs($args)
	{
		$default_args = array(
			'id'     => 'yt',			
			'width'  => 490,
			'height' => 296);

		foreach ($default_args as $key => $value) 
		{
			if(!isset($args[$key]))
			{
				$args[$key] = $value;
			}
		}
		return $args;
	}
}
// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['hivista_youtube'] = new HivistaYouTube();