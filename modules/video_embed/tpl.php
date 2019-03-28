<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $data['title']; ?></title>
      <?php
         foreach ($data['meta'] as $meta) {
         	echo $meta;
         }
         ?>
      <meta name="author" content="designdnt">
      <meta name="viewport" content="width=device-width" />
      <?php
         $favicon = Settings::getImage($data['meta_settings']['keys']['favicon']['value']);
         ?>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- Chang URLs to wherever Video.js files will be hosted -->
      <link href="<?php echo $data['media_path']; ?>embed/css/video-js.css" rel="stylesheet" type="text/css">
      <!-- video.js must be in the <head> for older IEs to work. -->
      <script src="<?php echo $data['media_path']; ?>embed/js/video.js"></script>
      <style>body {padding: 0px;margin: 0px;background-color: #040e15;}
	  .vjs-poster {background-color: transparent;}
	  </style>
	  <?php
		if($data['meta_settings']['keys']['ga_key']['show'] == 1){
			$ga_key = $data['meta_settings']['keys']['ga_key']['value'];
			?>
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', '<?php echo $ga_key; ?>', 'auto');
			  ga('send', 'pageview');
			</script>
			<?php
		}
		?>
   </head>
   <body>
      <div class="video-js-responsive-container vjs-hd">
         <video id="video_<?php echo $data['video_id']; ?>" class="video-js vjs-default-skin" controls preload="none" 
            poster="<?php echo $data['image']; ?>"
            data-setup="{}">
            <source src="<?php echo $data['video_file']; ?>" type='video/mp4' />
            <p class="vjs-no-js">Prehrávanie nepodporované. Používanie najnovšej verzie prehliadača Google Chrome vám môže pomôcť pri prezeraní tohto obsahu</p>
         </video>
      </div>
      <script>
         /*var player = videojs('video_<?php echo $data['video_id']; ?>');
         player.addClass('sex');*/
          videojs.autoSetup();
         
          videojs('video_<?php echo $data['video_id']; ?>').ready(function(){
            console.log(this.options()); //log all of the default videojs options
            
             // Store the video object
            var myPlayer = this, id = myPlayer.id();
            // Make up an aspect ratio
            var aspectRatio = 264/640; 
         
            function resizeVideoJS(){
              var width = document.getElementById(id).parentElement.offsetWidth;
              myPlayer.width(width).height( window.innerHeight );
         
            }
            
            // Initialize resizeVideoJS()
            resizeVideoJS();
            // Then on resize call resizeVideoJS()
            window.onresize = resizeVideoJS; 
          });
         
         
      </script>
   </body>
</html>