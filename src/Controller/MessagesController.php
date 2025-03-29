<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setClassName('Json');
        
        // 设置分页配置
        $this->paginate = [
            'limit' => 5,
            'maxLimit' => 100,
            'order' => ['Messages.created_at' => 'DESC']
        ];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Messages->find();
        $messages = $this->paginate($query);
        
        // 添加分页元数据到响应中
        $paging = $this->request->getAttribute('paging')['Messages'] ?? [];
        $pagination = [
            'page' => (int)($this->request->getQuery('page', 1)),
            'limit' => (int)($this->request->getQuery('limit', 5)),
            'pageCount' => $paging['pageCount'] ?? 0,
            'totalCount' => $paging['count'] ?? 0
        ];
        
        $this->set([
            'messages' => $messages,
            'pagination' => $pagination
        ]);
        $this->viewBuilder()->setOption('serialize', ['messages', 'pagination']);
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, contain: []);
        $this->set(compact('message'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['get','post']);
        $message = $this->Messages->newEmptyEntity();
        $message = $this->Messages->patchEntity($message, $this->request->getData());
        
        if ($this->Messages->save($message)) {
            $this->set([
                'message' => $message,
                'status' => 'success'
            ]);
        } else {
            $this->response = $this->response->withStatus(400);
            $this->set([
                'message' => $message->getErrors(),
                'status' => 'error'
            ]);
        }
        $this->viewBuilder()->setOption('serialize', ['message', 'status']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $this->set(compact('message'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
