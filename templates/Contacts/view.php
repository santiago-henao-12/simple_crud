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
            <?= $this->Html->link(__('Edit Contact'), ['action' => 'edit', $contact->id], ['class' => "side-nav-item {$buttonClasses}"]) ?>
            <?= $this->Form->postLink(__('Delete Contact'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id), 'class' => "side-nav-item {$buttonClasses}"]) ?>
            <?= $this->Html->link(__('List Contacts'), ['action' => 'index'], ['class' => "side-nav-item {$buttonClasses}"]) ?>
            <?= $this->Html->link(__('New Contact'), ['action' => 'add'], ['class' => "side-nav-item {$buttonClasses}"]) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contacts view content ui-widget-header">
            <h3><?= h($contact->name) ?></h3>
            <table class="ui-widget-content ui-corner-all">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($contact->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contact->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contact->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Age') ?></th>
                    <td><?= $this->Number->format($contact->age) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($contact->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
