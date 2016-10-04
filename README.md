# Plugin Information
Contributors: Damien McDonnell (Murray Creative)
Tags: WordPress settings
Requires at least: 4.0
Tested up to: 4.6.1
License: GPLv2 or later
License URI: [http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html)

This plugin allows you to manage some common settings that are usually changed in your functions.php file.

# Description
This plugin allows you to change some settings that you would usually change in your functions.php file. These settings are broken down into 4 categories.
- Clean Up
- Login Customization
- Custom Image Sizes
- Admin Customization


## Plugin Functions

### Clean Up
- Clean up head section
  - This setting removes a lot of the unnecessary content that is added into the head of a web page in WordPress.
- Add post slug to body class
  - This adds the slug of the current post / page into the body's class list.
- Prettify search URL
  - This changes the URL of your search results page to use the same format as your current permalinks setting.
- Hide Admin bar
  - Hide the Admin bar when viewing the site if you are logged in to WordPress
- Remove CSS and JS file version numbers
  - Strip the version number from the enqueued CSS and JS files when loading to help with browser caching. This setting should only be checked when in production.


### Login Customization
- Add logo to login form
  - This allows you to upload a logo that will replace the default WordPress logo on the default WordPress login page.
- Link login logo to site homepage
  - Clicking on the logo on the default WordPress login page will bring the user to the site homepage instead of to WordPress.org


### Custom Image Sizes
- Remove default image sizes
  - Removes the default thumbnail, medium, medium_large, large and full image sizes.
- Remove thumbnail dimensions
  - Removes the width and height sizes from the outputted `<img width="100" height="100">` tag on the front-end.
- Custom JPEG output quality
  - Manually set the JPEG compression output quality
- Add Custom Image Size
  - Add a new custom image size. Set the image size name, width, height and cropping options.
    - If cropping is selected, horizontal (left, center, right) and vertical (top, center, bottom) options are displayed
  - Remove Image Size
    - Allows the user to remove the selected image size


### Admin Customizations
- Hide Admin menu items
  - Allows the user to select main menu items to hide from view
    - For example; Posts, Pages, Media, Appearance, Plugins and Settings
- Change WordPress footer text
  - Change to WordPress footer text to your own custom message. Accepts `<a href="">` tags for linking to the developer's website.


# Installation

To install the plugin do the following:
1. Download the plugin
2. Extract the plugin contents
3. Copy the studio-manager directory to your /wp-content/plugins/ directory
4. Activate the plugin through the 'Plugins' menu in WordPress


# Frequently Asked Questions

- Does the plugin work for MultiSite installs
  - This plugin has not been built for a MultiSite implementation and has not been tested on a MultiSite. Use this plugin on a MutliSite at your own risk. The developer does not take any responsibility in issues arising from the use of this plugin on a MultiSite implementation.


# Changelog

- 1.0
  - Initial plugin release
