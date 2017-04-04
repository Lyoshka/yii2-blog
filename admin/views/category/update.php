<?php



/* @var $this yii\web\View */
/* @var $model lyoshka\blog\models\Category */

$this->title = Yii::t('blog', 'Update Category:') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog'), 'url' => ['/admin/blog/default']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Categories'), 'url' => ['/admin/blog/category']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>