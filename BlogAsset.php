<?php

namespace lyoshka\blog;

use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $sourcePath = '@lyoshka/blog/assets';

    public $css = [
        'css/blog.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}