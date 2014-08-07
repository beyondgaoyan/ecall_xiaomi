<?php
//brand 接口路径 http://182.92.99.6/ecshop273/ecmobile/?url=/indexhot
/*
 *                                                                          
 * 手机端首页  热点 ［is_index=1］艺术家＋[is_best=1]商品 by gaoyan
 */

require(EC_PATH . '/includes/init.php');

$data = array();

if (!empty($cat_id)) {
	$children = get_children($cat_id);
	$sql = "SELECT b.brand_id, b.brand_name, b.brand_logo, COUNT(*) AS goods_num ".
	            "FROM " . $GLOBALS['ecs']->table('brand') . "AS b, ". $GLOBALS['ecs']->table('goods') . " AS g LEFT JOIN ". $GLOBALS['ecs']->table('goods_cat') . " AS gc ON g.goods_id = gc.goods_id " .
	            "WHERE g.brand_id = b.brand_id AND ($children OR " . 'gc.cat_id ' . db_create_in(array_unique(array_merge(array($cat_id), array_keys(cat_list($cat_id, 0, false))))) . ") AND b.is_show = 1 " .
	            " AND g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 ".
	            "GROUP BY b.brand_id HAVING goods_num > 0 ORDER BY b.sort_order, b.brand_id ASC";

	$brand_list = $GLOBALS['db']->getAll($sql);
} else {
	$brand_list = get_brands();
}
$data[brand][title]='艺术家列表';
foreach ($brand_list as $key => $val) {
    $data[brand][dates][] = array(
          'imageurl' => getImage('data/brandlogo/'.$val['brand_logo']),//品牌图片全路径by gaoyan
          'brand_name' => $val['brand_name'],
          'brand_id' => $val['brand_id'],
          'type' => 'brand'
      );
}
$data[good][title]='推荐商品';
$data[good][dates]=array();
GZ_Api::outPut($data);
?>