<?php
//brand 接口路径 http://182.92.99.6/ecshop273/ecmobile/?url=/showbrand&brand_id=4
/*
 * 艺术家展示界面接口 by gaoyan
 */

require(EC_PATH . '/includes/init.php');
// define('DEBUG_MODE', 1);
// define('INIT_NO_SMARTY', true);
// $smarty = new GZ_Smarty('search');

$data = array();
//by gy 支持url地址传参
if(isset($_GET['brand_id'])){
	$brand_id = _GET('brand_id');
}else{
	$brand_id = _POST('brand_id');
}


if (!empty($brand_id)) {
	$sql = "SELECT b.brand_name, brand_logo,re.reg_field_id,re.content,rf.id,rf.reg_field_name ".
	            "FROM " . $GLOBALS['ecs']->table('brand') . "AS b LEFT JOIN ". $GLOBALS['ecs']->table('reg_extend_info') . " AS re ON re.user_id=b.user_id LEFT JOIN ". $GLOBALS['ecs']->table('reg_fields') . " AS rf ON rf.id=re.reg_field_id " .
	            "WHERE b.brand_id='$brand_id' AND b.is_show = 1 ";

	$brandinfo = $GLOBALS['db']->getAll($sql);
	if(!empty($brandinfo)){
		foreach($brandinfo AS $v){
			$rf[$v['id']]=$v['reg_field_name'];
			$re[$v['reg_field_id']]=$v['content'];
		}
	}
	$data =array(
			'brandimg'=>!empty($brandinfo[0]['brand_logo']) ? getImage('data/brandlogo/'.$brandinfo[0]['brand_logo']):'',//品牌图片全路径by gaoyan,
			'truename'=>$re[100],
			'brithday'=>$re[102],
			'jiguan'=>$re[101],
			'remark'=>$re[104],
			'brandid'=>$brand_id
	);
} 
GZ_Api::outPut($data);
?>