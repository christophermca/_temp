=== Like-Button-Plugin-For-Wordpress ===
Contributors: GangXtaBoii
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG
Tags: facebook, like button, open graph protocol, social plugins, fb, plugins, for wordpress, button, widget, sidebar widget, shortcode, like, generator, gb world, share, socialwidget, likebutton, fb, gbworld, gangxtaboii, meta tags, shortcode like, gbwiki, gb-world, dynamic, exclude, live support
Requires at least: 2.7.x
Tested up to: 3.0.4
Stable tag: trunk

This plugin adds a Like-Button wherever you want on your blog. Before or after the content as well as a sidebar-widget. And many more!

== Description ==

**Features**

*   Plugin is available in English and in German
*   the Button can be individualy created for every site or one button for the whole blog
*   you can exclude sites which won't get a like button
*   individual button position (before/after the content)
*   add all available OpenGraph Meta-Tags
*   you can individually design your Like-Button with css (css-Class)
*   our Like-Button-Generator makes it even more easier for you to create a Like Button
*   Analyse your Blog: Analyse the activity of your visitors and their likes
*   Use iFrame or XFBML-Button (with share and comment functionality)
*   use a shortcode to insert the like-Button
*   create a Like-Button Sidebar-Widget (also individual Like-Button for every Site/Post or one Like-Button for the whole site.
*   Recommendations-Sidebar-Widget: you can also add a Recommendations-Widget to your Sidebar
*   Live [Support/BugTracker](http://bugs.gb-world.net/) in our Forum and [FanPage](http://www.facebook.com/GBWorldnet)
*   easily connect your Facebook-Account, Fanpage or Application with the Like-Button on your blog
*   Dashboard-Widget which shows you your blog-recommendations
*   Individual Description-Tag for every post/page of your blog
*   Shortcode-Only-Modus: If you just like the Shortcode and you do not anything else
*   you can choose a individual (fb-)image for each post/page
*   Exclude Pages with their ID or with a single click on the checkbox on every Post-/Page-Edit Site
*   design your like-Button individually from the settings page with the CSS-Box
*   Recommendation-Sidebar: it is also possible to add this Widget beside the Like-Button Widget
*   and many more (read more in our wiki or Changelog)

**Facebook-Like-Button**

This plugin adds a Like-Button after every post/page you choose (you can exclude Posts/Pages/..., These excluded sites will have no Like-Button). The Like-Button-Widget includes a little Like-Button-Generator to make it easier for you to get a Like-Button to your sidebar. It also adds a Shortcode for your like-Button. It is also possible to choose the XFBML or the iframe-Button. You could also choose the position of your like-button within the post/page.

**Shortcode**

It also adds a Shortcode `[like]` or `[like url=http://www.gb-world.net]` which inserts the code for your Facebook-Like-Button. You can create a like-Button with the FB-LB-Generator on the settings-page. After that it is possible to create some Open-Graph-Protocol-Meta-Tags which will be written in the <head>-section. Also the JavaSDK will be used for your Buttons. But only if you enter a valid Facebook-AppID into the AppID-Box.

Now you can put the shortcode `[like]` or with the url-attribute (`[like url=http://www.gb-world.net]`) where ever you want to insert the Facebook-Like-Button.

**Widget**

There is also a new Widget available. Go to the Widget-Page and add the Facebook-Like-Button-Generator to your sidebar. Enter all your information into the FB-LB-Generator - that's it.

**Live-Support**

Since 3.0 there is a new GB-World-Page available with our Like-Box. You can post your bugs, issues, support-requests now also into this like-box and not only into our forum.

**Bugs and Support**

If you find any bugs **please report** them at our BugTracker: | [BugTracker](http://bugs.gb-world.net) |


**Translation**

We need your help to translate our plugin into more different languages (currently only English and German is supported). Write a new topic in our forum if you would like to help us. Thx!
Internationalization Support: English, Deutsch

| [GB-World-Post](http://www.gb-world.net/like-button-plugin-for-wordpress) |
| [FanPage](http://www.facebook.com/GBWorldnet) |
| [GB-Wiki](http://wiki.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |
| [Tutorial](http://www.facebook.com/GBWorldnet?v=app_2392950137) |
| [Support](http://www.facebook.com/GBWorldnet) |

== Installation ==

Extract the zip file and just drop the contents in the `/wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

Make sure that your template has the `wp_footer();` in its footer.php-file.

After that visit the General-Setting Page on the bottom of the Menu and activate the Like-Button via the first Checkbox. After that you have to generate the Button with the Generator below and define the Position-Settings on the Position-Setting-Tab. Then hit the save button and you're done! All the other pages include different and additional options!

== Frequently Asked Questions ==

**Short-FAQ:** 

**1.**

*   Install the Plugin

**2.** 

*   Go to the Settings-Page and complete all the required information and activate the Plugin with the first checkbox on this site.


**3.XFBML (Java-SDK) or iFrame**

*   The basic Like button is available via a simple iframe you can drop into your page easily. A fuller-featured Like button is available via the &lt;fb:like&gt; XFBML tag and requires you use the new JavaScript SDK. The XFBML version allows users to add a comment to their like as it is posted back to Facebook. The XFBML version also dynamically sizes its height; for example, if there are no profile pictures to display, the plugin will only be tall enough for the button itself. (definition by Facebook)


**4. Facebook-Generator-FAQ:**

*   The URL must look like this -> http://example.com. Otherwise the Button will not work properly.

*   Now choose your layout style, width, height, font, verb to display, color scheme and if faces should be shown.

*   Language: It is possible to choose a language for your button. But keep in mind that you have to activate the Java-SDK and you must have a valid appID.

*   Dynamic Like-Button: Every page will have its own unique like-button if you activate this checkbox. Otherwise every page will use the same facebook-like-button.

**5. [like]-Shortcode**
*   You only have to insert [like] into a post/article and your like-Button (generated on this Option-Page) will appear

**6. Facebook-Like-Button-Widget**
*   Go to the Widgets-Page on the left. Add the "Facebook-Like-Button" Widget and add the required information.

*   The URL must look like the URL for the Facebook-Generator on this site.


= Important Notes: =  
  
You only have to enter one of this to Meta-Tags (Admin-ID or AppID) as long as you don not use the Java-SDK.  
**APPID:** If you want to use the Java-SDK you have to enter a valid Facebook-App-ID.  
**Admin-ID:** Facebook-Profile-IDs of all Administrators of this Like-Button.

**Open-Graph-Protocol:** You have to add these attributes

**xmlns:og="http://ogp.me/ns#"
xmlns:fb="http://www.facebook.com/2008/fbml">**

to the html-tag in your template-header.php-file. If you do not do this the Open-Graph-Protocol will not work with all its functions.


= official FAQ: =

| [Video-Tutorial](http://www.facebook.com/GBWorldnet?v=app_2392950137) |

| [GB-Wiki](http://wiki.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |
| [Support](http://www.facebook.com/GBWorldnet) |

== Screenshots ==

1. FB-Like Button Option-Page
2. You have to enter this two attributes to the -tag in your "Template-header.php"-file.
3. The Facebook-Like-Button-Generator
4. You can easily define all the Open-Graph-Meta-Tags. It is as easy as it could be.
5. our new on jQuery-Plugin-based Design (with Tabs and many more)
6. Plugin-Information (with jQuery - also some other tips are displayed like that)


== Changelog ==

= Version 4.3.2 =

+ New: Adding an Update-Message to help you after an Update
+ Feed-Update: new URL for the Wordpress-News-Feed
+ Bugfix: Problem when Updating the Plugin was now solved
+ Coding: some problems and mistakes were fixed
+ Coding: If you deactive the Like-Button the Meta-Tags will not be generated anymore for your blog
+ GB-World-Page: Update of the Links and some other settings/code parts
+ FAQ-Page: We added the Tutorial-Videos and also the GB-Wiki and BugTracker-Page (iFrame)
+ Security: required lvl to change any settings is now set as administrator (User-Request)
+ Design: New order of the General Options. Because some user did not find the 'Dynamic Button' Setting
+ Design: Different Position for the Submit-Button
+ OpenGraph-Feature: you are now able to set a type-tag for each type of site (frontpage, post, page) by yourself
+ OpenGraph-update: You have to update your header.php-file according to the description on the AdminPage: xmlns:og="http://ogp.me/ns#"
+ Future-Feature: you'll be able to set many new Pluginsettings soon - But you can already see some of them.
+ others: We updated the text of the readme-file


= Version 4.3.1 =

+ Coding: There was an Error when you tried to save an option - fixed!
+ Coding: Some other Changes with the Plugin-Options -> Tip: Run the GB-Cleaner after the update!


= Version 4.3 =

+ Design: Complete Redesign of the Plugin
+ Coding: Performance-Update
+ Coding: jQuery-Problem is now solved (nonConflict)
+ and some other smaller BugFixes/Updates/Changes


= Version 4.2.5.1 =

+ BugFix: one function was not up-to-date and it causes some error with the output if you activate (before/after the footer)


= Version 4.2.5 =

+ Feature: you can now hide the Like-Button on every page/post you want more easily. Just check the new Checkbox when you create a new post or page.
+ Feature: you can now easily add some css-style within the new css-box (only available with the jquery-based-Design)
+ Coding: change the default height-value to 250px if it is not set
+ BugFix: the og-type-tag is now working again
+ Fix: fixed some spelling and text mistakes
+ Widget: a new Widget is available: Recommendations. You can now add a Recommendation-Box to your Sidebar with the new Widget
+ Design: little bugfix on the Settings-Page
+ Future: we will change the design and structure of the Settings-Page with the next update (no tabs, no jQuery)
+ FAQ: new explanation for the URL-Setting at the Like-Button-Generator-Section
+ BugFix: the excerpt was not shown correctly (thx to Nicole Simon)
+ Coding: add a link to the header.php-File


= Version 4.2.4 =

+ Feature: it is now possible to add a different fb-image for every post/page of your site
+ BugFix: the problem with the 'undefined ajaxurl' is now resolved (finally)
+ BugFix (Meta-Tags): the 'url'-Tag was not listed on every page - now fixed
+ Added: now also a category-page has its own description-tag. This tag will use the description of the shown category you defined in the admin-menu.
+ Shortcode: The Shortcode can now also have attributes (url) which lets you easily choose which url will be "liked" with a Shortcode-Button
+ Post/Page-Editor: you can now easily add the Shortcode with a new TinyMCE-Button


= Version 4.2.3 =

+ Coding: the Like-Button won't appear on 404-Pages any more
+ FAQ: Adding the Information that you can also like Facebook Pages and Applications
+ Dashboard: Updating the Dashboard-Widget
+ Facebook Like Button Update: box_count is now also available
+ Bugfix Open-Graph: og:type should be article on posts. everything except posts will have your choosen type. posts will allways have 'article' as og:type-tag value
+ Bugfix Open-Graph: og:image -> problem should no be solved!
+ Coding: Performance-Update at the Meta-Output
+ Widget: Adding a Facebook-Recommendation-Widget
+ Widget-Coding: Updating the code and the Description at the Widget-Page


= Version 4.2.2 =

+ GB: some small fixes


= Version 4.2.1 =

+ Plugin: We used the plugin 'Changelogger' as a plugin in our plugin.
+ Info: Adding some more information for the AppID-Tag
+ Bugfix: page_id-MetaTag
+ new Feature: now there is also a new dashboard-widget with your blog-recommendations available (Dahsboard)
+ Codefix: adding the 'height'-Option at the end of the src-attribute of the iFrame-Version (all Like-Buttons)
+ Codefix: adding the 'height'-Option at the end of the src-attribute of the iFrame-Version (Sidebar-Widget)
+ Code: some code-update on the Meta-Section (jQuery-based Design)
+ FAQ: Update the FAQ with the "Meta-Tag App-ID"-Description
+ Feature: now the Description-Meta-Tag is more individual for every post/page
+ Bug-Fix: undefined ajaxurl (on the Option-Page as well as on the GB-World-Page
+ Bug-Fix: XFBML-Modification was not showing up correctly
+ Feature: now you can use the Shortcode-Only if you just need the Like-Button sometimes
+ Bug-Fix: the old design had some problems if you deactivate the jQuery-Design - is now fixed. But please reload the page if you de/activate jQuery
+ GB: Introducing Google-Analytics
+ Design: some small css-fixes and changes


= Version 4.2 =

+ you can now deactivate or activate the FavIcon on the Option-Page
+ active textboxes have no a different background
+ now you can press Enter to save the Settings
+ coding-Updates
+ js-files Update
+ js and css-files are now compressed to reduce space
+ you can now activate or deacitvate the jQuery-based Option-Page (will be activated as default at v4.5)
+ introducing the jQuery-Fancybox, Image-Preview and Image-Thumbnails Plugin
+ Official Function-Request: currently you have to exclude all private-pages by your own but we will solve it as soon as possible
+ GB-Warning-System: you can now deactivate the warnings of our Warning-System if you do not like/need them
+ some functions are now disabled if you are offline (not connected to the internet)
+ now we can also launch some votings within the option-page
+ launching the share-button for the plugin
+ little GB-NewsboxUpdate (v3.2)
+ Update GB-Warning-System [v1.2]
+ Bugfixes: GB-Warning-System
+ some new Screenshots
+ language-files update to the latest version


= Version 4.1.3 =

+ default height if the option is unset
+ GB-Warning-System Update v1.0.6
+ little Performence-Update


= Version 4.1.2 =

+ some options were not correctly displayed (only wrong display but they saved the option correctly).
+ css-class infotext is now more detailed


= Version 4.1.1 =

+ some small bugfixes. sorry for any issues caused by that bugs.


= Version 4.1 =

+ new design
+ introducing the css-function - Sidebar-Widget and Like-Button
+ some text changes and some options are now in the FB-Button-Settings-Box
+ BugTracker-Link was broken -> fixed
+ now you can choose how many <br>s you wanna have before or after the Like Button
+ adding the 'page_id' meta tag
+ GB-Warning-System-Update [v1.0.5]


= Version 4.0 =

+ WP3.0 Compatibility
+ Infopage-Update
 * GB-World-Plugin-List Update: new algorithm to find the installed gb-world-plugins
 * Performance Update
 * CSS-Update
 * GB-Newsbox-Update 3.1
+ Security Update
+ Traffic-Reduction
+ Settingspage
 * Update some text and information
 * Metatags-update
  ** Infotext about the image-meta
 * the Like-Button-Position can now be before, after or before and after the content
 * the Like-Button can now also be displayed at the archive-page of your theme (sometimes it depends on the theme if it works - please report any errors and the name of the theme were the error occurs)
+ More Stability
+ Introducing our new BugTracker-System
 * Introduction of the BugTracker-Link
 * Show the latest Bug-Reports of the Plugin on the Option-Page
+ Introducing the REF-Option
 * Introducing the FB-Analytics-Box
+ introducing a Warning-System [v1.0]
 * currently only for the Option-Page and not for the Widget
+ introducing the new GB-World-Ad-System [v1.0]
 * now you can advertise on our plugin-option-page (see more on the Option-Page in your Wordpress-Backend-Menu
+ introducing a new GB-Cleaner
 * this new tool cleanes senseless options of older versions of this plugin
+ Updating the Sidebar-Widget
 * Add the Ref-Option
 * Meta-Tags are now also available if you only use the Sidebar-Widget
+ Introducing a Facebook-Like-Box of GB-World.net
+ fixing more than 100-200 coding lines
+ Update the FAQ
+ language file updated
+ better information about the <html>-Attributes you have to add if you use XFBML


= Version 3.1 =

*   We have added some new information to the FAQ on the Option-Page and much easier explanations for all of our plugin-users
*   Now 'Categories' can also display the Like-Button - and you can also exclude categories
*   We changed some text on the Option-Page
*   Update the Info-Page to v1.1: Bugfixes and it now dispalys all of the installed GB-World-Plugins
*   some Bugfixes and new functions for the Meta-Tags:
*   the Description-Meta-Tag is now dynamic (you can choose more options for this tag)
*   Meta-Tag-Image: Now a little preview is available for the Image you choose (until width=400px)
*   We also changed the Blog-Type-Meta-Tag into a combobox and added tooltips

= Version 3.0.1 =

*   Bugfix: GB-World-Info-Page [v1.0] had a bug -> now it is fixed

= Version 3.0 =

*   Updating the SideBar-Widget with new functions and bugfixes
*   New functions for the Like-Button were added
*   Bugfixes and a performance-update of the executing code
*   Tooltips for some difficult options which need some explanations
*   introducing the GB-World-Info-Page [v1.0]

= Version 2.5 =

*   Bugfix and update speed of the plugin
*   changed all the settings to our new domain: gb-world.net

= Version 2.0 =

*   Updating the GB-Newsbox to v2.5
*   fixed the bug for all IE-Users. They were not able to save any options

= Version 1.4.5 =

*   We introduced the php-function 'urlencode' to ensure that the url for the facebook-button is correct	
*   it is now possible to change the language of the fb-button by yourself (only if you use the Java-SDK)
*   We have expendet your Generator with new functions
*   It is now also possible to choose the position of the facebook-button within the content of your page/post (top/bottom)

= Version 1.4 =

*   We finally finished all the work for our 1.3.x-versions. We have tested this new code on a website of us and it works!


= Version 1.3.7.5 =

*   every Post/Page or even Frontpage will now have a individual Facebook-Like-Button. This is the principal function of a Like-Button. The Like-Buttons are generated automatically after you make one with our Generator.

= Version 1.3.7.3 =

*   we implemented the fb:like-tag into this plugin. We do not know if all works properly with this new code segment. we need some reports from you if there is a new bug or something else.
*   we know that some domains have a problem with the Java-SDK-Output of our plugin. We do not really know why. We are working on that problem.

= Version 1.3.6.2 =

*   important bugfix: enabling all functions of the open-graph-protocol and fixing a mistake in the code
*   extending the FAQ

= Version  1.3.6 =

*   some new translations
*   some bugfixes in the background-code

= Version  1.3.5 =

*   fix some bugs.

= Version  1.3 =

*   relase this version to the official WP-Plugin-Repo.

== Help US ==

Help us translating the Plugin into other languages. Translate it into your language and send us your language-files. Thanks a lot. You'll also get a link on our plugin-page.

== Searching for new Dev-Team-Members  ==

GangXtaBoii.com is a new comunity which will support many new projects from unknown and well-known people. Everybody can publish their projects on our website (in our forum). But we need more people in our team. A reliable gb-team is very important for us. Are you reliable, interested in our topics and you wanna host your projects and other projects on our website?

Write us a small text about your personality, experiences and why you wanna join our team. We will answer as soon as possible. We are pleased to have new people in our gb-team.

| [GB-Application](http://www.gb-world.net/forum/viewforum.php?f=20) |

== BUGS ==

If you find any bugs **please report** them at our forum: | [Support](http://www.gb-world.net/forum/viewforum.php?f=22&start=0) |
and at our NEW BUGTRACKER-SYSTEM: | [BugTracker](http://bugs.gb-world.net) |

== Wiki ==

check our new wiki for further information: | [GB-Wiki](http://www.gb-world.net/wiki/GB-Wiki:Like-Button-Plugin-For-Wordpress) |

== FANPAGE ==

Become a fan of us now: | [FanPage](http://www.facebook.com/GBWorldnet) |

== We use ==

[Changelogger-Plugin](http://wordpress.org/extend/plugins/changelogger/) for our plugin because it is a very impressive plugin which reads and displays the changelog of various plugins (in this case only of our plugin). Note: This is NOT our work. This Plugin is only included to display our changelogs. Official Author: Oliver Schl&ouml;be