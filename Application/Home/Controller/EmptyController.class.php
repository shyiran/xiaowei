<?php
/*--------------------------------------------------------------------
 小微OA系统 - 让工作更轻松快乐

 Copyright (c) 2013 http://www.smeoa.com All rights reserved.

 Author:  jinzhu.yin<smeoa@qq.com>

 Support: https://git.oschina.net/smeoa/xiaowei
--------------------------------------------------------------*/

namespace Home\Controller;
use Think\Controller;

class EmptyController extends Controller {
	protected $config = array('app_type' => 'public');
	//过滤查询字段
	public function index() {
		$this->display();

	}
}
?>