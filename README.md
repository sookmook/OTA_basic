> # Automatic updating system at boot via OTA for ESP32

**1. Overview**

Not long ago, I received a request from MOSCA Inc. to make it easy to update the firmware of multiple devices based on ESP32.
I immediately thought of the OTA function in the ESP series, and started searching the Internet to find the functions and example source files needed for that function. But unfortunately, I couldn't find any example source files with the functions I wanted.

The function I wanted was to compare the firmware binary file on the server as soon as the device boots up, and if it is newer than the current firmware, update the firmware and then reboot, otherwise go into the normal routine.

To do that, I needed a function that could find out the creation time of a file on the server, but I couldn't find such a function no matter how much I searched through existing libraries. (Of course, even though such a function already exists, I may not have been able to find it, so if anyone knows of such a function, please contact me.)

Basically, in order to use the OTA function, you need to download and install the related libraries in advance. And to save the current firmware creation time in the device, EEPROM memory in ESP32 is used. Be sure to obtain the library related to this. In this regard, refer to the names of the libraries at the beginning of the main source file, and use the 'Tools > Manage Libraries...' item from the menu in the Arduino IDE.

![Tools > Manage Libraries...](https://github.com/sookmook/OTA_basic/blob/main/Arduino_menu_ML.png)

Anyway, I made a simple PHP file to find the creation time of a file on the server. In that way, if you put this PHP file and the new firmware binary file on the server, it is configured so that all tasks can be solved simply. (It is recommended to set the permission to 755 when uploading the PHP file to the server, and set the permission for the firmware binary file to 744.)

**2. Modification of source files**

sure! Before doing all this, you need to make some changes to the contents of the source files. It is a very easy task. You just need to modify a few constants and a few variables.
* ***OTA_basic.ino :*** Main source file for OTA implementation.

> ***WIFI_CONNECT_SSID*** - SSID for wireless router connection.

> ***WIFI_CONNECT_PSWD*** - Password to connect to the wireless router.

> ***otaDirURL*** - The correct access path of the server where the firmware binary file is loaded.

> ***otaBinFilename*** - Firmware binary file name. (ex: OTA_basic.ino.esp32.bin)


* ***otaCheck.php :*** Source file containing the file creation time check function to be uploaded to the server along with the firmware binary file.

> ***filename*** - Firmware binary file name with the same meaning as otaBinFilename described above.

**3. Let's try it.**

If you basically modified the two source files as described above, let's make your own code by modifying the contents of the setup() and loop() functions in earnest from now on. And let's make a binary file by selecting the 'Sketch > Export compiled Binary' item from the Arduino IDE menu.
Lastly, please upload the otaCheck.php file and the firmware binary file to the specified path on the server.

![Sketch > Export compiled Binary](https://github.com/sookmook/OTA_basic/blob/main/Arduino_menu_ECB.png)

In the case of modifying the source file from now on, only the binary file of the modified source needs to be uploaded to the server.

Good luck to you.

**4. Links referenced in production**

*ESP32 Web Updater Over The Air (OTA) Programming In Arduino IDE*

https://lastminuteengineers.com/esp32-ota-web-updater-arduino-ide/

*ESP32 HTTPS OTA Update “Magic header does not start with 0xE9”*

https://community.platformio.org/t/esp32-https-ota-update-magic-header-does-not-start-with-0xe9/18028

*ESP32 HTTP GET and HTTP POST with Arduino IDE (JSON, URL Encoded, Text)*

https://randomnerdtutorials.com/esp32-http-get-post-arduino/#http-get-1
