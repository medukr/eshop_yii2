<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\OrderItems;
use app\modules\admin\models\Product;
use Yii;
use app\modules\admin\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\controllers\AppAdminController;
use yii\filters\AccessControl;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AppAdminController
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
            'pagination' => [
                'pageSize' => 7,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
            }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);;
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelItems($id)
    {
        if (($modelItems = OrderItems::find()->where(['order_id' => $id])->all()) !== null) {
            return $modelItems;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionDeleteOrderItem()
    {
        $product_id = Yii::$app->request->get('id');
        $order_id = Yii::$app->request->get('order_id');

        $item = OrderItems::find()->where(['id' => $product_id, 'order_id' => $order_id])->one();
        $order = Order::findOne($order_id);

        $order->qty -= $item->qty_item;
        $order->sum -= $item->sum_item;

        $order->save();
        $item->delete();

        return $this->redirect('/admin/order/update?id=' . $order_id);
    }

    public function actionShowOrderItems($id)
    {
        $order = $this->findModel($id);
        $model = $this->findModelItems($id);

        if ($model) {
            $this->layout = false;
            return $this->render('orderItems', compact('model', 'order'));
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionQuantityItem($id, $orderId, $action)
    {
        $order = $this->findModel($orderId);
        $orderItem = OrderItems::findOne($id);

        if ($order){
            if ($orderItem) {
                if ($action == 'plus') {
                    $orderItem->qty_item += 1;
                    $order->qty += 1;

                    $order->sum -=  $orderItem->sum_item;
                    $orderItem->sum_item = $orderItem->qty_item * $orderItem->price;
                    $order->sum +=  $orderItem->sum_item;

                    $orderItem->save();
                } elseif ($action == 'minus') {
                    $orderItem->qty_item -= 1;
                    $order->qty -= 1;

                    $order->sum -=  $orderItem->sum_item;
                    $orderItem->sum_item = $orderItem->qty_item * $orderItem->price;
                    $order->sum +=  $orderItem->sum_item;

                    $orderItem->save();
                } elseif ($action == 'delete'){
                    $order->qty -= $orderItem->qty_item;
                    $order->sum -=  $orderItem->sum_item;

                    $orderItem->delete();
                    Yii::$app->session->setFlash('success', 'Товар удален.');

                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }
            $order->save();

            $this->layout = false;
            $model = $order->orderItems;
            return $this->render('orderItems', compact('model', 'order'));
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddOrderItem($id, $orderId){


        if ($product = Product::findOne($id)) {
            $orderItem = new OrderItems();
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $product->id;
            $orderItem->name = $product->name;
            $orderItem->price = $product->price;
            $orderItem->qty_item = 0;
            $orderItem->sum_item = 0;
            $orderItem->save();
            Yii::$app->session->setFlash('success', 'Товар добавлен.');
        } else {
            Yii::$app->session->setFlash('error', 'Товар не найден.');
        }

        $order = $this->findModel($orderId);
        $this->layout = false;
        $model = $order->orderItems;
        return $this->render('orderItems', compact('model', 'order'));
    }
}
