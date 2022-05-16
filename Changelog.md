March 22, 2021
v1.0.2
- [Added] TV Channels 
- [Added] Required Membership
- [Fixed] Bugs fixed


======


May 18, 2021
Titan starts working on the script
- Fixed 404 on install
- Fixed issue with genders only showing Female
- Added RSS Feeds
- Added Sitemap


======


May 25, 2021
- Added background images to collections


======


Jun 11, 2021
- Fixed Season and Episode formatting, now it lists Season #: Episode # as opposed to #.Season.#.Episode.
- Fixed https errors causing importing movies and shows not working.
- Fixed Installation problem where it would error out.
- Fixed Genders not showing properly.
- Fixed Importing foreign language movies and shows not having covers.
- Fixed default language in admin area to English from Turkish.
- Added TMDb recognised Categories on installation, additional categories can still be added,
- Added download table into database for future updates.
- Added background table into database for this update.
- Added the option to add backgrounds to collections in backend.
- Added the option to add backgrounds to collections in front end.
- Added a function where if no background detected then it would default to color with text title.

Thanks to the following:
@InfinityFree for helping with the background images on the collections.
@Mecky Clouds for the TMDb import fix.


======


Jun 12, 2021
Wovie Redux is born ;)
- Fixed ALL mixed content errors.
- Fixed ALL blocked content errors.
- Fixed Season and Episode numbers missing from the admin panel.
- Fixed Fixed more spelling mistakes.
- Fixed issue where it would make URL none SSL, I've made this script permanent SSL as anyone not using SSL in 2021 shouldn't be running a site.
- Fixed ALL icons now show, whereas in past release I accidently broke them.
- Added Instructions in the installation file for cronjobs.
- Added Movie RSS Feed Cron Job (optional feature).
- Added Sitemap.xml Cron Job (optional feature).
- Added RSS Feed icon in the bottom right next to socials.
- Added Download Button on episodes and movies when download it present.
- Added Download input URL on adding video screen*
- Added You can now add your own download link for movies and episodes**
- Added You can now generate sitemaps for Google Search Console.
- Added You can now generate RSS Feeds for movies***

*If download is filled in once it auto fills any future stream links with the download link, if it's not filled in then it leaves it blank.
**Download link appears alongside source button on the top of the page, if there's no download link then it doesn't appear, on mobile it resides at the bottom of the screen to keep out the way, links also open in new tab.
***Currently you can only generate RSS feeds for Movies as I'm still coding the TV Shows and Episodes, this will come in future updates, this can be automated via cronjob to run hourly (default in install instructions) or whatever time you feel fit.


======


Jun 13, 2021
Wovie Redux 1.2.1 and 1.2.2
- Fixed Embeds now work.
- Fixed db.config.php not working, thanks @furious93
- Added Sliding Menu toggle in settings->theme.
- Added Now you can have either slide menu such as on Watch A Movie or a static menu as default Wovie, this setting is controller on settings->theme->Slide Menu done, easy!


======


Jun 15, 2021
Wovie Redux v1.3.0
- Fixed Spelling mistakes throughout entire site.
- Fixed Genders on accounts not appearing correctly.
- Fixed Errors on installation.
- Fixed 100's of mixed content errors.
- Fixed 10's of blocked content errors.
- Fixed Importing foreign content not having covers on the posts.
- Fixed English formatting now makes cohesive sense.
- Fixed Episodes in admin panel now order in chronological order as opposed to seasonal order.
- Fixed Home page slider now goes to external URL if inserted in the settings.**
- Added TMDb recognised categories on installation.
- Added Backgrounds for collections, this can be edited on front end or backend.
- Added RSS Feeds for movies, TV Shows will come in future updates.
- Added Sliding menu, this can be toggled in general settings.
- Added Sitemap generation (requires cron, instructions on installer).
- Added Download button, download url can be added on movie or episode embed post.
- Added Link shortener function to get paid for download clicks, can be set up in API settings section.**
- Added Button to opensubtitles.org which can be enabled or disabled in settings, to help viewers find subtitles for free.**
- Added Download, Stream and Subtitle button hide on mobile on scroll down in order to access comments.**
- Added PWA support, all files and settings are enabled for PWA support, just visit the PWA tab in settings to get your personal manifest.json code.**
**New features and changes for this update.


======


