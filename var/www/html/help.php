<?php

echo '<html lang="en"><head><meta charset="utf-8"><title>WiPi Netbooter</title>';
echo '<meta name="description" content="Responsive Header Nav">';
echo '<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">';
echo '<link rel="stylesheet" href="css/sidebarstyles.css">';
include 'menu.php';

?>

<h1>Overview</h1>
<p>This version of the Pi Netbooter code is a scratch rewrite of the original solution written by devtty0 and has been enhanced with a new user interface and richer functionality. It has full support for all netbootable Sega arcade ROMs for the Naomi, Naomi2, Triforce, Chihiro and the Atomiswave conversions made possible by Darksoft. This version also includes the card reader emulator code for games that support it, the original python scripts were written by Winteriscoming over on the arcade-projects.com forums and have been adapted for use in a web interface.</p>
<p>You will need:</p>
<p>A Raspberry Pi v3 and SD Card - 32GB Class 10 card recommended<br />A Naomi, Naomi2, Triforce or Chihiro with a netdimm running firmware 3.03 or greater<br />Decrypted ROMs for netbooting<br />A crossover cable<br />A Web Browser :)<br />Optional: a Trendnet TU-S9 USB-Serial adaptor and custom serial cable for the Card Emulator</p>
<h1>General Use Instructions</h1>
<p>Firstly you need to load ROMs onto your SD card. You can transfer them onto the Pi over Wifi from your PC using WinSCP or you can insert the card into your PC and copy them directly.</p>
<p>To copy them using WinSCP, download and install the WinSCP application and connect your PC to the naomi Wifi network. Connect WinSCP to 192.168.42.1, log in using username root and password raspberry. Copy your ROMs by dragging them across to the /boot/roms folder.</p>
<p>To copy them to the SD card directly, insert the card into your PC and copy them via Windows Explorer to the /boot/roms folder.</p>
<p>The naming of the rom files is important because the /boot/roms folder is scanned to build the game list and that must match the entry in the data file. The CSV data file contains most data for the games currently available but you will only be able to see and edit the games you have transferred onto the Pi's SD card. I have used the default names of the files as they are available for download although you can edit them in the romsinfo.csv file, see the Advanced section below for details.</p>
<p>The main page of the web interface is used for launching games, simply browse through the game list and select a game to send the ROM to your arcade system. If you are using the Advanced Menu mode, when you select a game you will see extended game information and a gameplay video if one is present on the Pi along with a Launch Game link. Once the loading process is complete a success message is shown, after that you can safely browse to other pages or shutdown the Pi.</p>
<h1>Options Menu</h1>
<p>The Options menu displays the current mode settings and provides links to toggle between them.</p>
<h1>Boot Modes</h1>
<p>The Pi Netbooter has 2 different boot modes, Multi and Single. Multi mode requires you to manually launch the game from the web interface every time you want to play. Switch to Single Boot mode to automatically boot the last played ROM when the Pi starts up.</p>
<p>NOTE: some games will not allow you to hot boot another game while one is already loaded, this affects the Atomiswave games in particular so to avoid getting stuck in a loop when booting those games in Single boot mode you need to disable it, reboot and select your new game before re-enabling Single mode.</p>
<h1>Power Modes</h1>
<p>There are two power modes to choose from, Always-On and Power Saver. Always-On works as it's name suggests, you should use the Shutdown link from the web interface to safely shut down the Pi. Generally speaking you probably won't get any problems from simply powering the Pi off but there is chance that the SD Card may become corrupted if you do. Power Saver will start a timer when the Pi is booted and runs for 10 minutes before shutting the Pi down. This leaves enough time to open up the web interface and change any options you need to.</p>
<p>NOTE: the timer cannot be stopped or started from the web interface so switching between power modes requires a reboot of the Pi.</p>
<h1>Menu Modes</h1>
<p>There are 2 menu modes available, Simple and Advanced. Simple mode allows you to boot the ROM directly from the main game list page, Advanced mode links to a game information page that shows you extended information about the game, a video preview if available and a link to launch the game. This information can be easily edited by updating a CSV file held on the Pi, see the Updating Roms, Videos and Images section below for details.</p>
<p>Relay Reboot mode is for use with an optional relay connected to the Naomi power or fan speed wire. When a game is launched and this is enabled it will send out a signal on GPIO pin 40/GPIO26 which triggers the relay to cut power and soft reboot the Naomi. This is for games that will not allow you to hot boot another while it is running.</p>
<p>Time Hack mode is used when a null pic chip is not present in the netdimm. When enabled this will send a special packet to the netdimm to reset it's security check. This requires the Pi to be left connected to the netdimm and powered on while the game is running.</p>
<p>OpenJVS Support - OpenJVS is a software JVS IO emulator which allows you to connect the Pi to the Naomi using an RS485 to USB connector and play games with virtually any USB game controller. See the OpenJVS github page for full instructions.</p>
<p>LCD Mode allows you to switch between a 16x2 LCD display or 3.5 inch touchscreen attached directly to the Pi as an alternative to the web interface via a browser.</p>
<h1>Editing Games</h1>
<p>The Edit Game List function is used to show and hide games in the main game list. This is useful if you want to load a full set of ROMs onto your SD card but you'd like to hide all vertical, analog and driving games for instance. Use the link in the Enabled column to toggle the setting between Yes and No to Show/Hide the game.</p>
<h1>Card Emulator</h1>
<p>The Card Emulator runs various scripts on the Pi to send and receive data to your Naomi, Chihiro or Triforce to emulate the magnetic card readers used on the original machines, useful if you want to get the most out of your games or have simply run out of cards!</p>
<p>To use it you need to plug a TrendNet TU-S9 USB-Serial convertor into the Pi connecting to your arcade system via a custom cable. Pinouts for the cables are shown in the Advanced section below.</p>
<p>The Card Emulator saves and loads card data via files held locally on the Pi. There are separate files and folders for each of the games as they are not compatible with each other. Simply select the mode you want to run and then choose a card from the list. Initially you won't have any cards so there is a text box where you can specify a name for your new card, spaces are not currently supported in the card name.</p>
<p>To launch the emulator either hit the submit button if you are creating a new card or the card name link to launch an existing one. The emulator will fire up in the background and start communicating over the serial link. If you've already booted the game, reset it via the test menu and be sure to enable the reader in the game test mode! The webpage will appear to stop responding at this point, once launched you can safely browse away from the page.</p>
<h1>Updating Roms, Videos and Images</h1>
<p>All data used for the game list is stored in a CSV (comma separated values) file that is stored in /boot/config/romsinfo.csv. To load and edit the file insert the SD Card into your PC and open the file from /boot/config. The file structure is fixed so please do not delete or rearrange columns as that will break the game list and probably create some very odd behaviour! You can edit the data directly in Excel or similar application on your PC, just make sure when you save it you choose CSV as the file format. You can update any of the data in the file as you wish to customise or fix any mistakes in the data or to add new games, there are some important fields that rely on the correct files being in place for the game list to be generated correctly:</p>
<p>romname - this is the name of the corresponding rom file for the game, it must be present in the /boot/roms folder<br />image - this is filename of the image used in the game list, it must be present in the /boot/config/images folder<br />video - this is the filename of the video preview file, it must be present in the /boot/config/videos folder</p>
<p>NOTE: the Raspberry Pi operating system is Linux and so all files are case sensitive.</p>
<h1>Advanced</h1>
<p>For those of you who like to code, you can access the source files for the web interface in /sbin/piforce and /var/www/html. Feel free to have a poke around, generally if something cannot be done in PHP its due to permissions, the PHP page calls a python script to execute it on its behalf. The boot process is as follows:</p>
<p>When the Pi starts up it executes a file called rc.local that fires up a python script /sbin/piforce/check.py. This script checks a few files in the piforce folder to get settings for the power and boot modes. It then sends a netboot command if set to single mode and a shutdown command with a timer if the power mode is set to auto. The CSV file is copied back to the boot partition as part of the shutdown routine.</p>
<p>Most of the web code is PHP so the pages are generated as they are loaded, the benefit is you can make changes on the fly without having to restart the Pi. There is a styles.css file in /var/www/html/css that can be modified to change the colours and look and feel of the menus and webpages. You can also swap out the SEGA PI image in the top left, that is held in the /var/www/html/img folder.</p>
<p>All data for the games is scraped from the romsinfo.csv file held in the /boot/config folder, if you wish to add more columns bear in mind the existing scripts refer to the absolute column reference so you'll need to add any new ones after the existing columns. There is a way to import CSV data in as a multidimensional array using PHP but I got lost quite quickly in the coding for that so my script just reads and writes line by line.</p>
<p>Here are the cable pinouts you need for the Card Emulator to work, I bought a straight through female serial connector on eBay for &pound;3, cut it in half and crimped a 5 pin JST NH connector on the end.</p>
<p>Naomi &lt;- Serial</p>
<p>1 &lt;- 3<br />2 &lt;- 2<br />3 &lt;- 5<br />4 &lt;- 8<br />5 &lt;- 7</p>
<p>Chihiro/Triforce &lt;- Serial</p>
<p>3 &lt;- 5<br />4 &lt;- 2<br />5 &lt;- 3<br />6 &lt;- 8<br />7 &lt;- 7</p>