<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\FlightSegmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список командировок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-segment-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'serviceId',
            'corporateId',
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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
