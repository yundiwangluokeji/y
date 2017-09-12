http://pan.baidu.com/share/qrcode?w=150&h=150&url=http://www.baidu.com--二维码接口
--------------------------
-- 创建数据库
--------------------------
create database if not exists `y` DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

--管理员表
create table if not exists `yd_admin`(
`admin_id` int(11) unsigned not null auto_increment primary key,
`username` char(30) unique not null default '' COMMENT '用户名',
`password` varchar(255) not null default '' COMMENT	'密码',
`secret` varchar(64) not null default '' COMMENT '密钥(Xcrypt中的VI)',
`addtime` int COMMENT '创建时间'
)engine=innodb default charset='utf8';
---------------------------
--用Xcrypt加密添加管理员 key=95664752368511453358971294651651 VI=56474061254058937921467785493582 密码=123456
---------------------------
insert into yd_admin(username,password,secret,addtime) values('admin','Aj7+3fKNHCPqL3jTxBiocC+4E712KVicq6yLqMNRKnA=','56474061254058937921467785493582',unix_timestamp(now()));


/*
-- 总平台配置表
*/
create table if not exists `yd_config`(
`config_id` int(11) unsigned not null auto_increment primary key,
`configname` char(50) not null default '' COMMENT '配置名称',
`configkey` char(50) unique not null default '' COMMENT '配置key' ,
`configval` varchar(255) not null default '' COMMENT '配置值',
`configsorting` int(11) unsigned not null default 0 COMMENT '配置排序',
`configaddtime` int unsigned COMMENT '添加配置时间',
`configupdatetime` timestamp
)engine=innodb default charset="utf8";
INSERT INTO `yd_config` VALUES ('1', '网站标题', 'title', '某某钟表有限公司', '0', '1503900186', '1503969557');
INSERT INTO `yd_config` VALUES ('2', 'logo', 'logo', '2017-08-28/59a43bd9961ec.jpg', '0', '1503905263', '1503935449');
INSERT INTO `yd_config` VALUES ('3', '关键词', 'keywords', 'phpshe,php,shop,php商城系统', '0', '1503914214', '1503969557');
INSERT INTO `yd_config` VALUES ('4', '网站描述', 'description', 'phpshe,php,shop,php商城系统,b2c商城系统', '0', '1503914214', '1503969557');
INSERT INTO `yd_config` VALUES ('5', '微信二维码', 'wechat', '2017-08-28/59a43bd996a31.jpg', '0', '1503914214', '1503935449');
INSERT INTO `yd_config` VALUES ('6', '咨询电话', 'tel', '15839823500', '0', '1503914232', '1503969557');
INSERT INTO `yd_config` VALUES ('7', '咨询QQ', 'qq', '76265959', '0', '1503914233', '1503969557');
INSERT INTO `yd_config` VALUES ('8', '版权所有', 'copyright', '云狄网版权所有', '0', '1503914233', '1503969557');
INSERT INTO `yd_config` VALUES ('9', '备案号', 'record_no', '豫ICP备17013559号-1', '0', '1503914233', '1503969557');
INSERT INTO `yd_config` VALUES ('10', '热门搜索', 'hot', 'PHPSHE,B2C商城系统,简好网络', '0', '1503914233', '1503969558');
INSERT INTO `yd_config` VALUES ('11', '统计代码', 'count', '', '0', '1503931018', '1503969558');

