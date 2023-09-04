<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        // Loads elements
        $this->Html->meta('icon', 'favicon.ico', ['block' => true]);
        $this->Html->css([
            'normalize.min',
            'milligram.min',
            'cake',
            'jquery-ui.min.css',
            'jquery-ui.structure.css',
            'jquery-ui.theme.css',
            'common.css',
            'mixins.css',
            'https://fonts.googleapis.com/css?family=Raleway:400,700',
            'spinner'
        ], ['block' => true]);
        $this->Html->script([
            'jquery-3.7.0.min.js',
            'jquery-ui.min.js',
        ], ['block' => true]);

        // Sets some variables
        $buttonClasses = "ui-button ui-widget ui-corner-all";

        $this->set(compact('buttonClasses'));
    }
}
