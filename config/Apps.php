<?php
Class Apps{
	/*
	| Instance Layouting Admin
	*/
	function adminHead(){
		include "../layout/master-admin-header.php";	
	}
	function adminFooter(){
		 include "../layout/master-admin-footer.php";	
	}
	function blogHeader(){
		include "../layout/master-blog-header.php";
	}
	function blogFooter(){
		include "../layout/master-blog-footer.php";
	}
	function clientHeader(){
		include "../layout/master-client-header.php";
	}
	function clientFooter(){
		include "../layout/master-client-footer.php";
	}
}


