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
		 
		 <div class="blog-grid margin-bottom-30">
            <h2 class="title-v4"><?php echo $data['article']['name'];?></h2>
            <?php 
			$imgMeta = false;
			$nameMeta = false;
			$contentMeta = false;
			$query = ArticleList::query();
				if($db->num_rows($query)>0){
					
					foreach($db->get_results($query) as $row){
					   $img = Image::getPostImage($row['id'],"dnt_posts", IMAGE::SMALL);
					   $content = $row['content'];
					   $perex = $row['perex'];
					   $name = $row['name'];
					   $url = $articleView->detailUrl($row['cat_name_url'], $row['id'], $row['name_url']);

					

               ?>
            <div class="row">
               <div class="col-sm-4" style="margin-top: 10px;">
				<a href="<?php echo $url; ?>" class=""><img src="<?php echo $img;?>" class="img-responsive"></a>
               </div>
               <div class="col-sm-8">
                  <h3 class="title"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></h3>
                  <p class="text-muted"><?php echo $perex ?></p>
               </div>
            </div>
            <hr>
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