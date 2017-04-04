<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model lyoshka\blog\models\Post */

$this->title = Yii::t('blog', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog'), 'url' => ['/admin/blog/default']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Posts'), 'url' => ['/admin/blog/post']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
