  <?php
  include('header.php');
  ?>

  <a href="https://github.com/srv/pointcloud_web_viewer"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>

  <script type="text/javascript">
  $( document ).ready(function() {
      $("[rel='tooltip']").tooltip();

      $('.thumbnail').hover(
          function(){
              $(this).find('.caption').slideDown(350); //.fadeIn(250)
          },
          function(){
              $(this).find('.caption').slideUp(250); //.fadeOut(205)
          }
      );
  });
  </script>

  <!-- Top -->
  <div class="row">

    <div class="col-lg-8">
      <h1 style="font-size:50px;">SRV Pointclouds</h1><br />
      <p class="lead">List of 3D reconstructions performed by researchers of our group. Your browser must have <a href="http://get.webgl.org/" target="_blank">WebGL support</a> for proper display.</p>
    </div>

    <div class="col-lg-2 col-lg-offset-2">
      <div style="width:100%; height: 20px;"></div>
      <a title="SRV Group" href="http://srv.uib.es"><img class="img-responsive" src="img/logo.png" width="150"></a>
    </div>

  </div>


  <!-- Separator -->
  <div class="row" style="text-align:center;">
    <div class="col-lg-12 col-sm-12 col-xs-12">
      <hr>
    </div>
  </div>

  <!-- Showcase -->
  <div class="row">
  <?php
  foreach (new DirectoryIterator(DATAFOLDER) as $dirInfo) {
    if($dirInfo->isDir() && !$dirInfo->isDot()) {
      // Info file
      $pcFile = DATAFOLDER . '/' . $dirInfo->getFilename() . '/' . PCFILE;
      $infoFile = DATAFOLDER . '/' . $dirInfo->getFilename() . '/' . PCINFO;

      if (file_exists($pcFile) && file_exists($infoFile)) {

        // Read the info
        $folderName = $dirInfo->getFilename();
        $fi = fopen($infoFile, 'r');
        $title = fgetcsv($fi);
        $meta = fgetcsv($fi);
        fclose($fi);

        // Sanity check
        if (sizeof($title) == 2) {
          $title = $title[1];

          $desc = '';
          if (sizeof($meta) == 2) {
            $desc = $meta[1];
          }
          $imgFile = DATAFOLDER . '/' . $dirInfo->getFilename() . '/' . PCIMG;
          if (!file_exists($imgFile)) {
            $imgFile = 'img/default.png';
          }

          $pcSize = round(filesize($pcFile) / (1024*1024));

          ?>
          <div class="col-lg-4 col-sm-4 col-xs-6">
            <div class="thumbnail">
              <div class="caption">
                <h2><?php echo $title ?></h2>
                <div style="text-align:left; padding:10px;">
                  <h4><?php echo $desc ?></h4>
                  <h4>Size: <?php echo $pcSize ?>MB.</h4>
                </div>
                <p><a class="btn btn-lg btn-primary" href="view/<?php echo $folderName ?>">View</a></p>
              </div>
              <img class="img-responsive" src="<?php echo $imgFile ?>">
            </div>
          </div>
          <?php
        }
      }
    }
  }
  ?>
  </div>

  <?php
  include('footer.php');
  ?>