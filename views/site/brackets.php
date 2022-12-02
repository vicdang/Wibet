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
                    "name": "_",
                    "id": "1",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "2",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "3",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "4",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "6",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "7",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "8",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "10",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "11",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "12",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "13",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "14",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "15",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "16",
                    "seed": 1,
                    "displaySeed": "",
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
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "3",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "7",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "11",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "13",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "15",
                    "seed": 1,
                    "displaySeed": "",
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
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "5",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
            ],
            [
              {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "13",
                    "seed": 1,
                    "displaySeed": "",
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
                    "displaySeed": "",
                    "score": "-"
                },
                {
                    "name": "_",
                    "id": "9",
                    "seed": 1,
                    "displaySeed": "",
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
                    "displaySeed": "",
                    "score": "-"
                },
            ]
        ]
    ];
</script>


