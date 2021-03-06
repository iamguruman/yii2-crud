<?php

namespace app\modules\customer_review\controllers;

use Yii;
use app\modules\customer_review\models\MReview;
use app\modules\customer_review\models\MReviewSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for MReview model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }
   

     /**
     * Lists all  XXXX models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     /**
     * Displays a single XX model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model =  $this->findModel($id);
        
        $uploadSearchModel = new MSupplierrequestUploadSearch();
        $uploadDataProvider = $uploadSearchModel->search(Yii::$app->request->queryParams, [
            'object_id' => $model->id
        ]);
        $uploadDataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        return $this->render('view', [ 
            
            'uploadSearchModel' => $uploadSearchModel,
            'uploadDataProvider' => $uploadDataProvider,
           
            'model' => $model,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new MOnecdb();

        $model->created_at = aDateNow();
        $model->created_by = aUserMyId();
        
        $model->team_by = aTeamDefaultId();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                aReturnto();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_by = aUserMyId();
        $model->updated_at = aDateNow();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                aReturnto();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        return aControllerActionMarkdel($this, $model, $model->getUrlView(), $model->getUrlIndex());

        return $this->redirect(['index']);
    }

}
