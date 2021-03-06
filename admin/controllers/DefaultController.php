<?php

namespace lyoshka\blog\admin\controllers;
use vova07\imperavi\actions\UploadAction;
use vova07\imperavi\actions\GetAction;
use yii\web\Controller;
use Yii;



/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actions()
    {
        $module = Yii::$app->getModule('blog');
        $url = Yii::getAlias($module->uploadURL);
        $path = Yii::getAlias($module->uploadDir);

        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $url.'/images', // Directory URL address, where files are stored.
                'path' => $path.'/images' // Or absolute path to directory where files are stored.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $url.'/images', // Directory URL address, where files are stored.
                'path' => $path.'/images', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_IMAGES,
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $url.'/files', // Directory URL address, where files are stored.
                'path' => $path.'/files' // Or absolute path to directory where files are stored.
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $url.'/files', // Directory URL address, where files are stored.
                'path' => $path.'/files', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_FILES,
            ],

        ];
    }

}
