DiscordPanel Pro
How to install
In this section you'll find basic information about DiscordPanel Pro and how to install it and use it properly. If you're first time user then you should read Getting Started section first.

# What is DiscordPanel Pro?
DiscordPanel Pro is a php script designed to help discord bot owners configer and control their bots on the go.

# What is Discord?
Discord is a newcomer to the chat scene, but it's made a big splash. The app provides voice and text chat for groups, with an emphasis on gaming.17 Aug 2016

Full Discord documentation
You can find full Discord documentation here.

# Install DiscordPanel Pro
# Requirements
Installing DiscordPanel should be straight-forward if all requirements are met.

# Getting DiscordPanel Pro
Now most users reading this can skip this step as they will already have it downloaded if they are at this url/ However, if you havent brought DiscordPanel Pro yet you can go to: discordpanel.xyz to lean more and how to buy it.

# Installing
# Uploading the .ZIP
Download discordpanelpro.zip and unzip it to the desktop. Then upload all the files in "FILES" folder to the directory on your server where you want the panel to be hosted.

# Edditing the config
All you need to edit for DiscodPanel Pro is in the "Templates/config.php" file. So go ahead and locate the file adn open it with a text editor.

It should look a bit like this:


Then go though each line carefully adding the details needed. Then save.

(If you don't have 6 bots don't worry only fill in the details for the amount of bots you have)

# How do I add users to bot logins?
DiscodPanel Pro has a amazing feature where any user can login, but they cant edit any bot files or view any bot page without having the needed permissions from the bots permission files. 
We use a json feed to do that for each bot. If you go into the "/Templates" file you should see "bot1Owners.json" all the way to "bot6Owners.json". 
You can open them all up and add the user ids foe each member you want to allow to login to the bots. (Make sure to follow the json rules) Then save all files. 
If you dont know where to get user ids then check out: THIS.

# How do I setup discord login?
You need to head over to: first. 
Then click: "New App" and name it "DiscordPanel Login" then click "Create App" 
A new page should load up. Then navigate to "REDIRECT URI(S)" and add in: yourpanelurl/callback/login.php then click save changes. Then copy the "Client ID" and "Client Secret" into the config. Then enter the "REDIRECT URI" into the config in the area where required.

# License key
# How do I add A Key?
To use DiscordPanel Pro you need need a paid key. If you have paid for it you should have got a email with the license key. Copy that key into http://yoururl/license.php and enter it into the box. Then click "Add"

# How do I Change a key?
The best way to change your key is by going to "Templates/license.txt" file and removing everything. Then pasting in the new key and save.

# DiscordPanel bot
# Whats it for?
The bot is used to check the user id status of bot1,bot2 and bot3 (Diffrent names for you) - But the first 3 bots.

# How do I set it up?
All you need to do is add the bot to a server with the bot you want to check the status of (Remember the first 3 bots in the config only) We reccomend you make a new discord server and adding all 3 bots to that then adding out bot into there so you don't have it on too many servers. 
As long as you have it in all 3 bot 1,2 and 3 servers then its ready to go.

# Do I Need It?
Short answer is, kinda. On the homepage there is 3 widgets for the status and details of the first 3 bots. And if you don't set up the DiscordPanel bot those widgets won't work.

# How do I add it to a server?
Just cick ME then add it to the server/servers you need to.

# Change Log
# [v1.0.0] - 01/06/2018
Initial release.

What is DiscordPanel Pro?
What is Discord?
Install DiscordPanel Pro
Installing
License key
DiscordPanel bot
Change Log
DiscordPanel
Copyright © 2017 - 2018 - DiscordPanel 
All rights reserved.

