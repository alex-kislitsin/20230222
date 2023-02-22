<?php

use app\models\FlightSegment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\FlightSegmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Flight Segments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-segment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Flight Segment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'flight_id',
            'num',
            'group',
            'departureTerminal',
            //'arrivalTerminal',
            //'flightNumber',
            //'departureDate',
            //'arrivalDate',
            //'stopNumber',
            //'flightTime:datetime',
            //'eTicket',
            //'bookingClass',
            //'bookingCode',
            //'baggageValue',
            //'baggageUnit',
            //'depAirportId',
            //'arrAirportId',
            //'opCompanyId',
            //'markCompanyId',
            //'aircraftId',
            //'depCityId',
            //'arrCityId',
            //'supplierRef',
            //'depTimestamp:datetime',
            //'arrTimestamp:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FlightSegment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
