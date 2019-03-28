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
		 <style>
			.image_list.blog-grid img {height: 70px;margin: 0px auto;width: initial;}
		 </style>
		 <div class="blog-grid image_list margin-bottom-30">
            <h2 class="title-v4"><?php echo $data['article']['name'];?></h2>
            <?php 
			$query = ArticleList::query();
				if($db->num_rows($query)>0){
					foreach($db->get_results($query) as $row){
					   $img = Image::getPostImage($row['id'],"dnt_posts",Image::SMALL);
					   $content = $row['content'];
					   $perex = $row['perex'];
					   $name = $row['name'];
					   if(Dnt::is_external_url($row['name_url'])){
							$url = $row['name_url'];
							$target = "_blank";
					   }else{
							$url = $articleView->detailUrl($row['cat_name_url'], $row['id'], $row['name_url']);
							$target = "_self";
					   }
               ?>
               <div class="col-sm-6" style="margin-top: 50px;">
				<a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class=""><img src="<?php echo $img;?>" class="img-responsive"></a>
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