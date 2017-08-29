<?php
return array(
	

   'LOAD_EXT_CONFIG' => 'dbconfig',    // 加载邮件配置文件
   'DEFAULT_MODULE'         =>      'Home', 
   'DEFAULT_CONTROLLER'     =>      'Index',
   'DEFAULT_ACTION'         =>      'index',                      // 默认操作名称
   'URL_MODEL'              =>      2,          		          //重写模式
   // 'SHOW_PAGE_TRACE'        =>      true,       		          //开启页面trace
   'URL_HTML_SUFFIX'        =>      'html',      		          //设置伪静态
   'TMPL_L_DELIM'    		=>      '{',
   'TMPL_R_DELIM'    		=>      '}',


    'TOKEN_ON'              =>      true,                          // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'            =>      '__hash__',                    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'            =>      'md5',                         //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'           =>      true,                          //令牌验证出错后是否重置令牌 默认为true

);