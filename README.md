Pointcloud Web Viewer
=============

Pointcloud Web Viewer is a webpage based on Three.js to visualize point clouds. You can see it in action here:
[SRV Point Cloud Viewer][link_srv]


How to use it
-------

Download the code and upload it to your server (using for example [FileZilla][link_filezilla]). You can modify it as you wish to meet your requirements.

Then, you have to upload your pointclouds into the 'data' directory. Every pointcloud must be a folder with the following structure:

 - data
	- pointcloud_1
		- pc.csv
		- info.csv
		- img.png
	- pointcloud_2
		- pc.csv
		- info.csv
		- img.png
	- ...

The pc.csv is the pointcloud itself and must have the following format:

x, y, z, r, g, b

One point for each line, separated by commas. r, g, b, are integers of the primary colors (red, green and blue) from 0 to 255.

Example:

-2.09482,0.305857,0.203584,219,225,199
-2.46393,0.879894,0.204576,238,243,203
-2.42189,0.920989,0.200718,254,254,232
....

The info.csv file has 2 lines:
title,This is the pointcloud title
meta,This is the pointcloud description

The img.png must be a 600x500px image thumbnail.



Configuration
-------

Please, before running the webpage, open index.php and configure the main parameters.



Mouse controls
-------

- Rotate: Hold down the left mouse button and move
- Zoom in/out: You have 2 options:
	a) Rotate mouse wheel
	b) Hold down the mouse wheel and move
- Pan: Hold down the right mouse button and move


Compatibility with Point Cloud Library (PCL)
-------

If you are using the [Point Cloud Library (PCL)][link_pcl] for your 3D projects, and want to plot your .pcd files, you have to convert them to the format specified before. I've created a [ROS][link_ros] node that takes a .pcd file (XYZ or XYZRGB) and convert it to .csv file that can be directly used by the Pointcloud Web Viewer ([Source Code][link_pointcloud_to_webgl]).


Problems to visualize it?
-------

Three.js is a javascript library based on WebGL. WebGL is NOT suported by all browsers, you can check the compatibility of your hardware/software with webgl here:

[WebGL Check Compatibility][link_webgl]

If you don't see a spinning cube you can not use this software neither. To solve this problem, you can try the following:

* Install Google Chrome Web Browser
* If you can not see the cube using Google Chrome, type this in your address bar: chrome://flags/ and make sure you have enabled the following features:
	1. Flag 'Override software rendering list' IS ENABLED
	2. Flag 'Disable WebGL' IS DISABLED
* If you have changed some of these flags, restart Google Chrome and try again.
* If this does not solve the problem, make sure that your graphic card supports 3D acceleration.


What is wrong?
-------

Many things, this is just a preliminary version of the code, any contribution is welcome!



[link_srv]: http://srv.uib.es/pointclouds/
[link_filezilla]: https://filezilla-project.org/
[link_cirs]: http://cirs.udg.edu/CIRS/News/News.html
[link_webgl]: http://get.webgl.org/
[link_pcl]: http://pointclouds.org/
[link_pointcloud_to_webgl]: https://github.com/srv/srv_tools/blob/indigo/pointcloud_tools/src/pointcloud_to_webgl.cpp
[link_ros]: http://ros.org/
