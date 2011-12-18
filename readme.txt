=== Hacklog-Xiami ===
Contributors: ihacklog
Donate link: http://ihacklog.com/about
Tags: music, shortcode
Requires at least: 3.3
Tested up to: 3.3
Stable tag: 1.0.1

此插件为在日志中添加虾米音乐(单曲或专辑)提供方便，添加了WordPress短代码支持.

== Description ==
此插件为在日志中添加虾米音乐(单曲或专辑)提供方便，添加了WordPress短代码支持.
如要插入虾米音乐(单曲或专辑)，只需要用短代码[xiami]包裹单曲或专辑URL地址即可
如
`[xiami]歌曲URL[/xiami]`
`[xiami]专辑URL[/xiami]`

可以指定宽度和高度，如:
[xiami width="300" height="40"]歌曲URL[/xiami]
[xiami width="400" height="500"]专辑URL[/xiami]
后台HTML编辑器添加了**xiami**按钮，方便操作。

1.0.1版采用新的WordPress 3.3 quicktags API来创建按钮，如果你还在用3.3以前的版本，请安装本插件1.0.0版。

This plugin adds shortcode support for inserting xiami song or album widget to your blog posts conveniently.

For MORE information,please see [Plugin page](http://ihacklog.com/?p=4901 "Plugin page") 


== Installation ==

1. Upload the whole fold `hacklog-xiami` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add xiami song OR album via click the **xiami**  button OR your can type the shortcode manually.

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png


== Changelog ==
= 1.0.1 =
* upgraded: use new WordPress 3.3 quicktags API to create the button.
* fixed: use admin_print_footer_scripts HOOK to print the javascript to ensure that it is print behind the quicktags.js

= 1.0.0 =
published the first version


					
