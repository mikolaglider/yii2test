<?php

namespace app\controllers;

use Yii;
use app\models\NewClient;
use app\models\NewClientPhone;
use app\models\NewClientSearch;
use app\models\NewClientPhoneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\helpers\ArrayHelper;
use \yii\data\ArrayDataProvider;

/**
 * NewClientController implements the CRUD actions for NewClient model.
 */
class NewClientController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all NewClient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewClient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelsClientPhone' => new ArrayDataProvider([
                'allModels' => $this->findModel($id)->phones ])
        ]);
    }

    /**
     * Creates a new NewClient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewClient();
        $modelsClientPhone = [new NewClientPhone];

        if ($model->load(Yii::$app->request->post()) ) {

            $modelsClientPhone = Model::createMultiple(NewClientPhone::classname());
            Model::loadMultiple($modelsClientPhone, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsClientPhone) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsClientPhone as $modelClientPhone) {
                            $modelClientPhone->client_id = $model->id;
                            if (! ($flag = $modelClientPhone->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        // return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsClientPhone' => (empty($modelsClientPhone)) ? [new NewClientPhone] : $modelsClientPhone
            ]);
        }
    }

    /**
     * Updates an existing NewClient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsClientPhone = $model->phones;

        if ($model->load(Yii::$app->request->post()) ) {

            $oldIDs = ArrayHelper::map($modelsClientPhone, 'id', 'id');
            $modelsClientPhone = Model::createMultiple(NewClientPhone::classname(), $modelsClientPhone);
            Model::loadMultiple($modelsClientPhone, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsClientPhone, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsClientPhone) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            NewClientPhone::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsClientPhone as $modelClientPhone) {
                            $modelClientPhone->client_id = $model->id;
                            if (! ($flag = $modelClientPhone->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsClientPhone' => (empty($modelsClientPhone)) ? [new NewClientPhone] : $modelsClientPhone
            ]);
        }
    }

    /**
     * Deletes an existing NewClient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewClient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewClient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewClient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
