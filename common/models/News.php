<?php

namespace common\models;


use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string $content Содержимое
 * @property string|null $image Картинка
 * @property string $published_at Дата публикации
 * @property string $created_at Дата создания
 * @property int $user_id
 *
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'user_id', 'published_at', 'content'], 'required'],
            [['content'], 'string'],
            [['published_at', 'created_at'], 'safe'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержимое',
            'image' => 'Картинка',
            'published_at' => 'Дата публикации',
            'created_at' => 'Дата создания',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }


    public function beforeSave($insert)
    {
        if ($image = UploadedFile::getInstance($this, 'image')) {
            $fileName = uniqid() . $image->baseName . '.' . $image->extension;
            $image->saveAs(Yii::$app->params['imagePath'] . $fileName);
            $this->image = $fileName;
        }
        $this->published_at = \DateTime::createFromFormat('d.m.Y H:i:s', $this->published_at)->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        if ($this->image) {
            unlink(Yii::$app->params['imagePath'] . $this->image);
        }
        return parent::beforeDelete();
    }


    public function getImageUrl() {
        if ($this->image) {
            return Yii::$app->params['imagesUrl'] . $this->image;
        }
    }


}
