<?php

namespace app\modules\vacancy\models;

use Yii;

/**
 * This is the model class for table "m_vacancy".
 *
 * @property int $id
 * @property string $created_at Добавлено когда
 * @property int $created_by Добавлено кем
 * @property string $updated_at Изменено когда
 * @property int $updated_by Изменено кем
 * @property string $markdel_at Удалено когда
 * @property int $markdel_by Удалено кем
 * @property string $name Наименование
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $markdelBy
 */
class MVacancy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_vacancy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'markdel_at'], 'safe'],
            [['created_by', 'updated_by', 'markdel_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['markdel_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['markdel_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Добавлено когда',
            'created_by' => 'Добавлено кем',
            'updated_at' => 'Изменено когда',
            'updated_by' => 'Изменено кем',
            'markdel_at' => 'Удалено когда',
            'markdel_by' => 'Удалено кем',
            'name' => 'Наименование',
        ];
    }
    
    public function getUrlView(){
        return ['/vancancy/default/view', 'id' => $this->id];
    }

    public function getUrlIndex(){
        return ['/vancancy/default/index'];
    }
    
    public function getUrlTo($target = null){
        return Html::a("Вакансия {$this->name}",
            $this->getUrlView(),
            ['target' => $target, 'data-pjax' => 0]);
    }

    public function getUrlToBlank(){
        return $this->getUrlTo('_blank');
    }
    
    public function getBreadcrumbs(){
        return [
            'label' => "Вакансия {$this->name}",
            'url' => $this->getUrlView()
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkdelBy()
    {
        return $this->hasOne(User::className(), ['id' => 'markdel_by']);
    }

    /**
     * {@inheritdoc}
     * @return MVacancyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MVacancyQuery(get_called_class());
    }
}
