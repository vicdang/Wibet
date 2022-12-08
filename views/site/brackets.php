<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;
use dosamigos\chartjs\ChartJs;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */

$this->title = 'Brackets';
?>
<link href="/css/jquery.bracket.min.css" rel="stylesheet">
<div class="row col-lg-12">
  <div id="minimal">
      <div class="tournament"></div>
  </div>
</div>
<script>
matchData = [
        [
          [
              {
                    "name": "Netherlands",
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "netherlands",
                    "score": "3"
                },
                {
                    "name": "USA",
                    "id": "7",
                    "seed": 1,
                    "displaySeed": "usa",
                    "score": "1"
                },
            ],
            [
              {
                    "name": "Argentina",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "argentina",
                    "score": "2"
                },
                {
                    "name": "Australia",
                    "id": "16",
                    "seed": 1,
                    "displaySeed": "australia",
                    "score": "1"
                },
            ],
            [
              {
                    "name": "France",
                    "id": "15",
                    "seed": 1,
                    "displaySeed": "france",
                    "score": "3"
                },
                {
                    "name": "Poland",
                    "id": "12",
                    "seed": 1,
                    "displaySeed": "poland",
                    "score": "1"
                },
            ],
            [
              {
                    "name": "England",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "england",
                    "score": "3"
                },
                {
                    "name": "Senegal",
                    "id": "2",
                    "seed": 1,
                    "displaySeed": "senegal",
                    "score": "0"
                },
            ],
            [
              {
                    "name": "Japan",
                    "id": "18",
                    "seed": 1,
                    "displaySeed": "japan",
                    "score": "1"
                },
                {
                    "name": "Croatia",
                    "id": "22",
                    "seed": 1,
                    "displaySeed": "croatia",
                    "score": "1"
                },
            ],
            [
                {
                    "name": "Brazil",
                    "id": "27",
                    "seed": 1,
                    "displaySeed": "brazil",
                    "score": "4"
                },
                {
                    "name": "South Korea",
                    "id": "32",
                    "seed": 1,
                    "displaySeed": "south-korea",
                    "score": "1"
                },
            ],
            [
              {
                    "name": "Morocco",
                    "id": "21",
                    "seed": 1,
                    "displaySeed": "morocco",
                    "score": "-"
                },
                {
                    "name": "Spain",
                    "id": "19",
                    "seed": 1,
                    "displaySeed": "spain",
                    "score": "-"
                },
            ],
            [
                {
                    "name": "Portugal",
                    "id": "29",
                    "seed": 1,
                    "displaySeed": "portugal",
                    "score": "-"
                },
                {
                    "name": "Switzerland",
                    "id": "25",
                    "seed": 1,
                    "displaySeed": "switzerland",
                    "score": "-"
                },
            ]
        ],
        [
            [
                {
                    "name": "Netherlands",
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "netherlands",
                    "score": "-"
                },
                {
                    "name": "Argentina",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "argentina",
                    "score": "-"
                },
            ],
            [
                {
                    "name": "France",
                    "id": "15",
                    "seed": 1,
                    "displaySeed": "france",
                    "score": "-"
                },
                {
                    "name": "England",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "england",
                    "score": "-"
                },
            ],
            [
                {
                    "name": "Croatia",
                    "id": "22",
                    "seed": 1,
                    "displaySeed": "croatia",
                    "score": "-"
                },
                {
                    "name": "Brazil",
                    "id": "27",
                    "seed": 1,
                    "displaySeed": "brazil",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ]
        ],
        [
          [
              {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ]
        ],
        [
          [
              {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ]
        ],
        [
          [
              {
                    "name": "_",
                    "id": "-",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ]
        ]
    ];
</script>


