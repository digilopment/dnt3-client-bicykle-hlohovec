<?php
class imageListModulController{
	
	private $posts;
	
	public function run(){
		$article 	= new ArticleView;
		$rest 		= new Rest;
		$id = $article->getStaticId();
		$articleName = $article->getPostParam("name",  $id);
		$articleImage = $article->getPostImage($id);
		
		$custom_data = array(
			"title" =>  $articleName ." | ".Settings::get("title") ,
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
		$this->useLayout($data);
		
	}
	
	private function preparePostsQuery(){
		$db = new Db;
		$query = ArticleList::query();
		if($db->num_rows($query)>0){
			$this->posts = $db->get_results($query);
		}else{
			$this->posts = false;
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

$modul = new imageListModulController;
$modul->run();