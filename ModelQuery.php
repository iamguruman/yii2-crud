<?php

namespace app\modules\vacancy\models;

/**
 * This is the ActiveQuery class for [[MVacancy]].
 *
 * @see MVacancy
 */
class MVacancyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    
    public function init()
    {
        parent::init(); 
        
        $this->andWhere(['markdel_by' => null]);
    }

    /**
     * {@inheritdoc}
     * @return MVacancy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MVacancy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
