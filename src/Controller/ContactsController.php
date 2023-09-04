<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\XlsView;
use App\View\CsvView;
use App\View\TextView;
use Cake\Event\EventInterface;
use Cake\Http\Exception\NotAcceptableException;
use Cake\View\JsonView;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    /**
     * Accepted fromats for exports
     * 
     * @var array
     */
    protected $_acceptedFormats = [
        'text/plain' => 'txt',
        'text/csv' => 'csv',
        'application/vnd.ms-excel' => 'xls',
        '*/*' => 'txt'
    ];

    /**
     * ViewClasses for this controller
     */
    public function viewClasses(): array
    {
        return [JsonView::class, XlsView::class, CsvView::class, TextView::class];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Fetchs the Contact info
        $contacts = $this->paginate($this->Contacts);

        // Export Buttons
        $exportButtons = $this->_acceptedFormats;
        array_pop($exportButtons);

        $this->set(compact('contacts', 'exportButtons'));
        $this->viewBuilder()->setOption('serialize', ['contacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Export method, to download the data as a spreadsheet in various formats
     * 
     * @return \Cake\Http\Response|null|void Downloads the file
     */
    public function export()
    {
        $this->request->allowMethod(['get', 'post']);

        $contacts = $this->Contacts->find()->all()->toArray();

        // By default will send plain text response
        $clientFormats = array_intersect($this->request->accepts(), array_keys($this->_acceptedFormats));
        if (!empty($clientFormats)) {
            $this->viewBuilder()->disableAutoLayout();
            if (current($clientFormats) == '*/*') {
                $this->viewBuilder()->setClassName(TextView::class);
            }
            $format = $this->_acceptedFormats[current($clientFormats)];

            // Sets up the headers
            $fields = array_keys($contacts[0]->toArray());

            $this->set(compact('contacts'));

            
            // The view is returned as a file to download
            $dateString = date('y-m-d_H:i:s');
            $filename = "Contacts_{$dateString}.{$format}";
            $this->response = $this->response->withDownload($filename);
            
            $this->viewBuilder()->setOptions([
                'serialize' => 'contacts',
                'header' => $fields
            ]);
        } else {
            // In case no suitable format is found
            throw new NotAcceptableException(__('Formats specified are not supported'));
        }
    }

    /**
     * Called after the controller action is run, but before the view is rendered. You can use this method
     * to perform logic or set view variables that are required on every request.
     *
     * @param \Cake\Event\EventInterface $event An Event instance
     * @return \Cake\Http\Response|null|void
     * @link https://book.cakephp.org/4/en/controllers.html#request-life-cycle-callbacks
     */
    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        $builder = $this->viewBuilder();

        // Resets the viewClass for export requests
        if ($this->request->getParam('action') == 'export' && $this->request->is('ajax')) {
            // Overrides a behaviour of the RequestHandlerComponent
            $builder->setClassName(null);

            if ($builder->getTemplate() === null) {
                $builder->setTemplate($this->request->getParam('action'));
            }
        }
        
    }
}
