<?php

$this->title = $user->id == 0 ? Yii::t('user', 'New user') : Yii::t('user', 'Editing user');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=

$this->render('_form', [
    'user' => $user,
    'person' => $person,
    'return' => $return,
])
?>