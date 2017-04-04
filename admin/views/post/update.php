<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model lyoshka\blog\models\Post */

$this->title = Yii::t('blog', 'Update Post: ').' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog'), 'url' => ['/admin/blog/default']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Posts'), 'url' => ['/admin/blog/post']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
