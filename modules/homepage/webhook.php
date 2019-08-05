<?php
class homepageModulController extends Client{
	
	private $posts;
	private $gallery;
	
	public function run(){
		$article 	= new ArticleView;
		$rest 		= new Rest;
		$id = $article->getStaticId();
		$articleName = $article->getPostParam("name",  $id);
		$articleImage = $article->getPostImage($id);
		
		$custom_data = array(
			"title" =>  "".Settings::get("title") ,
			"meta" => array(
				 '<meta name="keywords" content="'.$article->getPostParam("tags",  $id).'" />',
				 '<meta name="description" content="'.Settings::get("description").'" />',
				 '<meta content="'.$articleName.'" property="og:title" />',
				 '<meta content="'.SERVER_NAME.'" property="og:site_name" />',
				 '<meta content="article" property="og:type" />',
				 '<meta content="'.$articleImage.'" property="og:image" />',
			),
		);
		$data = Frontend::get($custom_data);
		
		$this->preparePostsQuery();
		$this->prepareSmallGallery($data);
		$this->useLayout($data);
		
	}
	
	private function preparePostsQuery(){
		$db = new Db;
		$catId = "304";
		$query = "SELECT * FROM dnt_posts WHERE type = 'post' AND cat_id = '".$catId."' AND vendor_id = '".Vendor::getId()."' AND `show` > 0";
		if($db->num_rows($query)>0){
			$this->posts = $db->get_results($query);
		}else{
			$this->posts = false;
		}
	}
	
	private function prepareSmallGallery($data){
		$rest = new Rest();
		$GALLERY = explode(",", $data['meta_tree']['keys']['gallery']['value']);
		if(count($GALLERY>0)){
			$this->gallery = $GALLERY;
		}else{
			$this->gallery = false;
		}
	}
	
	private function useLayout($data){
		$multylanguage 	= new MultyLanguage;
		$article 		= new ArticleView;
		
		include "dnt-view/layouts/".Vendor::getLayout()."/tpl_functions.php";
		get_top($data);
		include "dnt-view/layouts/".Vendor::getLayout()."/top.php";
		include "tpl.php";
		get_footer($data);
		include "dnt-view/layouts/".Vendor::getLayout()."/bottom.php";
	}
}

$modul = new homepageModulController;
$modul->run();