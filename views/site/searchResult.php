<?php
use yii\helpers\Html;
$thetitle=Yii::t('app','Search Results');
$this->title = $thetitle.' | '.Yii::$app->name;
$this->params['breadcrumbs'][] = $thetitle;

function word_limiter($string, $number_of_words)
{
    $words = explode(' ', $string);
    $endPixels = count($words)>$number_of_words ? ' ..' : '';
    return trim(strip_tags(implode(' ', array_slice($words, 0, $number_of_words)).$endPixels));
}
?>
    <h1><?=$thetitle;?></h1>
    <style type="text/css">
        .founded{background-color: #ffff00;}
        .search-result{color: #444;
            margin-bottom: 24px;}
        .search-result .title a{font-size: 17px;}
    </style>
<?php
if($page)
    foreach($page as $result)
    {
        ?>
        <div class="search-result" >
            <div class="title"><?=Html::a($result['title'], ['/page/view','id'=>$result['id']]);?></div>
            <?php
            $text=word_limiter($result['content'],50);
            $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
            echo $text;?>
        </div>
    <?php
    }
    foreach($bill as $result)
    {
        ?>
        <div class="search-result" >
            <div class="title"><?=Html::a($result['title'], ['/bill/view','id'=>$result['id']]);?></div>
            <?php
            $text=word_limiter($result['content'],50);
            $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
            echo $text;?>
        </div>
    <?php
    }
    foreach($decree as $result)
    {
        ?>
        <div class="search-result" >
            <div class="title"><?=Html::a($result['title'], ['/decree/view','id'=>$result['id']]);?></div>
            <?php
            $text=word_limiter($result['content'],50);
            $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
            echo $text;?>
        </div>
    <?php
    }
    if($announcement){
        foreach($announcement as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/announce/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['description'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }
    if($legislation){
        foreach($legislation as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/legislation/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['description'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }

    if($deputy){
        foreach($deputy as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['fullname'], ['/deputy/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['description'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }

    if($feedback){
        foreach($feedback as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['text'], ['/feedback/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['answer'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }

    if($gallery){
        foreach($gallery as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/gallery/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['description'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }
    if($news){
        foreach($news as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/gallery/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['content'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }
    if($plan){
        foreach($plan as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/plan/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['content'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }
    if($results){
        foreach($results as $result)
        {
            ?>
            <div class="search-result" >
                <div class="title"><?=Html::a($result['title'], ['/results/view','id'=>$result['id']]);?></div>
                <?php
                $text=word_limiter($result['content'],50);
                $text=preg_replace("/{$_POST['search']}/i", "<span class='founded' >{$_POST['search']}</span>", $text);
                echo $text;?>
            </div>
        <?php
        }
    }

    if(!$page && !$announcement && !$bill && !$decree && !$deputy && !$feedback && !$gallery && !$legislation && !$news && !$plan && !$results)
        echo Yii::t('app','No results found');
?>