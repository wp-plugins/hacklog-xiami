<?php
/*
 Plugin Name: Hacklog-Xiami
 Plugin URI: http://ihacklog.com/?p=4901
 Description: 此插件为在日志中添加虾米音乐(单曲或专辑)添加WordPress短代码支持.This plugin adds shortcode support for inserting xiami song or album widget to your blog posts conveniently.
 Version: 1.0.1
 Author: <a href="http://ihacklog.com/">荒野无灯</a>
 Author URI: http://ihacklog.com/
 */

/**
 * $Id$
 * $Revision$
 * $Date$
 * @package Hacklog-Xiami
 * @encoding UTF-8 
 * @author 荒野无灯 <HuangYeWuDeng> 
 * @link http://ihacklog.com 
 * @copyright Copyright (C) 2011 荒野无灯 
 * @license http://www.gnu.org/licenses/
 */

/*
 Copyright 2011  荒野无灯 

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


class hacklog_xiami
{
	protected static $_song_w = 257;
	protected static $_song_h = 33;
	protected static $_album_w = 235;
	protected static $_album_h = 346;

	public static function init()
	{
		add_shortcode( 'xiami',array(__CLASS__, 'xiami_shortcode_handler') );
		add_action('admin_footer',array(__CLASS__,'ihacklog_add_xiami_tag'),99);
	}
	// [xiami width="257" height="33"]the url[/xiami]
	public static function xiami_shortcode_handler( $atts, $content=null, $code="" ) 
	{
		$ret = '['. $code .']'. $content . '[/'. $code . ']';
		$type = 'song';
		if( empty( $content ) )
		{
			return $ret;
		}
		$content = strtolower( $content);
		$content = str_replace('http://','', $content);
		$song_or_album = explode('/', $content);
		if(count( $song_or_album )< 3 )
		{
			return $ret;
		}
		$type = $song_or_album[1];
		$song_or_album_id = (int) $song_or_album[2];
		if( $song_or_album_id <= 0 || !in_array($type, array('song','album') ) )
		{
			return $ret;
		}
		switch($type)
		{
		case 'song':
			extract( shortcode_atts( array(
				'width' => self::$_song_w,
				'height' => self::$_song_h,
			), $atts ) );
			$ret =sprintf('<embed src="http://www.xiami.com/widget/0_%d/singlePlayer.swf" type="application/x-shockwave-flash" width="%d" height="%d" wmode="transparent"></embed>',
				$song_or_album_id, $width, $height);
			break;
		case 'album':
			extract( shortcode_atts( array(
				'width' => self::$_album_w,
				'height' => self::$_album_h,
			), $atts ) );
			$ret =sprintf('<embed src="http://www.xiami.com/widget/1459146_%d_%d_%d_5695c1_457cb4/albumPlayer.swf" type="application/x-shockwave-flash" width="%d" height="%d" wmode="opaque"></embed>',
				$song_or_album_id, $width, $height, $width, $height);
			break;
		}
		return $ret;
	}

	public static function ihacklog_add_xiami_tag()
	{
		if ( !strpos($_SERVER['SCRIPT_NAME'], 'post.php') && !strpos($_SERVER['SCRIPT_NAME'], 'post-new.php')) 
		{
			return '';
		}
		echo <<<EOT
		<script type="text/javascript">
		QTags.addButton('xiami' ,'xiami' , hacklogInsertXiami ,'','x', 'Insert xiami song or album');
		function hacklogInsertXiami() 
		{
				var U = prompt('Enter song OR album URL' , 'http://');
				if(!U)
					return false;
				/*
				var W = prompt('Enter width' , '257');
				var H = prompt('Enter height' , '33');
				*/
				QTags.insertContent('[xiami]'+U+'[/xiami]');
		}
		</script>
EOT;
	}

}//enc class hacklog_xiami

//run
hacklog_xiami::init();

