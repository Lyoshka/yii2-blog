<?php

/* @var $this yii\web\View */
/* @var $searchModel lyoshka\blog\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Blog');
$this->params['breadcrumbs'][] = $this->title;

$count_cat = \lyoshka\blog\models\Category::find()->where('isDel != :isDel', [':isDel'=>1])->count();
$count_post = \lyoshka\blog\models\Post::find()->where('isDel != :isDel', [':isDel'=>1])->count();
?>
<div class="default-index">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=$count_cat?></h3>
                    <p><?=Yii::t('blog','Categories')?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-th-list"></i>
                </div>
                <a href="/blog/admin/category" class="small-box-footer">
                    <?=Yii::t('blog','View')?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=$count_post?></h3>
                    <p><?=Yii::t('blog','Posts')?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt"></i>
                </div>
                <a href="/blog/admin/post" class="small-box-footer">
                    <?=Yii::t('blog','View')?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- /.col -->
    </div>
</div>
