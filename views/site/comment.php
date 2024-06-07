<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="wrapper text-center">
       <div class="row comment-layout">
        <div class="img-contain">
            <!-- <div class="image-cropper large"><img class="profile-pic plarge" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Skype_logo_%282019%E2%80%93present%29.svg/991px-Skype_logo_%282019%E2%80%93present%29.svg.png" alt=""></div> -->
            <!-- <div class="image-cropper large img-left"><img class="profile-pic plarge" alt="comments image" src="../images/cup.png"></div> -->
            <a target="_blank" href="https://join.skype.com/tMRrQSXDthKA">
                <div class="image-cropper large">
                    <img class="profile-pic plarge" src="/images/cup.jpg" alt="" style="margin-left: 0%;">
                </div>
            </a>
                </div>
        </div>
       <h1><a target="_blank" href="https://join.skype.com/r5ddrcLvMl8U">JOIN GROUP</a></h1>
    </div>
</div>
<div class="site-comments">
    <h1><?= Html::encode($this->title) ?></h1>
    <div id="disqus_thread"></div> <script type="text/javascript">
    (function() { var d = document, s = d.createElement('script'); s.src = '//euro2016bet.disqus.com/embed.js'; s.setAttribute('data-timestamp', +new Date()); (d.head || d.body).appendChild(s); })(); </script> <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.
    </a></noscript>
</div>
