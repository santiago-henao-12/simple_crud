<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav ui-widget-header ui-corner-all">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contacts'), ['action' => 'index'], ['class' => "side-nav-item {$buttonClasses}"]) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contacts form content ui-widget-header">
            <?= $this->Form->create($contact) ?>
            <fieldset>
                <legend><?= __('Add Contact') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('age');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),
            [
                'class' => $buttonClasses
            ]) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
