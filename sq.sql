--------------------------
-- 创建数据库
--------------------------
create database if not exists `y`;

--管理员表
create table if not exists `yd_admin`(
`admin_id` int(11) unsigned not null auto_increment primary key,
`username` char(30) not null default '' COMMENT '用户名',
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
`configkey` char(50) not null default '' COMMENT '配置key' ,
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
--代理商 商品表
*/
create table if not exists `yd_agent_goods`(
`id` int(11) unsigned not null auto_increment primary key,
`agent_goods_id` int(11) unsigned not null default 0 COMMENT '商品id',
`agent_price` decimal(10,2) unsigned not null default 0 COMMENT '商品价格',
`agent_color` char(20) not null default '' COMMENT '商品颜色多选(格式：红色,白色,黑色...)',
`agent_is_recommend` tinyint(1) unsigned not null default 0 COMMENT "是否推荐(1推荐,0否)",
`agent_is_shelves` tinyint(1) unsigned not null default 0 COMMENT "是否上架(1上架,0否)",
`agent_sales_sum` int(11) unsigned not null default 0 COMMENT '商品销量',
`agent_inventory` smallint(5) not null default 0 COMMENT '库存',
`agent_click_count` int(10) unsigned not null default 0 COMMENT '点击数',
`agent_sorting` int(11) unsigned not null default 0 COMMENT '排序',
`agent_addtime` int unsigned COMMENT '商品添加时间' 
)engine=innodb default charset="utf8";



















































-------------------------
--代理配置表
-------------------------
create table if not exists `yd_agent_config`(
`id` int unsigned not null auto_increment primary key,
`name` varchar(100) not null default '' COMMENT '代理商名称',
`logo` varchar(255) not null default '' COMMENT '代理商logo',
`mobile` int(11) not null default 0 COMMENT '代理商手机号',
`tel` char(20) not null default '' COMMENT '代理商电话',
`address` varchar(255)  not null default ''  COMMENT '代理商地址',
`weixin` varchar(255)  not null default ''  COMMENT '代理商微信二维码',
)engine=innodb default charset="utf8";


