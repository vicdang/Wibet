<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */
$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-comments">
    <h1><?= Html::encode($this->title) ?></h1>

    <div id="disqus_thread"></div> <script type="text/javascript">(function() { var d = document, s = d.createElement('script'); s.src = '//euro2021bet.disqus.com/embed.js'; s.setAttribute('data-timestamp', +new Date()); (d.head || d.body).appendChild(s); })(); </script> <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

</div>
