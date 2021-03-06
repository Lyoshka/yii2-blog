<?php

namespace lyoshka\blog\models;

use Yii;
use yii\bootstrap\Html;

/**
 * This is the model class for table "{{%blog_post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $tags
 * @property string $image
 * @property integer $author_id
 * @property boolean $isfeatured
 * @property integer $status
 * @property string $time
 * @property integer $isdel
 *
 * @property BlogCatPos[] $blogCatPos
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
    public $dynTableName = '{{%blog_post}}';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $mod = new Post();
        return $mod->dynTableName;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content','status'], 'required'],
            [['content', 'image'], 'string'],
            [['author_id', 'status', 'isdel'], 'integer'],
            [['isfeatured'], 'boolean'],
            [['tags','time'], 'safe'],
            [['title'], 'string', 'max' => 65],
            [['description'], 'string', 'max' => 155],
            //[['tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'description' => Yii::t('blog', 'Description'),
            'content' => Yii::t('blog', 'Content'),
            'tags' => Yii::t('blog', 'Tags'),
            'image' => Yii::t('blog', 'Image'),
            'author_id' => Yii::t('blog', 'Author ID'),
            'isfeatured' => Yii::t('blog', 'isFeatured'),
            'status' => Yii::t('blog', 'Status'),
            'time' => Yii::t('blog', 'Time'),
            'isdel' => Yii::t('blog', 'Isdel'),
            'authorName' => Yii::t('blog', 'Author'),
            'categories' => Yii::t('blog', 'Categories'),
        ];
    }

    public function itemAlias($list,$item = false,$bykey = false)
    {
        $lists = [
            /* example list of item alias for a field with name field */
            'status'=>[
                0=>Yii::t('blog','Draft'),
                1=>Yii::t('blog','Published'),
                2=>Yii::t('blog','Archived'),
            ],
            'isfeatured'=>[
                false=>Yii::t('blog','No'),
                true=>Yii::t('blog','Featured'),
            ],

        ];

        if (isset($lists[$list]))
        {
            if ($bykey)
            {
                $nlist = [];
                foreach ($lists[$list] as $k=>$i)
                {
                    $nlist[$i] = $k;
                }
                $list = $nlist;
            }
            else
            {
                $list = $lists[$list];
            }

            if ($item !== false)
            {
                return  (isset($list[$item])?$list[$item]:false);
            }
            else
            {
                return $list;
            }
        }
        else
        {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCatPos()
    {
        return $this->hasMany(BlogCatPos::className(), ['post_id' => 'id'])->where("isdel=0");
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        $userClass = Yii::$app->getModule('blog')->userClass;
        return $this->hasOne($userClass::className(), ['id' => 'author_id']);
    }

    public function getTags()
    {
        $models = $this->find()->all();
        $tags = [];
        foreach ($models as $m)
        {
            $ts = explode(",",$m->tags);
            foreach ($ts as $t)
            {
                if (!in_array($t,$tags))
                {
                    $tags[$t] = $t;
                }
            }
        }
        return $tags;
    }

    public function getRecent($limit = 5)
    {
        $res = PostSearch::find()
            ->orderBy('id desc')
            ->where('status=:status AND isdel = :isdel',['status'=>1, ':isdel'=>0])
            ->limit($limit)
            ->all();
        return ($res === null ? null : $res);
    }

    public function getArchived($limit = 6)
    {
        $res =  $this->db->createCommand("SELECT 
                substring(concat('',time) from 1 for 7) as month
                FROM ".$this->tableName()." as p
                WHERE isdel = 0 
                AND  status = 1
                GROUP BY month              
                ORDER BY month desc
                LIMIT :limit")
            ->bindValues(["limit"=>$limit])->queryAll();

        return ($res === null ? null : $res);
    }

    public $categories;

    public static function substrText($text, $count_symbol)
    {
        $content = preg_replace("/<img[^>]+\>/i", " ", $text);

        //@todo временное удаление html тегов
        $content = strip_tags($content);
        $content = strip_tags($content,'<span>');

        if (strlen($content) > $count_symbol){
            return substr($content, 0, strpos($content,' ',$count_symbol)).'...';
        }else{
            return $content;
        }
    }

    public static function getStatusName($data)
    {
        $class = ($data->status == 0) ? 'warning' : ($data->status == 1) ? 'success' : 'default';
        return Html::tag('span', Html::encode($data->itemAlias('status',$data->status)), ['class' => 'label label-' . $class]);
    }


    public static function getRelatedCategories($model)
    {
        $arrayCategories = '';
        $count = count($model->blogCatPos);
        if($count == 0)
        {
            $arrayCategories = Yii::t('blog','Not found');
        }
        for ($i = count($model->blogCatPos) ; $i > 0; $i--)
        {
            $arrayCategories .= $model->blogCatPos[$i-1]->category->title.', ';
        }

        return $arrayCategories;

    }

}
