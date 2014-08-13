<?php
$ac = isset($_GET['ac']) ? $_GET['ac'] : '';
if(!$ac){
?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div>
	<ul>
		<li><a href="?ac=bonus" target="_blank">用户中心：红包列表=>我的红包  ?url=bonus</a></li>
		<li><a href="?ac=searchBybrand" target="_blank">品牌列表：=>根据品牌ID调用下属所有商品｛一次8条，返回带剩余页数｝  ?url=search&filter[brand_id]=15</a></li>
		<li><a href="?ac=applybrand" target="_blank">用户中心：=>驻站申请｛提交｝  ?url=applybrand</a></li>
		<li><a href="?ac=applyshow" target="_blank">用户中心：=>驻站申请｛展示申请项内容｝  ?url=applyshow</a></li>
		<li><a href="?ac=showbrand" target="_blank">艺术家页面  /showbrand&brand_id=4</a></li>
		<li><a href="?ac=signupbrand" target="_blank">艺术家申请  /user/signupbrand</a></li>
	</ul>
</div>
<?php
} elseif($ac=='bonus') {
//用户中心：红包列表=>我的红包
	$json['data'][] = array(
			'bonus_sn'=>'红包编号 显示为 N/A 即可',
			'type_name'=>'红包名称',
			'type_money'=>'红包金额',
			'min_goods_amount'=>'最小订单金额',
			'use_enddate'=>'截止使用日期',
			'status'=>'红包状态'
	);
	$json['status'] = array(
			'succeed'=>'1'
	);
	echo json_encode($json);
} elseif($ac=='searchBybrand'){
		$json['data'][] = array(
		'goods_id'=>'商品编号',
		'name'=>'商品名称',
		'market_price'=>'市场价',
		'shop_price'=>'本店售价',
		'promote_price'=>'活动价',
		"img"=>array(
            "thumb"=>"商品缩略图",
            "url"=> "商品原图",
            "small"=> "商品小图"
            )
        );
	$json['status'] = array(
			'succeed'=>'1'
	);
	$json['paginated'] = array(
			'total'=>'总数',
			'count'=>'每页固定8条',
			"more"=> '1为有下一页0为没有'
	); 	
	echo json_encode($json);
}elseif($ac=='applybrand'){
	$json['data'] = array(
			'username'=>'用户名',
			'mobile'=>'手机号',
			'password'=>'密码',
			'realname'=>'真实姓名',
			'jiguan'=>'籍贯',
			'birthday'=>'出生日期',
			'school'=>'出生日期',
			'remark'=>'个人经历和获奖'
	);
	echo json_encode($json);
}elseif($ac=='applyshow'){
	$json['data'] = array(
			'username'=>'用户名',
			'mobile'=>'手机号',
			'realname'=>'真实姓名',
			'jiguan'=>'籍贯',
			'birthday'=>'出生日期',
			'school'=>'出生日期',
			'remark'=>'个人经历和获奖',
			'ispass'=>'2为审核通过1为审核中0为否'
	);
	$json['status'] = array(
			'succeed'=>'1'
	);
	echo json_encode($json);
}elseif($ac=='showbrand'){
		$json['data'] = array(
			'brandimg'=>'艺术家主图片',
			'truename'=>'艺术家姓名',
			'brithday'=>'艺术家生日',
			'jiguan'=>'艺术家籍贯',
			'remark'=>'艺术家介绍',
			'brandid'=>'艺术家ID'
	);
	$json['status'] = array(
			'succeed'=>'1'
	);
	echo json_encode($json);
}

?>