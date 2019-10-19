<?php
return [
    'view_replace_str' => [
        '__PUBLIC__'=>SITE_URL.'/public/static/admin',
        '__UPLOAD__'=>SITE_URL.'/public/static/uploads',
    ],

    $config =    [
    // 验证码字体大小
    'fontSize'    =>    15,    
    // 验证码位数
    'length'      =>    5,   
    // 关闭验证码杂点
    'useNoise'    =>    false, 
],
];
?>