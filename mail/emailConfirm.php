<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/email-confirm', 'token' => $user->email_confirm_token]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <table style="border-collapse: collapse;border-spacing: 0;">
        <tr>
            <td style="vertical-align: top;text-align: -webkit-left;">
                <div style="max-width:600px;margin:0 auto;">
                    Hello, <?= Html::encode($user->username) ?>!<br /><br />

                    Thank you for signing up on CollegeStatistics.org In order to complete your registration, please click the link below.<br /><br />

                    <?= Html::a(Html::encode($confirmLink), $confirmLink) ?><br /><br />

                    If you cannot click the link, please try pasting the text into your browser.<br />

                    If you did not make this request you can ignore this email.
                </div>
            </td>
        </tr>
    </table>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
