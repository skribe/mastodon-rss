==================== Mastodon RSS =============================
 Plugin URI:        https://github.com/skribe/mastodon-rss
 Description:       A plugin to properly format mastodon rss feeds to be displayed in Wordpress.
 Version:           1.0.1
 Requires at least: 6.1
 Tested up to:      6.1.1
 Requires PHP:      7.4
 Author:            skribe
 Author URI:        https://github.com/skribe
 License:           GPL v3
 License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 Tags:              rss, mastodon, mastodon widget, Mastodon RSS, Mastodon RSS Widget, toots, toot

===== What it does =====

    It's a Wordpress widget to show Mastodon RSS feeds. 

===== Technical reason for using this widget =====

    - Mastodon rss feeds don't use an item title tag.  
    
    - With a 'normal' RSS widget this means that the feed looks something like this:

    (Untitled)
    (Untitled)
    (Untitled)

    Ugly!!

    With this widget your feeds should look more like this:

    skribe
    5 December, 2022 @ 11:44am
    This is a really good widget I'm using

    skribe
    5 December, 2022 @ 11:42am
    I've just installed the Wordpress Plugin, Mastodon-RSS.  Strewth, it's amazing!


===== Technical reasons for not using this widget ===== 

    This is the first Wordpress plugin.

    It's very basic.

===== Installation and Use ======

1. Install by uploading as you would any other wordpress plugin.
2. Activate plugin
3. Go to Appearance->Widgets
4. Add widget to the preferred location.  It's called Mastodon RSS Widget (you'll probably need to search for it)
5. In the widget settings include the RSS feed from Mastodon (it needs to be from Mastodon otherwise it won't work)
6. Update
7. It works! (hopefully).

===== Support and bugs =====

https://github.com/skribe/mastodon-rss
