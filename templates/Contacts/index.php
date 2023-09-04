<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contact> $contacts
 */

/*
 * Script and CSS for Datatables 
 */
$this->Html->css([
    'contacts',
    'select.jqueryui.min.css',
    'datatables.min.css',
    'dataTables.jqueryui.min.css',
    'responsive.jqueryui.min.css',
    // 'buttons.jqueryui.min.css'
], ['block' => true]);
$this->Html->script([
    'contactsIndex',
    'select.jqueryui.min.js',
    'datatables.min.js',
    'dataTables.jqueryui.min.js',
    'responsive.jqueryui.min.js',
    // 'buttons.jqueryui.min.js'
], ['block' => true]);
?>
<div class="contacts index content">
    <div class="export-button-container">
        <h3 class="table-header"><?= __('Contacts') ?></h3>
        <div class="export-button-wrapper">
            <?= $this->Html->link(__('New Contact'), ['action' => 'add'], ['class' => "button {$buttonClasses}"]) ?>
            <?php foreach ($exportButtons as $format => $button): ?>
                <button class="button <?= $buttonClasses ?>" data-format="<?= $format ?>"><?= __(sprintf('Export %s', $button)) ?></button>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="contacts-table" class="display nowrap compact">
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
                        <?php foreach (['view','edit'] as $button): ?>
                            <?= $this->Html->link(__(ucfirst($button)), ['action' => $button, $contact->id], ['class' => $buttonClasses]) ?>
                        <?php endforeach; ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id), 'class' => "button-action {$buttonClasses}"]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
