<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller {

	/** 创建一个验证码并存入SESSION中 */
	public function create() {
		$code = $this->getCode(4,60,20); 
		$_SESSION["captcha_code"] = $code;
	}

	/**
	 * 获取一个验证码
	 * @param  Integer $num  字符数量
	 * @param  Integer $w   宽度
	 * @param  Integer $h   高度
	 * @return String       验证码
	 */
	public function getCode_usered ($num,$w,$h) { 
		    $code = ""; 
		    for ($i = 0; $i < $num; $i++) { 
		        $code .= rand(0, 9); 
		    } 
		    //4位验证码也可以用rand(1000,9999)直接生成 
		    //将生成的验证码写入session，备验证时用 
		    
		    //创建图片，定义颜色值 
		   
		    $im = imagecreate($w, $h); 
		    $black = imagecolorallocate($im, 0, 0, 0); 
		    $gray = imagecolorallocate($im, 230, 230, 230); 
		    $bgcolor = imagecolorallocate($im, 255, 255, 255); 
		    //填充背景 
		    imagefill($im, 0, 0, $gray); 
		 
		    //画边框 
		    imagerectangle($im, 0, 0, $w-1, $h-1, $black); 
		 
		    //随机绘制两条虚线，起干扰作用 
		    $style = array ($black,$black,$black,$black,$black, 
		        $gray,$gray,$gray,$gray,$gray 
		    ); 
		    imagesetstyle($im, $style); 
		    $y1 = rand(0, $h); 
		    $y2 = rand(0, $h); 
		    $y3 = rand(0, $h); 
		    $y4 = rand(0, $h); 
		    imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED); 
		    imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED); 
		 
		    //在画布上随机生成大量黑点，起干扰作用; 
		    for ($i = 0; $i < 80; $i++) { 
		        imagesetpixel($im, rand(0, $w), rand(0, $h), $black); 
		    } 
		    //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成 
		    $strx = rand(3, 8); 
		    for ($i = 0; $i < $num; $i++) { 
		        $strpos = rand(1, 6); 
		        imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black); 
		        $strx += rand(8, 12); 
		    } 

		    header("Content-type: image/png"); 
		    imagepng($im);//输出图片 
		    imagedestroy($im);//释放图片所占内存 

		    return $code;
		}

		/**
		 * 获取验证码
		 */
		public function getCode () {
			$config = array('length'=>4,'fontSize'=>20);
			$this->load->library('Verify', $config);
			$Verify = new Verify($config);
			$Verify->entry();
		}
	}