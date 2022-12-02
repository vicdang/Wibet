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
                    "score": "-"
                },
                {
                    "name": "USA",
                    "id": "7",
                    "seed": 1,
                    "displaySeed": "usa",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "Argentina",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "argentina",
                    "score": "-"
                },
                {
                    "name": "Australia",
                    "id": "16",
                    "seed": 1,
                    "displaySeed": "australia",
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
                    "name": "Poland",
                    "id": "12",
                    "seed": 1,
                    "displaySeed": "poland",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "England",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "england",
                    "score": "-"
                },
                {
                    "name": "Senegal",
                    "id": "2",
                    "seed": 1,
                    "displaySeed": "senegal",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "Japan",
                    "id": "18",
                    "seed": 1,
                    "displaySeed": "japan",
                    "score": "-"
                },
                {
                    "name": "Croatia",
                    "id": "22",
                    "seed": 1,
                    "displaySeed": "croatia",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "11",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "12",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
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
                    "name": "_",
                    "id": "15",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "16",
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
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "3",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "7",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "11",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "13",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "15",
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
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "13",
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
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "9",
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
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "-",
                    "score": "-"
                },
            ]
        ]
    ];
</script>


