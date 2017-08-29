--------------------------
-- 创建数据库
--------------------------
create database if not exists `y`;

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
`configaddtime` int unsigned COMMENT '添加配置时间'
)engine=innodb default charset="utf8";
insert into yd_config(configname,configkey,configval,configaddtime) values('网站标题','title','某某钟表有限公司',unix_timestamp(now()));


/*
--品牌表
*/
create table if not exists `yd_brand`(
`brand_id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default ''  COMMENT '品牌名称',
`logo` varchar(255) not null default '' COMMENT '品牌logo',
`sorting` int(11) unsigned not null default 0 COMMENT '排序',
`addtime` int unsigned COMMENT '添加时间'
)engine=innodb default charset="utf8";



/*
--商品分类表
*/
create table if not exists `yd_classification`(
`brand_id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default ''  COMMENT '分类名称',
`sorting` int(11) unsigned not null default 0 COMMENT '排序',
`addtime` int unsigned COMMENT '添加时间'
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
`addtime` int unsigned COMMENT '商品添加时间' 
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
`goods_permissions` tinyint(1) unsigned not null default 0 COMMENT '商品浏览权限(0不公开,1对登录用户公开,2代理商可以在后台分享一个二维码普通用户扫描二维码查看此商品--30分钟内有效)',
`agent_addtime` int unsigned COMMENT '商品添加时间' 
)engine=innodb default charset="utf8";



/*
--代理配置表
*/
create table if not exists `yd_agent_config`(
`id` int unsigned not null auto_increment primary key,
`name` varchar(100) not null default '' COMMENT '代理商名称',
`logo` varchar(255) not null default '' COMMENT '代理商logo',
`mobile` int(11) not null default 0 COMMENT '手机号',
`tel` char(20) not null default '' COMMENT '电话',
`address` varchar(255)  not null default ''  COMMENT '地址',
`weixin` varchar(255)  not null default ''  COMMENT '代理商微信二维码',
`addtime` int COMMENT '创建时间'
)engine=innodb default charset="utf8";


/*
--代理商表
*/
create table if not exists `yd_agent`(
`id` int(11) unsigned not null auto_increment primary key,
`username` char(30) unique not null default '' COMMENT '用户名',
`password` varchar(255) not null default '' COMMENT	'密码',
`secret` varchar(64) not null default '' COMMENT '密钥(Xcrypt中的VI)',
`mobile` int(11) not null default 0 COMMENT '代理商手机号',
`level` tinyint(1) unsigned not null default 0 COMMENT '代理商级别1,2,3',
`father` int(11) unsigned not null default 0 COMMENT '父id',
`path` varchar(255) not null default '' COMMENT '代理商关系路径(0_1_5_66)',
`status` tinyint(1) unsigned not null default 0 COMMENT '用户状态(0禁用,1正常)',
`addtime` int COMMENT '创建时间'
)engine=innodb default charset="utf8";

/*
--代理商钱包 money
*/
create table if not exists `yd_money`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_id` int(11) not null default 0 COMMENT '代理商id',
`money` varchar(255) not null default '0' COMMENT '货币(分为单位)'
)engine=innodb default charset="utf8";

/*
--货币操作记录表
*/
create table if not exists `yd_money_log`(
`id` int(11) unsigned not null auto_increment primary key,
`operation` int(11) not null default 0 COMMENT '操作者id(代理商id)',
`agent_id` int(11) not null default 0 COMMENT '被作者id(代理商id)',
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
--代理商登录日志表
*/
create table if not exists `yd_agent`(
`id` int(11) unsigned not null auto_increment primary key,
`name` char(30) not null default '' COMMENT '登录名称',
`pass` varchar(255) not null default '' COMMENT	'登录密码',
`ip` char(30) not null default '' COMMENT '登录ip',
`address` varchar(255) not null default '' COMMENT '登录地址',
`res` tinyint(1) not null default 0 COMMENT '登录结果(1成功,0否)',
`msg` char(50) not null default '' COMMENT '登录信息',
`time` int(11) unsigned COMMENT '登录时间'
)engine=innodb default charset="utf8";




