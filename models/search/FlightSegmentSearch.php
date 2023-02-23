<?php

namespace app\models\search;

use app\models\AirportName;
use app\models\Trip;
use app\models\TripService;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FlightSegment;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * FlightSegmentSearch represents the model behind the search form of `app\models\FlightSegment`.
 */
class FlightSegmentSearch extends FlightSegment
{
    public $airName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'flight_id',
                    'num',
                    'group',
                    'stopNumber',
                    'flightTime',
                    'eTicket',
                    'baggageValue',
                    'depAirportId',
                    'arrAirportId',
                    'opCompanyId',
                    'markCompanyId',
                    'aircraftId',
                    'depCityId',
                    'arrCityId',
                    'depTimestamp',
                    'arrTimestamp',
                    'serviceId',
                    'corporateId',
                ],
                'integer',
            ],
            [
                [
                    'departureTerminal',
                    'arrivalTerminal',
                    'flightNumber',
                    'departureDate',
                    'arrivalDate',
                    'bookingClass',
                    'bookingCode',
                    'baggageUnit',
                    'supplierRef',
                    'airName',
                ],
                'safe',
            ],
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
        $query = FlightSegment::find()
            ->select([
                self::tableName() . '.*',
                TripService::tableName() . '.service_id serviceId',
                Trip::tableName() . '.corporate_id corporateId',
            ])
            ->innerJoinWith([
                'flight' => function (ActiveQuery $query) {
                    return $query->andFilterWhere(['service_id' => $this->serviceId])
                        ->innerJoinWith([
                            'trip' => function ($query) {
                                return $query->andFilterWhere(['corporate_id' => $this->corporateId]);
                            },
                        ]);
                },
            ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->airName) {
            $airPortIds = (new Query())->from(AirportName::tableName())
                ->select('airport_id')
                ->andWhere(['like', 'airport_name.value', $this->airName])
                ->column(AirportName::getDb());
            $query->andWhere(['depAirportId' => $airPortIds]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'flight_id' => $this->flight_id,
            'num' => $this->num,
            'group' => $this->group,
            'stopNumber' => $this->stopNumber,
            'flightTime' => $this->flightTime,
            'eTicket' => $this->eTicket,
            'baggageValue' => $this->baggageValue,
            'arrAirportId' => $this->arrAirportId,
            'opCompanyId' => $this->opCompanyId,
            'markCompanyId' => $this->markCompanyId,
            'aircraftId' => $this->aircraftId,
            'depCityId' => $this->depCityId,
            'arrCityId' => $this->arrCityId,
            'depTimestamp' => $this->depTimestamp,
            'arrTimestamp' => $this->arrTimestamp,
        ]);

        $query->andFilterWhere(['like', 'departureTerminal', $this->departureTerminal])
            ->andFilterWhere(['like', 'arrivalTerminal', $this->arrivalTerminal])
            ->andFilterWhere(['like', 'flightNumber', $this->flightNumber])
            ->andFilterWhere(['like', 'departureDate', $this->departureDate])
            ->andFilterWhere(['like', 'arrivalDate', $this->arrivalDate])
            ->andFilterWhere(['like', 'bookingClass', $this->bookingClass])
            ->andFilterWhere(['like', 'bookingCode', $this->bookingCode])
            ->andFilterWhere(['like', 'baggageUnit', $this->baggageUnit])
            ->andFilterWhere(['like', 'supplierRef', $this->supplierRef]);

        return $dataProvider;
    }
}