/*
--品牌表
*/
create table if not exists `yd_brand`(
`brand_id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default ''  COMMENT '品牌名称',
`logo` varchar(255) not null default '' COMMENT '品牌logo',
`sorting` int(11) unsigned not null default 0 COMMENT '排序',
`addtime` int unsigned COMMENT '添加时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";



/*
--商品分类表
*/
create table if not exists `yd_classification`(
`brand_id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default ''  COMMENT '分类名称',
`sorting` int(11) unsigned not null default 0 COMMENT '排序',
`addtime` int unsigned COMMENT '添加时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";


/*
--商品表
*/
create table if not exists `yd_goods`(
`goods_id` int(11) unsigned not null auto_increment primary key,
`name` varchar(255) not null default '' COMMENT '商品名称',
`keywords` varchar(255) not null default '' COMMENT '商品关键词',
`description` varchar(255) not null default '' COMMENT '商品描述',
`brand_id` int(11)  unsigned not null default 0 COMMENT '品牌id',
`class_id` int(11) unsigned null default 0 COMMENT '分类id',
`goods_sn` char(30) not null default '' COMMENT '商品编号 当前时间拼接上四位随机数 2017082830286666',
`click_count` int(10) unsigned not null default 0 COMMENT '点击数',
`inventory` smallint(5) not null default 0 COMMENT '库存',
`price` decimal(10,2) unsigned not null default 0 COMMENT '商品价格',
`images` varchar(255) not null default '' COMMENT '商品缩略图',
`is_shelves` tinyint(1) unsigned not null default 0 COMMENT "是否上架(1上架,0否)",
`is_recommend` tinyint(1) unsigned not null default 0 COMMENT "是否推荐(1推荐,0否)",
`sales_sum` int(11) unsigned not null default 0 COMMENT '商品销量',
`color` char(20) not null default '' COMMENT '商品颜色多选(格式：红色,白色,黑色...)',
`body` text COMMENT '商品主体内容',
`sorting` int(11) unsigned not null default 0 COMMENT '排序',
`addtime` int unsigned COMMENT '商品添加时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";
/*
--商品颜色：钢壳白面,白壳黑面,介金白面,介金黑面,介金金面,金壳白面,金壳金面,金壳黑面,玫瑰金壳白面玫瑰金壳黑面,玫瑰金壳玫瑰金面,介玫瑰金壳白面,介玫瑰金壳黑面,介玫瑰金壳玫瑰金面
*/


/*
--代理商 商品表
*/
create table if not exists `yd_agent_goods`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) unsigned not null default 0 COMMENT '代理商id',
`agent_goods_id` int(11) unsigned not null default 0 COMMENT '商品id',
`agent_price` decimal(10,2) unsigned not null default 0 COMMENT '商品价格',
`agent_color` char(20) not null default '' COMMENT '商品颜色多选(格式：红色,白色,黑色...)',
`agent_is_recommend` tinyint(1) unsigned not null default 0 COMMENT "是否推荐(1推荐,0否)",
`agent_is_shelves` tinyint(1) unsigned not null default 0 COMMENT "是否上架(1上架,0否)",
`agent_sales_sum` int(11) unsigned not null default 0 COMMENT '商品销量',
`agent_inventory` smallint(5) not null default 0 COMMENT '库存',
`agent_click_count` int(10) unsigned not null default 0 COMMENT '点击数',
`agent_sorting` int(11) unsigned not null default 0 COMMENT '排序',
`goods_permissions` tinyint(1) unsigned not null default 0 COMMENT '商品浏览权限(0不公开,1对登录用户公开,2完全公开,代理商可以在后台分享一个二维码普通用户扫描二维码查看此商品--30分钟内有效)',
`state` tinyint(1) unsigned not null default 0 COMMENT '商品状态(1购买的商品,2预定的商品)',
`agent_addtime` int unsigned COMMENT '商品添加时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";

/*
--代理商 收藏表
*/
create table if not exists `yd_agent_collection`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) unsigned not null default 0 COMMENT '代理商id',
`goods_id` int(11) unsigned not null default 0 COMMENT '商品id',
`addtime` int unsigned COMMENT '商品添加时间'
)engine=innodb default charset="utf8";



/*
--代理配置表
*/
create table if not exists `yd_agent_config`(
`id` int unsigned not null auto_increment primary key,
`name` varchar(100) not null default '' COMMENT '代理商名称',
`agent_id` int(11) unsigned not null default 0 COMMENT '代理商id',
`logo` varchar(255) not null default '' COMMENT '代理商logo',
`mobile` char(20) not null default '' COMMENT '手机号',
`tel` char(20) not null default '' COMMENT '电话',
`address` varchar(255)  not null default ''  COMMENT '地址',
`weixin` varchar(255)  not null default ''  COMMENT '代理商微信二维码',
`addtime` int COMMENT '创建时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";


/*
--代理商表
*/
create table if not exists `yd_agent`(
`id` int(11) unsigned not null auto_increment primary key,
`username` char(30) unique not null default '' COMMENT '用户名',
`password` varchar(255) not null default '' COMMENT	'密码',
`secret` varchar(64) not null default '' COMMENT '密钥(Xcrypt中的VI)',
`mobile` char(20) not null default '' COMMENT '代理商手机号',
`level` tinyint(1) unsigned not null default 0 COMMENT '代理商级别1,2,3',
`father` int(11) unsigned not null default 0 COMMENT '父id',
`path` varchar(255) not null default '' COMMENT '代理商关系路径(0_1_5_66)',
`status` tinyint(1) unsigned not null default 0 COMMENT '用户状态(0禁用,1正常)',
`addtime` int COMMENT '创建时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";


/*
--代理商钱包 money
*/
create table if not exists `yd_money`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) not null default 0 COMMENT '代理商id',
`money` varchar(255) not null default '0' COMMENT '货币(分为单位)',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";
------------------------------------------------------------------------------------------------------------------
/*
--货币操作记录表
*/
create table if not exists `yd_money_log`(
`id` int(11) unsigned not null auto_increment primary key,
`operation` int(11) not null default 0 COMMENT '操作者id(代理商id)',
`agent_id` int(11) not null default 0 COMMENT '被操作者id(代理商id)',
`money_id` int(11) not null default 0 COMMENT '钱包id',
`money` varchar(255) not null default '0' COMMENT '货币(分为单位，支出负数-10，收入正数+10)',
`ip` char(30) not null default '' COMMENT '操作ip',
`address` varchar(255) not null default '' COMMENT '操作地址',
`res` tinyint(1) not null default 0 COMMENT '操作结果(1成功,0否)',
`type` tinyint(1) not null default 0 COMMENT '操作内型(1收入,0支出)',
`msg` char(50) not null default '' COMMENT '操作信息',
`time` int(11) unsigned COMMENT '操作时间'
)engine=innodb default charset="utf8";





/*
-- 充值记录表
*/
create table if not exists `yd_topup`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) not null default 0 COMMENT '(代理商id)',
`pay_type` tinyint(1) not null default 0 COMMENT '支付方式(1微信,2支付宝)',
`order` char(25) not null default '' COMMENT '充值时使用的订单号(当前时间拼接上四位随机数共20位 2017082830286666)',
`order_sn` char(50) not null default '' COMMENT '第三方交易单号(支付宝，微信)',
`res` tinyint(1) not null default 0 COMMENT '操作结果(0未支付,1成功,2支付失败)',
`name` varchar(255) not null default '' COMMENT '商品名称',
`price` decimal(10,2) unsigned not null default 0 COMMENT '充值金额',
`url` varchar(255) not null default '' COMMENT '收银台页面上，商品展示的超链接',
`body` char(50) not null default '' COMMENT '操作信息(商品描述)',
`time` int(11) unsigned COMMENT '操作时间'
)engine=innodb default charset="utf8";


