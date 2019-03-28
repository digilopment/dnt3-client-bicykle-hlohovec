<?php


include "dnt-view/layouts/".Vendor::getLayout()."/tpl_functions.php";
$data = Frontend::get();
get_top($data);
$multylanguage 	= new MultyLanguage;
$article 		= new ArticleView;
$translate['citat_viac'] = MultyLanguage::translate($data, "citat_viac", "translate");
include "dnt-view/layouts/".Vendor::getLayout()."/top.php";
?>

      <!-- End header-v8 -->
      <?php get_slider($data); ?>
      <div class="container margin-bottom-40">
	  <?php
                     $post_type = "texty-na-homepage";
                     $query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '".AdminContent::getCatId($post_type)."' AND vendor_id = '".Vendor::getId()."' AND `show` > 0";
                     if($db->num_rows($query)>0){
		?>
         <div class="col-md-12 homepage">
            <div class="masonry-box homepage-items">
               <div class="row">
                  <?php
                     	foreach($db->get_results($query) as $row){
                     ?>
					  <div class="blog-grid masonry-box-in col-3">
						 <h3><a href="<?php echo Url::getPostUrl($row['name_url']) ?>">
						 <?php echo $row['name']; ?></a></h3>
						 <hr>
						 <p><?php echo $row['perex']; ?></p>
						 <a class="r-more" href="<?php echo Url::getPostUrl($row['name_url']) ?>"><?php echo $translate['citat_viac'];?></a>
					  </div>
					<?php
                     }
                   ?>
               </div>
            </div>
            <!-- End Blog Grid -->
         </div>
		 <?php
		   }
          ?>
		  <?php if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) { 
		  $logo_firmy = Settings::getImage($data['meta_settings']['keys']['logo_firmy']['value']);
		  ?>
		  <img class="center-block" src="<?php echo $logo_firmy; ?>" alt="logo" />
                <?php } ?>
			<div class="col-xs-12 text-center padding-20">
				<?php echo $data['article']['content'];?>
				<br/>
				<div style="max-width:500px" class="center-block">
					<?php echo get_video_embed($data, "15021", "transparent");?>
				</div>
			</div>
      </div>

<?php
get_footer($data);
get_bottom($data);