Jun 24, 2021
Wovie Redux v 1.3.1
- Fixed Trailer button not working on Shows


======


Jun 26, 2021
Wovie Redux 1.3.3
- Fixed Login on homepage not working correctly due to caching issues.
- Fixed PWA cache has been changed to static resources as opposed to changing resources.


======


Jul 17, 2021
Wovie: Redux Auto Embed (short lived, just adding it as a side note)


======


Jul 28, 2021
Wovie Redux 2.0.0
merging the wovie redux and auto embed into one script

- Added Manual Embeds
- Added {if no manual embed} Auto Embed
- Added Manual Downloads
- Added {if no manual downloads} Auto Embed Download Link
- Added Added RSS Feeds
Movies
Shows
Episodes
- Added Added the ability to toggle RSS Feeds in settings
Toggle ALL Feeds
Toggle Movies
Toggle Shows
Toggle Episodes


======


Jul 28, 2021
Shadav joins Titan in working on the script



======


Jul 31, 2021
Wovie Redux 2.0.1
- Added TV Show play button now has "Episode Art" as opposed to cover art, I feel this is how the script is meant to of existed so it's the only option now, unless movie then it shows movie art...
- Added TV Show and Movie art now appears even when using auto embed as opposed to manual embeds.
- Added cover art to the collections page.
- Added title beneath the collection.
- Added number of content in the collection.
- Added 'Season Specials and Extras' now show as 'Special' as opposed to season 1 thanks to @odinot for the fix
- Fixed Mobile template is now fully responsive and not having that stupid bug on medium 'tablet' screens where it scrambles it all up, I took some of @Shadav code and cleaned it up a lil and made a few extra changes to keep the initial look of the site such as logo etc in the same place.
- Fixed Titles of RSS Feeds was all "Most Recent Movies RSS Feeds" this is what I get for copying and pasting code...


======


Aug 2, 2021
Wovie Redux 2.0.2
- Fixed movie embeds not working thanks @Shadav
- Fixed 'Specials' not showing thanks to @odinot
- Fixed Countries now fixed! Huge thanks to @odinot
- Added banner to the collections thanks to @Shadav
- Added Ascending order of Episodes thanks to @Shadav
- Added covers to the shows in profile->collections as a lot of people have forgotten about this section, it now looks like the collection page.


======


Aug 13, 2021
Wovie Redux 3.0.0
- Added an upgrade folder with sql's that need to be ran to upgrade
- Optimized script for better lighthouse scores/faster loading

- Added Chatbox on the home page.
	Chatbox highlights admins in red and other users in theme color.
	Admins can clear chatlog as frequently as they like from the front end or the backend.
	User input is sanitized so code shouldn't be executed.
	Usernames link to user profiles.
	Autoscrolls to newest messages.
	Can be reordered or disabled using the blocks manager in the admin panel.
- Added Added maintenance mode
- Added TMDb.php to get finish dates for episodes thanks to @Shadav
	Finish dates are automatically added to the Shows info pages.
- Added fields to input MPAA ratings thanks to @Shadav
	These will also automatically show in spots around the site where relevent.
- Added 'home' page for breadcrumbs thanks to @Shadav
- Slider images no longer resize and reduce quality when uploading so now you can have nice crisp pictures
- TV Shows now show full quality images on Episodes as oppose to low quality images.
- Collections page is now more mobile friendly showing wide image on mobile and grid of 3 on desktop.
- Sitemap now generates Categories via database (not hardcoded)
- Sitemap now generates Pages via database
- Sitemap now generates Collections via database
- Fixed sitemap shows URL generated
- Fixed sitemap movies URL generated
- No longer prioritizes Remote Stream API


======


Aug 14, 2021
- Optimized script so that lighthouse scores are all over 98%


======


Aug 16, 2021
3.0.1
- Added personal languages, now it will default to English (or whatever the admin panel is set to) then users can select their own language which will overwrite the existing language.
	If an Admin adds a new language is automatically added to the drop down menu.
- Added the upgrade SQL for the new languages as a new table is added.
- Added new translation strings to Turkish language, thanks @meyz.
- Added rewrite base to htaccess to try and help with subfolder installs.
- Added RSS icon to sprite sheet.
- Added Pages to the menu and made it toggled on/off in the admin.
- Added chatbox URL toggle in menu.
	Now has a dedicated Chatbox URL domain.com/chat.