/*
--提现申请表 withdrawal
*/
create table if not exists `yd_withdrawal`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) not null default 0 COMMENT '(代理商id)',
`pay_type` tinyint(1) not null default 0 COMMENT '收款方式(1银行卡,2支付宝)',
`res` tinyint(1) not null default 0 COMMENT '操作结果(0新申请,1已打款,2已收款)',
`name` varchar(255) not null default '' COMMENT '收款方式名称(如：支付宝、工商银行...)',
`amount` decimal(10,2) unsigned not null default 0 COMMENT '提现金额',
`username` char(30)  not null default ''  COMMENT '收款人姓名',
`account` varchar(255)  not null default ''  COMMENT '收款账号',
`time` int(11) unsigned COMMENT '操作时间'
)engine=innodb default charset="utf8";



/*
--代理商登录日志表
*/
create table if not exists `yd_login_log`(
`id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default '' COMMENT '登录名称',
`pass` varchar(255) not null default '' COMMENT	'登录密码',
`ip` char(30) not null default '' COMMENT '登录ip',
`address` varchar(255) not null default '' COMMENT '登录地址',
`res` tinyint(1) not null default 0 COMMENT '登录结果(1成功,0否)',
`msg` char(50) not null default '' COMMENT '登录信息',
`time` int(11) unsigned COMMENT '登录时间'
)engine=innodb default charset="utf8";


-------------------------------------------------------------------------------------------

/*
--代理商地址表
*/
create table if not exists `yd_address`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) not null default 0 COMMENT '收货人id(代理商id)',
`name` char(30) not null default '' COMMENT '收货人用户名',
`mobile` char(20) not null default '' COMMENT '收货人手机号',
`country` int(11) not null default 0 COMMENT '国家',
`province` int(11) not null default 0 COMMENT '省份',
`city` int(11) not null default 0 COMMENT '城市',
`district` int(11) not null default 0 COMMENT '地区',
`twon` int(11) not null default 0 COMMENT '乡镇',
`address` varchar(200) not null default '' COMMENT '详细地址',
`is_default` tinyint(1) not null default 0 COMMENT '是否为默认地址(1是,0否)',
`time` int(11) unsigned COMMENT '添加时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";


/*
--订单表 
*/
create table if not exists `yd_order`(
`order_id` int(11) unsigned not null auto_increment primary key,
`order_sn` char(25) not null default '' COMMENT '订单号 当前时间拼接上六位随机数(20位) 20170902110938666666',
`consignee_id` int(11) not null default 0 COMMENT '收货人id(代理商id)如果为0是普通用户购买',
`count_price` decimal(10,2) unsigned not null default 0 COMMENT '订单总价',
`order_status` tinyint(1) unsigned not null default 0 COMMENT '定单状态(0新订单,*级也确认) 需要多级确认',
`pay_way` tinyint(1) unsigned not null default 0 COMMENT '支付方式(1微信支付,2支付宝支付,3账户余额支付,4线下支付)',
`pay_status` tinyint(1) unsigned not null default 0 COMMENT '支付状态(0未支付,1已支付,2线下支付)',
`shipping_status` tinyint(1) unsigned not null default 0 COMMENT '发货状态(0为发货,1已发货)',
`buy` tinyint(1) unsigned not null default 0 COMMENT '订单类型(0预定，1购买)',
`username` char(20) not null default '' COMMENT '收货人姓名',
`mobile` char(20) not null default '' COMMENT '收货人手机号',
`address` varchar(255) not null default ''  COMMENT '收货地址(直接字符串)',
`time` int unsigned not null default 0 COMMENT '订单生成时间',
`updateitme` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)engine=innodb default charset="utf8";

/*
--订单详情表 订单商品表
*/
create table if not exists `yd_order_goods`(
`order_goods_id` int(11) unsigned not null auto_increment primary key,
`order_id` int(11) unsigned not null default 0 COMMENT '点单id',
`goods_id` int(11) unsigned not null default 0 COMMENT '商品id',
`agent_id` int(11) not null default 0 COMMENT '代理商id(属于此代理商的商品)0为总平台的商品',
`goods_price` decimal(10,2) unsigned not null default 0 COMMENT '商品单价(对应代理商的价格)',
`goods_num` int(5) unsigned not null default 0 COMMENT '商品数量',
`goods_name` varchar(255) not null default '' COMMENT '商品名称',
`goods_color` char(20) not null default '' COMMENT '商品颜色',
`time` int(11) unsigned COMMENT '添加时间'
)engine=innodb default charset="utf8";

/*
--订单操作日志
*/
create table if not exists `yd_order_log`(
`order_goods_id` int(11) unsigned not null auto_increment primary key,
`order_id` int(11) unsigned not null default 0 COMMENT '订单id',
`operation` int(11) unsigned not null default 0 COMMENT '操作者id',
`msg` varchar(255) not null default '' COMMENT '操作信息',
`time` int not null default 0 COMMENT '操作时间'
)engine=innodb default charset="utf8";






字段名	字段类型	默认值	描述
order_id	mediumint(8) unsigned		订单id
order_sn	varchar(20)		订单编号
user_id	mediumint(8) unsigned	0	用户id
order_status	tinyint(1) unsigned	0	订单状态
shipping_status	tinyint(1) unsigned	0	发货状态
pay_status	tinyint(1) unsigned	0	支付状态
consignee	varchar(60)		收货人
country	int(11) unsigned	0	国家
province	int(11) unsigned	0	省份
city	int(11) unsigned	0	城市
district	int(11) unsigned	0	县区
twon	int(11)	0	乡镇
address	varchar(255)		地址
zipcode	varchar(60)		邮政编码
mobile	varchar(60)		手机
email	varchar(60)		邮件
shipping_code	varchar(32)	0	物流code
shipping_name	varchar(120)		物流名称
pay_code	varchar(32)		支付code
pay_name	varchar(120)		支付方式名称
invoice_title	varchar(256)		发票抬头
goods_price	decimal(10,2)	0.00	商品总价
shipping_price	decimal(10,2)	0.00	邮费
user_money	decimal(10,2)	0.00	使用余额
coupon_price	decimal(10,2)	0.00	优惠券抵扣
integral	int(10) unsigned	0	使用积分
integral_money	decimal(10,2)	0.00	使用积分抵多少钱
order_amount	decimal(10,2)	0.00	应付款金额
total_amount	decimal(10,2)	0.00	订单总价
add_time	int(10) unsigned	0	下单时间
shipping_time	int(11)	0	最后新发货时间
confirm_time	int(10)	0	收货确认时间
pay_time	int(10) unsigned	0	支付时间
order_prom_id	smallint(6)	0	活动id
order_prom_amount	decimal(10,2)	0.00	活动优惠金额
discount	decimal(10,2)	0.00	价格调整
user_note	varchar(255)		用户备注
admin_note	varchar(255)		管理员备注
parent_sn	varchar(100)		父单单号
is_distribut	tinyint(1)	0	是否已分成0未分成1已分成
tp_order_action -- 订单备注表

字段名	字段类型	默认值	描述
action_id	mediumint(8) unsigned		表id
order_id	mediumint(8) unsigned	0	订单ID
action_user	int(11)	0	操作人 0 为管理员操作
order_status	tinyint(1) unsigned	0	订单状态
shipping_status	tinyint(1) unsigned	0	配送状态
pay_status	tinyint(1) unsigned	0	支付状态
action_note	varchar(255)		操作备注
log_time	int(11) unsigned	0	操作时间
status_desc	varchar(255)		状态描述
