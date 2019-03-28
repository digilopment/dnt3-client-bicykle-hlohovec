<?php
include "dnt-view/layouts/".Vendor::getLayout()."/tpl_functions.php";
$data = Frontend::get();
get_top($data);
include "dnt-view/layouts/".Vendor::getLayout()."/top.php";

$rest 		= new Rest;
$db 		= new Db;
$articleView 		= new ArticleView;
$webhook 		= new Webhook;
?>
<div class="margin-bottom-60"></div>
<div class="container panel panel-primary dnt-poll">
   <div class="container">
      <div class="row">
         <div class="col-md-9">
		 <div class="blog-grid image_list margin-bottom-30">
            <h2 class="title-v4"><?php echo $data['article']['name'];?></h2>
            <?php 
			$GALLERY = explode(",", $data['meta_tree']['keys']['gallery']['value']);
			if(count($GALLERY>0)){
			foreach ($GALLERY as $item) {
				$img = Image::getFileImage($item, true, Image::SMALL);
               ?>
               <div class="col-sm-4" style="margin-top: 10px;">
				<a data-lightbox="gallery" href="<?php echo Image::getFileImage($item); ?>" target="_blank" class=""><img src="<?php echo $img;?>" class="img-responsive"></a>
               </div>
            <?php 
               }
                }else{
				?>
				<h3 class="title"><?php echo $data['article']['perex']; ?></h3>
				<?php echo $data['article']['content']; ?>
				<?php
                }
               ?>
         </div>
         </div>
         <div class="col-md-3">
            <?php col_right($data); ?>
         </div>
      </div>
   </div>
</div>
<?php
get_footer($data);
get_bottom($data);