- Minified JS files and CSS files except for the theme's CSS file to help improve performance.
- Updated feeds and few other files, replacing hard coded text with language strings.
- Updated Settings to show preview of logo and favicon.
- Updated PWA file URLs to help with subfolder installs.
- Fixed slider buttons to be on the left and right, made slider buttons to be theme colour.
- Changed play button to be theme colour.
- Added back the toggles that were accidently removed for the feed menus to turn them on or off in the admin.
- Fixed table modules auto increment so that the Chatbox doesn't accidently get written over.
- Fixed issue with special seasons episode cover not displaying and uploading images in admin for episodes not working*.
- Maintenance mode now only shows for none admin so admin can work on the site.
Critical Bug Fixes:
	PHPMailer 6.2.0 upgraded to 6.5.0 to fix security bugs and vulnerabilities outlined here: https://www.cvedetails.com/vulnerab...uct_id-32737/Phpmailer-Project-Phpmailer.html
	* Unfortunately updating to this version will break existing episode covers, this is due to the way they was imported and displayed, we've determined that the best way to go about this is to publish a fix sooner rather than later causing more problems in the future, yes it is annoying, however I also have to fix it on my own site.

Thanks @Shadav for the work alongside myself, who made a lot of the fixes and features.
Thanks @meyz for the Turkish translations.
Thanks @MEGZ99 for working on the upcoming Arabic language.


======


Aug 18, 2021
3.0.2
- Fixed Mismatched query parameter name in target URL in Google Search Console based on sitemap.xml.
- Fixed the report button.
- Fixed chatbox been borked if not logged in due to two class="menu".
- Fixed some SQL queries.
- Fixed some spellings and localisations.
- Fixed language strings appearing in RSS Feeds as oppose to their language counterparts.
- Sidebar on pages now no longer shows if "Pages in Menu" is enabled.
- Changed fixed width logo to "auto" for more responsive images.
- Removed duplicate body color tags in CSS.

Chatbox Changes:
Now you can ban members from the chatbox from admin panel.
When you ban someone you can give a reason and chatbox will present them with that reason.
It shows on user list if someone is banned or not and from where.

Layout Changes:
Categories no longer show on hover.
Removed secondary names from the home page and replaced with release year.
If it's a show it shows active years, such as 2010 - 2021 etc.
Added MPAA to the top right of the covers if content has MPAA ratings submitted.
Content pages such as movies and shows now display the secondary name if there is one.
Added follow button to movies.

Reporting content:
Reports now work and submit to the admin panel.
Reports now request either an email or a username in order to reply to the report.
If user is logged in it's automatically populated with their username.
If not then it's required for an email or sudoname.

New:
Added hCaptcha to the registration form in order to prevent bots thanks to @ChainofChaos for coding this in for us!
Added an additional advertisement slot within the home movies and show blocks.
Every 7 blocks will display 1 advertisement, you just paste in the advertisement code.
Localizations:
Full translate Arabic thanks to @MEGZ99
Full translate Indonesian thanks to @unicorn


======


Aug 21, 2021
3.0.2 - Fix
Rolled out a fix for the database on installation, this was a quick fix hence the very small update.


======


Aug 23, 2021
3.1.0
Fixes:
- Fixed default language been English regardless of what setting in admin panel was.
	Default Language is whatever it is set to in admin panel.
- Fixed user information missing after updating their profile.
- Fixed maintenance mode so now you can't lock yourself out of the website if you logout as admin.
- Fixed the trending menu in the sidebar.

New Features:
- "Themes" have been added, you can select these from the admin panel.
	Themes is in beta so offer feedback on colors and changes etc.
- Added countries pages
	Countries can be added or removed from the admin panel.
	Countries should automatically be attached to a show or movie from importing.
	You can access countries from https://example.com/countries
	You can access country from https://example.com/country/united-states-of-america
	Countries is also SEO friendly with no IDs or numbers in the URL
- Added two modules to the home page
	Added Recently released movies
	Added Recently released shows
	This is in contrast to the recently uploaded modules that exist now.
- Added the option to disable Remote Stream API
	If empty it will present the viewer with a message.
- Added the option to disable Remote Stream Download Button
	If empty now it'll be hidden.

Changes:
- With extra menus and features comes a redesigned admin menu!
- Sitemap now includes countries as well as actors
- Reworked the profile page.
- Moved the follow button on video pages.
- Moved the trailer button.


