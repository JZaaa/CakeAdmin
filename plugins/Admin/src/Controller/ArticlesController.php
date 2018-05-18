<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Articles Controller
 *
 * @property \Admin\Model\Table\ArticlesTable $Articles
 *
 * @method \Admin\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{

    private $onePageTypeKey = 'page'; //单页面key
    private $listPageTypeKey = 'list'; //文章列表页面key
    private $picPageTypeKey = 'pic'; //图片页面列表key


    public $paginate = [
        'order' => [
            'Articles.isshow' => 'asc',
            'Articles.istop' => 'asc',
            'Articles.id' => 'desc'
        ]
    ];

    /**
     * 根据key值返回type_id
     * @param null|array|string $typeKey
     * @return array|string
     */
    protected function getPageTypeId($typeKey = null)
    {
        $type = getArtypeType(null, true);
        if ($typeKey === null) {
            return $type;
        }
        if (is_array($typeKey)) {
            $data = [];
            foreach ($typeKey as $key=>$item) {
                if (isset($type[$item]))
                    $data[] = $type[$item];
            }
            return $data;
        } else {
            return $type[$typeKey];
        }

    }


    /**
     * 单页面树
     */
    public function onePageMain()
    {
        $onePageTypeId = $this->getPageTypeId($this->onePageTypeKey);
        $data = TableRegistry::getTableLocator()->get('Admin.Arctypes')->findDataByType($onePageTypeId);
        $this->set(compact('data'));
    }

    /**
     * 文章页面树
     */
    public function listPageMain()
    {
        $listPageTypeId = $this->getPageTypeId([$this->listPageTypeKey, $this->picPageTypeKey]);
        $data = TableRegistry::getTableLocator()->get('Admin.Arctypes')->findDataByType($listPageTypeId);
        $this->set(compact('data'));
    }

    /**
     * 页面分配函数
     * @param null $arctype_id
     */
    public function manage($arctype_id = null, $type = null, $divid = null)
    {
        if (empty($arctype_id) || empty($type)) {
            $this->jump(300, '选中目标信息丢失，请重新尝试！', '');
        }
        $typeArray = $this->getPageTypeId();
        if ($type == $typeArray[$this->onePageTypeKey]) {
            return $this->redirect([
                'plugin' => 'Admin',
                'controller' => 'Articles',
                'action' => 'onePageManage',
                $arctype_id,
                $divid
            ]);
        } elseif ($type == $typeArray[$this->listPageTypeKey]) {
            return $this->redirect([
                'plugin' => 'Admin',
                'controller' => 'Articles',
                'action' => 'listPageManage',
                $arctype_id,
                $divid
            ]);
        } elseif ($type == $typeArray[$this->picPageTypeKey]) {
            return $this->redirect([
                'plugin' => 'Admin',
                'controller' => 'Articles',
                'action' => 'picPageManage',
                $arctype_id,
                $divid
            ]);
        }

        $this->jump(300, '未找到对应视图模板！', '');

    }



    /**
     * 单页面编辑
     * @param null $arctype_id
     */
    public function onePageManage($arctype_id = null, $divid = null)
    {
        $entity = TableRegistry::getTableLocator()->get('Admin.Arctypes');
        $arctype = $entity->find()
            ->where(['id' => $arctype_id])
            ->first();

        if (empty($arctype)) {
            $this->jump(300, '未找到该分类信息', '');
        }

        $data = $this->Articles->find()
            ->where([
                'Articles.arctype_id' => $arctype_id
            ])->first();

        if (empty($data)) {
            $data = [
                'id' => null
            ];
        }
        $rules = $entity->formatEnableColumns($arctype->enable_columns);

        $this->set(compact('arctype_id', 'data', 'rules', 'divid'));
    }

    /**
     * 文章 公共查询函数
     * @param $arctype_id
     * @param array $select
     * @param array $contain
     */
    private function getData($arctype_id, $select = [], $contain = [])
    {
        $this->setPage();
        $conditions = [];

        $conditions['Articles.arctype_id'] = $arctype_id;

        if (!empty($this->request->getData('title'))) {
            $queryField = $this->request->getData('title');
            $conditions['Articles.title like'] = '%' . $queryField . '%';
            $this->set('title', $queryField);
        }

        $query = $this->Articles->find()
            ->contain($contain)
            ->where($conditions)
            ->select($select);

        $data = $this->paginate($query);

        $this->set(compact('arctype_id', 'data'));


    }

    /**
     * 文章页面编辑
     * @param null $arctype_id
     */
    public function listPageManage($arctype_id = null, $divid = null)
    {
        $select = [
            'Articles.id', 'Articles.title', 'Articles.istop', 'Articles.isshow', 'Articles.pubdate', 'Articles.color'
        ];
        $this->getData($arctype_id, $select);

        $this->set(compact('divid'));
    }


    /**
     * 图片列表编辑
     */
    public function picPageManage($arctype_id = null, $divid = null)
    {
        $select = [
            'Articles.id', 'Articles.title', 'Articles.image', 'Articles.istop', 'Articles.isshow'
        ];
        $this->getData($arctype_id, $select);
        $this->set(compact('divid'));
    }


    /**
     * 添加
     * @param null $arctype_id
     * @param null $divid
     */
    public function add($arctype_id = null, $divid = null)
    {
        if ($this->request->is('post')) {
            $article = $this->Articles->newEntity();
            $saveData = $this->request->getData();
            //提取内容第一张图片为缩略图
            if ($this->request->getData('autoimage') == 1) {
                $saveData['image'] = $this->Articles->autoImage($this->request->getData('content'));
            }
            $saveData['user_id'] = $this->Auth->user('id');
            $article = $this->Articles->patchEntity($article, $saveData);
            if ($this->Articles->save($article)) {
                $this->jump(200, '添加成功!', '', true, '', $divid);
            } else {
                $this->jump(300, '添加失败!', '', true);
            }
        }


        $entity = TableRegistry::getTableLocator()->get('Admin.Arctypes');
        $arctype = $entity->find()
            ->where(['id' => $arctype_id])
            ->first();

        if (empty($arctype)) {
            $this->jump(300, '未找到该分类信息', '');
        }
        $rules = $entity->formatEnableColumns($arctype->enable_columns);


        $this->set(compact('arctype', 'rules', 'divid'));
    }


    /**
     * 编辑
     * @param null $id
     * @param null $divid
     */
    public function edit($id = null, $divid = null)
    {
        $data = $this->Articles->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $saveData = $this->request->getData();
            //提取内容第一张图片为缩略图
            if ($this->request->getData('autoimage') == 1) {
                $saveData['image'] = $this->Articles->autoImage($this->request->getData('content'));
            }
            $saveData = $this->Articles->changeData($saveData);
            $data = $this->Articles->patchEntity($data, $saveData);
            if ($this->Articles->save($data)) {
                $this->jump(200, '编辑成功!', '', true, '', $divid);
            } else {
                $this->jump(300, '编辑失败!', '', true);
            }
        }

        $entity = TableRegistry::getTableLocator()->get('Admin.Arctypes');
        $arctype = $entity->find()
            ->where(['id' => $data->arctype_id])
            ->first();

        if (empty($arctype)) {
            $this->jump(300, '未找到该分类信息', '');
        }
        $rules = $entity->formatEnableColumns($arctype->enable_columns);

        $this->set(compact('data', 'rules', 'arctype', 'divid'));

    }


    /**
     * 删除
     * @param null $id
     * @param null $divid
     */
    public function delete($id = null, $divid = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Articles->get($id);

        if ($this->Articles->delete($user)) {
            $this->jump(200, '删除成功!', '', true, '', $divid);
        } else {
            $this->jump(300, '删除失败!', '', true);
        }

    }
}
