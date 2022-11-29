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
<div class="row">
  <div id="minimal">
      <div class="demo"></div>
  </div>
</div>
<script  type="text/javascript" src="/js/jquery.bracket.min.js" 0="yii\web\JqueryAsset">
    
var minimalData = {
    teams : [
      ["Team 1", "Team 2"], /* first matchup */
      ["Team 3", "Team 4"]  /* second matchup */
    ],
    results : [
      [[1,2], [3,4]],       /* first round */
      [[4,6], [2,1]]        /* second round */
    ]
  }
 
$(function() {
    $('#minimal .demo').bracket({
      init: minimalData /* data to initialize the bracket with */ })
  })
</script>


