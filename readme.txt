=== Plugin Name ===
Contributors: David@Skysa
Tags: skysa, skysa apps, sdk
Requires at least: 2.7
Tested up to: 4.0
Stable tag: trunk

Software Development Kit for creating standalone Skysa Bar apps for WordPress.

== Description ==

Skysa Bar apps are self-contained apps which work with the Skysa bar. If you do not have your own Skysa App Bar integrated with your site, they will pull in a basic one for you so that the apps load correctly. If you do integrate your own Skysa App Bar with your site, your Skysa Bar apps will work with it instead, allowing you to configure all the features that the full Skysa App Bar service provides.

This plugin includes the most recent version of the `skysa-required` directory which is required for the any Skysa Bar app plugins created with this SDK. Additionally, this plugin includes examples of working Skysa Bar apps which are fully documented to show exactly how to build a Skysa Bar app yourself.

> #### **Note**
> This plugin is intended only for WordPress plugin developers to enable the creation of production WordPress plugins; it is not intended to be run in a production environment itself.

== Installation ==

#### **Install the SDK**
1. Upload the entire `skysa-app-sdk` folder to your `/wp-content/plugins/` directory
2. Activate the 'Skysa App SDK' plugin on your 'Installed Plugins' page.

#### **Getting Started With Your Own Plugin**
1. Create a new directory for your plugin in the plugins directory of your development site.
2. Copy the skysa-required directory and index.template file from the "skysa-app-sdk" plugin into your new plugin directory.
3. In your new plugin directory, rename the "index.template" file to "index.php".

You may now activate your new plugin and make your changes to the "index.php" file in it's directory.

Open the "index.php" file in the "skysa-app-sdk" plugin's main directory for a full instructions on creating your own Skysa App based plugin.

== Changelog ==

= 2.0 =
* Fixed Text Escaping Bug. You should update any plugins created using this SDK to this new version.

= 1.9 =
* Fixed the use of the database prepair statement. Works with WordPress changes made in version 3.5 without showing errors.

= 1.8 =
* Corrected an issue with database table creation (hopefully the last one). It caused issues in some MySQL setups which required the UTF8 charset.

= 1.7 =
* Changed the database table creation code to prevent potential problems creating the settings table.
* General code optomization

= 1.6 =
* Added the option to set custom outputs for admin area manage records. See the Polls app example to see how this option can be used.

= 1.5 =
* Fixed the way database tables were created which was throwing a warning in earlier versions of WordPress.

= 1.4 =
* Corrected issue with item creation date being incorrectly calculated.

= 1.3 =
* Corrected an issue which could prevent saving of settings if some options were not used by the plugin.

= 1.2 =
* Included the non-obfuscated version of the jquery calendar picker javascript, placing it in its own file.

= 1.1 =
* Fixed issue in the `skysa-required` files which prevented re-editing images in a settings field with a 'editor' field type. 

= 1.0 =
* Initial Release