======


Aug 23, 2021
3.1.1
Emergency bug fixes...

Fixed
- Default dark theme now works, didn't work previously due to "No theme detected" error.
- Fixed Sliding menu on Dark Theme.
- Fixed not showing videos on movies and shows.


======


Aug 23, 2021
3.1.2
Even more bug fixes

Fixed:
2 New modules should now display correct information

Changed:
Width of home content to align with the slightly longer titles of the new modules.


======


Sep 3, 2021
3.1.3
New:
- Added Episode Descriptions, for each episode and TMDb importer imports them.
- Added Google Adsense mode in hopes to get some sites approved for Adsense.
	It does this by disabling all copyrighted content on the site such as streams and download button.
	This worked on my tested site https://watcha.show.
	When option is disabled all content is shown again so your site operates as usual.
- Added bulk import via TMDb IDs

Changes:
- Very minor changes with CSS, spellings and just unneeded tags etc.
- Removed Remote Stream
	Due to some things popping up in my life I no longer have the time to maintain Remote Stream so I've replaced that API with 2embed.ru, any auto embedded content will continue to work given it's in 2embeds database.
- API / Auto embed is can still be disabled if you wish.
- As no other API offers download links, if download link is empty it will no longer try to get one.


======



Sep 10, 2021
3.2.0
Report function now grabs the pages URL to help find reported content as currently there's no way to know which episode is reported on a show.
When reported if user is logged in, users name is automatically inserted and cannot be changed, if no user is logged in it requires an email in order to follow up the report.
In the admin panel, on the home page, I've added an eye symbol which links straight to comments or reported content.
These links also appear in the comment or report in the admin panel.

Added 2 sections on top of collections, there's now 'collections', 'playlists' and 'services' .
Collections will contain all none playlists and services.
Playlists can be set via the admin panel for things such as MCU or Monsterverse etc.
Services is another layer on top of Playlists with the exact same function for if you wanted more separations, the reason it's called services is because it's what I've put my streaming services under. Got a better name for it lemme know.

Added 'CAM' quality for those that love that low quality shizz.
Added additional options for reports feature.

Sep 15, 2021
3.2.0
Report function been built on
- Reported now show on user profile (only for logged in user) this will help users check up on their reports
- Reports on users profile now have eye symbol to view content directly
- Viewing reports via the admin panel will have an eye symbol to view content
- Viewing reports via the admin panel will show username if signed in or email if user submitted one

Collections system been built on
- Collections now can be selected as a 'Playlist' which will show on the playlists page https://example.com/playlists
- Collections can now be selected as a 'service' which will show on the services page https://example.com/services
- Collections can be set as a 'Featured Playlist' or 'Featured Service' which will appear in their own section on the home page

Homepage additional modules
- Added 'Featured Playlists'
- Added 'Featured Services'

Profile fields
- Added Report Tickets to the profile page, this is only visible to the user to view report status


======


Oct 10, 2021
3.3.0
New:
- Anime option which will be toggle-able on the post page in the admin section.
	Anime will have a homepage block.
	Anime will have a specific page for it at /anime/
- Request section.
	Requests can be made by none registered users.
	Requests require; Title, Type, IMDb URL.
	Requests appear in the admin panel for you to check and delete.
- New user 'Supporter'
	Will be a new account type.
	Will have to be manually upgrades and payments taken.
	Will have the advertisement blocks removed.
- ALL languages currently finished will be released too.
	EN - English
	TR - Turkish
	AR - Arabic
	ID - Indonesian
	VN - Vietnamese
	SP - Spanish
- Added episodes to the sitemap.

Fixes:
- Social media share buttons now working.
	Facebook
	Twitter
	Reddit
- Fixed Shows with numbers in such as 'The 100' not working.
- Pagination to be added to the countries pages.

Oct 26, 2021
3.3.0
Request section:
	Added requests /requests/ this will show already made requests and the status of them.
	Added request page /request/ this allows people to make requests.
	Added requests in admin /admin/requests/ this will show existing requests and the status of them.
	Added request in admin /admin/request/[id] this will allow you to mark as completed.
	Added requests to the admin home page, this will show total requests made and the current status of them.

Fixed and added new social media links:
	Fixed Facebook sharing link.
	Fixed Twitter sharing link.
	Added Reddit sharing link.

