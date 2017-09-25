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

    'ERROR_PAGE'        =>        '/home-public-_empty.html',  //错误定向页面
    'TOKEN_ON'              =>      true,                          // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'            =>      '__hash__',                    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'            =>      'md5',                         //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'           =>      false,                          //令牌验证出错后是否重置令牌 默认为true
    'URL_PATHINFO_DEPR'     =>  '-',
    'color' => ['钢壳白面', '白壳黑面','介金白面','介金黑面','金壳白面','金壳金面','金壳黑面','玫瑰金壳白面','玫瑰金壳黑面','玫瑰金壳玫瑰金面','介玫瑰金壳白面','介玫瑰金壳黑面','介玫瑰金壳玫瑰金面'],
    'COURIER' => ['中通快递','圆通快递','申通快递','韵达快递','顺丰快递','天天快递'],
);