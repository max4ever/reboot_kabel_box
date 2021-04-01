# reboot_kabel_box
Reboot your vodafone kabel_box(CH7466CE  Wireless Voice Gateway       Firmware version 4.50.20.3) router.

You need `chromium-browser + chromedriver` installed for this to work.
`sudo apt-get install chromium-chromedriver`

Add this to your crontab to run every night(first run always fails).

`0 5 * * * (cd /home/pi/reboot-router && rm -rf ./tests/_output/debug/*.png &&  /usr/bin/php ./vendor/bin/codecept run run acceptance KabelBoxCest --debug) >> /home/pi/reboot-router.log 2>&1`

To Logout

`(cd /home/pi/reboot-router && /usr/bin/php ./vendor/bin/codecept run acceptance KabelBoxLogoutCest --debug )`