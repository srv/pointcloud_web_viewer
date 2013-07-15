Pointcloud Web Viewer
=============

Pointcloud Web Viewer is a webpage based on Three.js to visualize point clouds. You can see it in action here:
[SRV Point Cloud Viewer][link_srv]


How to use it
-------

Download the code and upload it to your server (using for example [FileZilla][link_filezilla]). You can modify it as you wish to meet your requirements.

Then, you have to upload pointcloud files in ASCII mode into the 'data' directory. The format of these files must be as follows:

-2.09482,0.305857,0.203584,219,225,199
-2.46393,0.879894,0.204576,238,243,203
-2.42189,0.920989,0.200718,254,254,232
....

One point for each line, separated by commas and with the following meaning:
x, y, z, r, g, b

Where r, g, b, are integers of the primary colors (red, green and blue) from 0 to 255.

What is wrong?
-------

Many things, this is a preliminary version of the code, any contribution is welcome!


Acknowledgements
-------

The example pointcloud included in the code (data/pool_demo.txt) was taken with Girona500, an AUV from the [University of Girona][link_cirs] (Spain).

[link_srv]: http://srv.uib.es/pointclouds/
[link_filezilla]: https://filezilla-project.org/
[link_cirs]: http://cirs.udg.edu/CIRS/News/News.html