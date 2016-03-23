<?php
if ( ! function_exists( 'libero_getTwitterFollowers' ) ) :
	function libero_getTwitterFollowers($screenName){
		$numberOfFollowers = 0;
		$url = "http://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=$screenName";
		$data = wp_remote_retrieve_body(wp_remote_get($url, array( 'decompress' => false )));
		if( $data ) {
			$data = json_decode($data);
			if( $data[0]->followers_count )
			$numberOfFollowers = $data[0]->followers_count;
		}
		return $numberOfFollowers;
	}
endif;


if ( ! function_exists( 'libero_getFacebookLike' ) ) :
	function libero_getFacebookLike( $username ) {
		$numberOfLike = 0;
		$url = 'https://api.facebook.com/method/fql.query?format=json&query=SELECT%20share_count,%20like_count,%20comment_count%20FROM%20link_stat%20WHERE%20url%20=%20%27https://facebook.com/'. $username .'%27';
		
		$facebook_count = wp_remote_retrieve_body(wp_remote_get($url, array( 'decompress' => false )));
		if( $facebook_count ){
			$body = json_decode($facebook_count);
			if( is_array($body) && isset($body[0]->like_count) ){
				$numberOfLike = $body[0]->like_count;
			}
		}
		return $numberOfLike;
	}
endif;


if ( ! function_exists( 'libero_getYoutubeSubs' ) ) :
	function libero_getYoutubeSubs( $user ) {
		$numberOfFollowers = 0;
		$apikey = 'AIzaSyC7O1LDLcibVQoTQyB8LlB0mHPhZLni5s8';
		$url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id='. $user .'&key=' . $apikey;
		$youtube = wp_remote_retrieve_body(wp_remote_get($url, array( 'decompress' => false )));
		if( $youtube ) {
			$youtube = json_decode( $youtube, true );
			if( intval($youtube['items'][0]['statistics']['subscriberCount']) ) 
			$numberOfFollowers = intval($youtube['items'][0]['statistics']['subscriberCount']);
		}
		return $numberOfFollowers;
	}
endif;
