<?php

// 验证码配置
return [
    // 验证码的字符集
    'codeSet' => '23456789abcdefhijkmnpqrstuvwxyzABCDEFHJKMNPQRSTUVWXYZ',
    // 设置验证码字体大小
    'fontSize' => 18,
    // 添加混淆曲线
    'useCurve' => false,
    // 设置图片的高度、宽度
    'imageW' => 150,
    'imageH' => 35,
    // 验证码位数
    'length' =>4,
    // 验证成功后重置
    'reset' =>true
];