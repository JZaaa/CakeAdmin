<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * AuthRule Controller
 *
 * @property \Admin\Model\Table\AuthRulesTable $AuthRules
 *
 * @method \Admin\Model\Entity\AuthRule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthRulesController extends AppController
{

    /**
     * 权限首页
     */
   public function index()
   {
       $data = $this->AuthRules->find('threaded')->toArray();

       $this->set(compact('data'));
   }


    /**
     * 新增规则
     */
   public function add()
   {
       if ($this->request->is('post')) {

           $data = $this->AuthRules->newEntity();
           $data = $this->AuthRules->patchEntity($data, $this->request->getData());
           if ($this->AuthRules->save($data)) {
               $this->jump(200, '添加成功!', 'authrule', true);
           } else {
               $this->jump(300, '添加失败，请重新添加!', 'authrule', true);
           }
       }

       $parent_id = $this->request->getQuery('parent_id');

       $parents = $this->AuthRules->find('list', [
           'keyField' => 'id',
           'valueField' => 'title'
       ])
           ->where([
               'parent_id' => 0
           ])
           ->toArray();


       $this->set(compact('parent_id', 'parents'));



   }


    /**
     * 编辑
     * @param null $id
     */
   public function edit($id = null)
   {
       $data = $this->AuthRules->get($id);
       if ($this->request->is(['patch', 'post', 'put'])) {
           $requestData = $this->request->getData();
           $data = $this->AuthRules->patchEntity($data, $requestData);
           if ($this->AuthRules->save($data)) {
               $this->jump(200, '编辑成功!', 'authrule', true);
           } else {
               $this->jump(300, '编辑失败!', 'authrule', true);
           }
       }
       $parents = $this->AuthRules->find('list', [
           'keyField' => 'id',
           'valueField' => 'title'
       ])
           ->where([
               'parent_id' => 0,
               'id <>' => $id
           ])
           ->toArray();

       $this->set(compact('data', 'parents'));
   }


    /**
     * 删除
     * @param null $id
     */
   public function delete($id = null)
   {
       $this->request->allowMethod(['post', 'delete']);

       $user = $this->AuthRules->get($id);

       if ($this->AuthRules->delete($user)) {
           $this->jump(200, '删除成功!', 'authrule', false);
       } else {
           $this->jump(300, '删除失败,请重试!', 'authrule', false);
       }

   }



}
