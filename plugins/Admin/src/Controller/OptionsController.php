<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Options Controller
 *
 * @property \Admin\Model\Table\OptionsTable $Options
 *
 * @method \Admin\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($type = null)
    {
        $data = $this->Options->getArrayData();
        if ($this->request->is('post')) {
            if ($this->Options->saveData($type, $this->request->getData())) {
                $this->jump(200, '保存成功!', '', false, '');
            }
        }
        $this->set(compact('type', 'data'));
    }
}
