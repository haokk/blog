<?php
namespace app\admin\controller;


class Article extends Base
{
    public function lst()
    {
        //通过左外链接获取栏目名称
    	$artres = \think\Db::name('article')->alias('a')->join('cate c','a.cateid=c.id','LEFT')->field('a.id,a.time,a.title,a.pic,a.click,c.catename')->order('id asc')->paginate(10);
    	$this->assign('artres',$artres);
        return  $this->fetch();
    }

    public function add()
    {
    	if (request()->isPost()) {
    		$data=[
    			'title' => input('title'),
    			'keywords' => input('keywords'),
    			'desc' => input('desc'),
    			'cateid' => input('cateid'),
    			'content'=> input('content'),
    			'time'=> time(),
    		];

    		if ($_FILES['pic']['tmp_name']){
    		    // 获取表单上传文件 例如上传了001.jpg
    		    $file = request()->file('pic');
    		    
    		    // 移动到框架应用根目录/public/uploads/ 目录下
    		    $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
    		    // var_dump($info); die;
    		    if($info){
    		    	//成功上传，获取上传信息
    		        $data['pic'] = 'static/uploads/'.date('Ymd').'/'.$info->getFilename();
    	
    		    }else{
    		        // 上传失败获取错误信息
    		        echo $file->getError();
    		    }
    		}

    		$validate = \think\Loader::validate('Article');
    		if ( $validate->check($data)){
	    		 $db = \think\Db::name('article')->insert($data);
		    		if ($db) {
		    			return $this->success('添加文章成功！','lst');
		    		}else{
		      			return $this->error('添加文章失败！');
		    		}
		    }else{
		    	return  $this->error($validate->getError());
		    }
    		return;
    	}
    	$cateres = db('cate')->select();
  		$this->assign('cateres',$cateres);
        return  $this->fetch();
    }

    public function edit()
    {
    	if (request()->isPost()) {
    		$data=[
    			'id' => input('id'),
    			'title' => input('title'),
    			'keywords' => input('keywords'),
    			'desc' => input('desc'),
    			'cateid' => input('cateid'),
    			'content'=> input('content'),
    			'click'=> input('click'),
    			// 'time'=> time(),
    		];

    		if ($_FILES['pic']['tmp_name']){
    		    // 获取表单上传文件 例如上传了001.jpg
    		    $file = request()->file('pic');
    		    
    		    // 移动到框架应用根目录/public/uploads/ 目录下
    		    $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
    		    // var_dump($info); die;
    		    if($info){
    		    	//成功上传，获取上传信息
    		        $data['pic'] = 'static/uploads/'.date('Ymd').'/'.$info->getFilename();
    	
    		    }else{
    		        // 上传失败获取错误信息
    		        echo $file->getError();
    		    }
    		}

    		$validate = \think\Loader::validate('article');
    		if ( $validate->check($data)){
	    		$db = \think\Db::name('article')->update($data);
		    		if ($db) {
		    			return $this->success('修改文章成功！','lst');
		    		}else{
		      			return $this->error('修改文章失败！');
		    		}
		    }else{
		    	return  $this->error($validate->getError());
		    }
    		return;
    	}
   
  		$arts = db('article')->where('id',input('id'))->find();
  		 // dump($arts);die;
    	$cateres = db('cate')->select();
    	// var_dump($cateres);die;
    	$this->assign('arts',$arts);
  		$this->assign('cateres',$cateres);
        return  $this->fetch();
    }

    public function del(){
  		$id = input('id');
  		if (db('article')->delete($id)) {
  			return $this->success('删除文章成功','lst');
  		}else{
  			return $this->error('删除文章失败');
  		}
  	}
}
