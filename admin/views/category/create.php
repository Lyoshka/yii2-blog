<?php

/* @var $this yii\web\View */
/* @var $model lyoshka\blog\models\Category */

$this->title = Yii::t('blog', 'Create category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog'), 'url' => ['/admin/blog/default']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Categories'), 'url' => ['/admin/blog/category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>