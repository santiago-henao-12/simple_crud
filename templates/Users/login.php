<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form content ui-widget-header">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login'), [
        'class' => $buttonClasses
    ]); ?>
    <?= $this->Form->end() ?>

</div>