Added new member:
	Added 'Supporter' position, this position can't see advertisements.
	Also 'Admin' can no longer see advertisements.

Added Anime section:
	Added Anime block on home page.
	Anime doesn't show in usual Movie or Series blocks.
	Added /anime/ page.
	Anime page shows all anime.
	Added anime tick box on series and movies admin page.

Side menu:
	Added Anime.
	Added make a request.
	Added view requests.

Show URL structure:
	Shows are now /SHOW-[ID]/[#]-SEASON/[#]-EPISODE
	This now works with series with numbers in their title.
	Next and Previous buttons fixed to represent this link structure.
	Series page updated to represent this link structure.
	Changed URL structure on episodes block.

No Language updates as translators haven't finished translating strings



======


Nov 10, 2021
3.3.0 - Fixes
Fixing some sql statements for upgrade and install



======

Dec 2, 2021
3.3.1


- Fixed auto_increement for modules in the install and update
- Fixed collections table sql
- Fixed profile discussion tab's links
- Fixed hit counter on autoembed
- Fixed "watch now" button link
- Fixed Home Module Episodes date to display better
- Fixed the footer so it displays on larger screens but not smaller screens
- Fixed Slider so it doesn't become so large on larger screens
- Fixed some js files and header file to display the logo better
- Fixed the Serie and Episode pages to work on subdomains
- Fixed Home Module Episodes from displaying non-active episodes
- Fixed Members only on Series and Episodes
	- Hides the player on Movies and Episodes, Hides the Watch now button on serie page when set to members only

- Fixed Copyright settings on Movies and Series, thanks to @flixmu for the help
	- Hides the player on Movies and Episodes, Hides the Watch now button on serie page when set to Copyright

- Fixed issue with not being able to add new users
- Fixed admin block settings getting messed up and rearranging/placing the wrong settings to the wrong block
- Fixed incorrect language used in admin on episode page
	- it now says
		- Episode Number instead of just Episode
		- Episode Title instead of Overview
		- Episode Description instead of just Description

- Fixed Home Module Episodes url from old url to new url
	

- Added version number to footer in admin
- Added back to the report list "Subtitle has character issues"
- Added menu icon for view requests
- Added Series Status to listings to display Ended or Returning Series
- Added Actor images and character names to movies, series and episodes
- Added option in admin to hide download button in plyaer header
- Added a changelog
- Added Dutch language - thanks to @commodoor for the translation

- Changed menuu icon for make a request
- Changed themes to be 100% width on all sized screens
- Updated language strings
- Cleaned up some of the css
- Homepage Slider now uses the listings description and cover image if those settings are left blank
	- or if filled in will show custom description or image

- Changed the default logo and favicon
- Redesigned the serie page to match more to the movie and episode pages
	- added the hit/view counter
	- added the like up/down vote counter
	- added a cover image and moved the watch now button into it
	- added similar content list


v3.3.1 - Fixes

- Fixed Episode videos so that download url is not a required field
- Fixed Series Page to only display counter for series and not anime
- Fixed Anime page to only display counter for anime and not all series
- Fixed Anime page to displays filter

- Added Anime back to the discovery page, since it's still a series/movie
- Added Anime to the admin seo settings so you can set it's titles and things
- Added to the database for the Anime Seo settings


======


Dec 3, 2021
v3.3.2

- Fixed Category page, removed the extra quality code that made the on hover black instead of transparent
- Fixed Slider limited to 6 regardless of what they put into the admin

- Added Categories link to breadcrumb on Category page, changed a bit of the code to match the discovery page
- Added the page description to the Discovery page
- Added a max width on the player so it isn't so huge on larger screens


======


Dec 17, 2021
v3.3.3

- Fixed Recently Added Series home module to not show anime
- Fixed Movies/Series/Episodes/Actors Titles/Names to use Arabic

- Added Serie tags to Episode page
- Added Arabic Translation (thanks to @MEGZ99 and @kingaliyt for the translations) even though it's not 100% translated, it's translated enough
  - still need to work on script to work with right to left languages though

- Changed the Admin menu to be a bit easier
  - Under Content Movies is on top, then Series, then Slider and everything below it is Alphabetical
  - Under Community Users is on top and everything below it is Alphabetical
  - Under Settings General is on top and everything below it is Alphabetical
- Changed Collections Page to only show admin collections
  - Users can still have collections but they will only show up on their profile pages
