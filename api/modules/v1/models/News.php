<?php

namespace api\modules\v1\models;


use Yii;


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

    public function fields()
    {
        return [
            'id',
            'title',
            'content',
            'published_at',
            'user' => function () {
                return $this->user->username;
            },

        ];
    }

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




}
