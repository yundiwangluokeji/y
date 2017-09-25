<?php

namespace Pay\Controller;
use Think\Controller;

class WeixinController extends Controller
{
    public function index()
    {
	dump(getenv('REMOTE_ADDR'));
        
    }
}
