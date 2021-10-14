<?php

namespace app\modules\jps\models;


class ModelSearch extends Model
{

    public $jpNameSearch;
    public $vcardNameSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'markdel_by', 'jp_id', 'vcard_id'], 'integer'],
            [['created_at', 'updated_at', 'markdel_at'], 'safe'],

            [['jpNameSearch'], 'string'],
            [['vcardNameSearch'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MJpsVcard::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'markdel_at' => $this->markdel_at,
            'markdel_by' => $this->markdel_by,
            'jp_id' => $this->jp_id,
            'vcard_id' => $this->vcard_id,
        ]);

        if(!empty($this->vcardNameSearch)){
            $query
                ->joinWith('vcard')
                ->andWhere(['or',
                    ['like', 'lastname', $this->vcardNameSearch],
                    ['like', 'firstname', $this->vcardNameSearch],
                    ['like', 'middlename', $this->vcardNameSearch],
                ]);
        }

        if(!empty($this->jpNameSearch)){
            $query
                ->joinWith('jp')
                ->andWhere(
                    ['like', 'name_short', $this->vcardNameSearch]
                );
        }

        return $dataProvider;
    }
}
