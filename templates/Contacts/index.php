<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contact> $contacts
 */

/*
 * Script and CSS for Datatables 
 */
$this->Html->css('https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css', ['block' => true]);
$this->Html->css('contacts', ['block' => true]);
$this->Html->script('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js', ['block' => true]);
$this->Html->script('contactsIndex', ['block' => true]);
?>
<div class="contacts index content">
    <div class="contacts-button-wrapper">
        <?= $this->Html->link(__('New Contact'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <?= $this->Html->link(__('Download'), ['action' => 'export'], ['class' => 'button float-right']) ?>
        <button class="button float-right" data-format="application/vnd.ms-excel"><?= __('Export XLS') ?></button>
        <button class="button float-right" data-format="text/csv"><?= __('Export CSV') ?></button>
    </div>
    <h3><?= __('Contacts') ?></h3>
    <div class="table-responsive">
        <table id="contacts-table">
            <thead>
                <tr>
                    <th><?= ucfirst(h('id')) ?></th>
                    <th><?= ucfirst(h('name')) ?></th>
                    <th><?= ucfirst(h('email')) ?></th>
                    <th><?= ucfirst(h('age')) ?></th>
                    <th><?= ucfirst(h('modified')) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= h($contact->id) ?></td>
                    <td><?= h($contact->name) ?></td>
                    <td><?= h($contact->email) ?></td>
                    <td><?= $this->Number->format($contact->age) ?></td>
                    <td><?= h($contact->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id], ['class' => 'button-action']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'button-action']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id), 'class' => 'button-action']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
