<?php
namespace app\admin\validate;
use think\Validate;

class Links extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:25|unique:links',
        'url' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '链接名称必须填写',
        'title.max' => '链接名称长度不得大于25位',
        'title.unique' => '链接名称不得重复',
        'url.require' => '链接地址必须填写',

    ];

    protected $scene = [
        'add'  =>  ['title'=>'require|unique:links','url'],
        'edit'  =>  ['title'=>'require|unique:links'],
    ];

}
