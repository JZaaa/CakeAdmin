<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Arctypes Model
 *
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\BelongsTo $ParentArctypes
 * @property \Admin\Model\Table\AdArticlesTable|\Cake\ORM\Association\HasMany $AdArticles
 * @property \Admin\Model\Table\AdPagetypesTable|\Cake\ORM\Association\HasMany $AdPagetypes
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\HasMany $ChildArctypes
 *
 * @method \Admin\Model\Entity\Arctype get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Arctype newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Arctype[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Arctype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype findOrCreate($search, callable $callback = null, $options = [])
 */
class ArctypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ad_arctypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentArctypes', [
            'className' => 'Admin.Arctypes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'arctype_id',
            'className' => 'Admin.AdArticles'
        ]);
        $this->hasMany('ChildArctypes', [
            'className' => 'Admin.Arctypes',
            'foreignKey' => 'parent_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmpty('name');

        $validator
            ->allowEmpty('level');

        $validator
            ->integer('sort')
            ->allowEmpty('sort');

        $validator
            ->allowEmpty('type');

        $validator
            ->scalar('image')
            ->maxLength('image', 50)
            ->allowEmpty('image');

        $validator
            ->allowEmpty('isshow');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 255)
            ->allowEmpty('keywords')
            ->add('keywords', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->scalar('href')
            ->maxLength('href', 255)
            ->allowEmpty('href');

        $validator
            ->scalar('enable_columns')
            ->allowEmpty('enable_columns');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['keywords']));

        return $rules;
    }


    /**
     * 栏目类型
     * @deprecated 用getArtypeType()全局函数代替
     * */
    public function typeData() {
        return getArtypeType();
    }

    /*
     * 栏目状态
     *
     * */
    public function stateData()
    {
        return $data = array(
            '1' => '显示',
            '2' => '隐藏'
        );
    }

    /*
     * 颜色
     *
     * */
    public function colorData()
    {
        return $data = array(
            '1' => 'success',
            '2' => 'default'
        );
    }

    /*
     * 获取所有栏目
     * @param $parent_id    父栏目id
     * @param $not_id       不包含的id及该id下的子栏目
     * @param $type       祖先类类型约束
     *
     * */
    public function findAllData($parent_id = 0, $not_id = null, $type = null)
    {
        global $tmp;    //设置全局变量，防止循环查找子栏目时，$tmp 置空
        if (!empty($not_id)) {
            $conditions['Arctypes.id != '] = $not_id;
        }

        if (!empty($type)) {
            if (is_array($type)) {
                $conditions['Arctypes.type in'] = $type;
            } else {
                $conditions['Arctypes.type'] = $type;
            }
        }

        $conditions['Arctypes.parent_id'] = $parent_id;
        $data = $this->findData($conditions);

        if (!empty($data)) {
            foreach($data as $item) {
                //判断是否有子栏目
                $childConditions['Arctypes.parent_id'] = $item->id;
                $childCount = $this->childCount($childConditions);
                $item->leaf = $childCount>0 ? 1:0;
                $tmp[$item->id] = $item;
                $this->findAllData($item->id, $not_id);  //循环查找子栏目
            }
        }
        return $tmp;
    }

    /**
     * 通过祖先类类型约束获取数据
     * @param array|string $type 类型约束
     * @return array
     */
    public function findDataByType($type = [])
    {
        $conditions['Arctypes.parent_id'] = 0;
        if (!empty($type)) {
            if (is_array($type)) {
                $conditions['Arctypes.type in'] = $type;
            } else {
                $conditions['Arctypes.type'] = $type;
            }
        }

        $select = ['id', 'name', 'parent_id', 'sort', 'href', 'type'];

        $data = $this->find()
            ->select($select)
            ->where($conditions)
            ->all()->toArray();

        $parent_ids = [];

        foreach ($data as $item) {
            $parent_ids[] = $item['id'];
        }
        if (!empty($parent_ids)) {
            $child = $this->find()
                ->select($select)
                ->where([
                    'Arctypes.parent_id in' => $parent_ids
                ])
                ->all()->toArray();
            $data = array_merge($data, $child);
        }

        return $data;

    }
    /*
     * 获取栏目数据
     *
     * */
    public function findData($conditions = array()) {
        $query = $this->find('all')
            ->where($conditions)
            ->order(['level' => 'asc', 'sort' => 'desc', 'id' => 'desc']);
        return $query;
    }

    /*
     * 获取子栏目个数
     *
     * */
    public function childCount($conditions = array()) {
        $query = $this->find('all', [
            'conditions' => $conditions
        ]);
        $total = $query->count();
        return $total;
    }

    /*
     * 判断是否存在子栏目
     *
     * */
    public function haveChild($conditions = array()) {
        $query = $this->find('all', [
            'conditions' => $conditions
        ]);
        $total = $query->count();
        $result = ($total>0) ? true : false;
        return $result;
    }

    /*
     * 数据转换
     *
     * */
    public function changeData($data = array())
    {
        $data['sort'] = !empty($data['sort']) ? $data['sort'] : 0;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : 0;
        $data['level'] = empty($data['parent_level']) ? 1 : $data['parent_level'] + 1;
        $data['enable_columns'] = !empty($data['columns']) ? json_encode($data['columns']) : json_encode([]);
        return $data;
    }

    /*
     * 获取所有栏目  一维数组返回
     *
     * */
    public function getAllArr() {
        $data = $this->findData();
        $tmp = array();
        foreach ($data as $item) {
            $tmp[$item->id] = $item->name;
        }
        return $tmp;
    }

    /*
     * 获取所有栏目   ID
     *
     * */
    public function findAllId($parent_id = null) {
        global $tmpId;    //设置全局变量，防止循环查找子栏目时，$tmpId 置空
        $parent_id = empty($parent_id) ? 0:$parent_id;
        $conditions['Arctypes.parent_id'] = $parent_id;
        $data = $this->findData($conditions);
        $tmpId[] = $parent_id;
        if(!empty($data)) {
            foreach($data as $item) {
                $tmpId[] = $item->id;
                $this->findAllId($item->id);  //循环查找子栏目
            }
        }
        return $tmpId;
    }


    /**
     * 返回规则
     * @return array
     */
    public function selectColumns()
    {
        $data = [
            [
                'label' => '短标题',
                'column' => 'shorttitle',
                'default' => false
            ],
            [
                'label' => '颜色',
                'column' => 'color',
                'default' => false
            ],
            [
                'label' => '描述',
                'column' => 'description',
                'default' => false
            ],
            [
                'label' => '关键字',
                'column' => 'keywords',
                'default' => false
            ],
            [
                'label' => '内容',
                'column' => 'content',
                'default' => true
            ],
            [
                'label' => '图片',
                'column' => 'image',
                'default' => true
            ],
            [
                'label' => '置顶',
                'column' => 'istop',
                'default' => false
            ],
            [
                'label' => '链接',
                'column' => 'url',
                'default' => false
            ]
        ];

        return $data;
    }

    /**
     * 格式化规则字段，所有规则比对，存在则返回true,不存在则返回false
     * @param string|array $enabelColumns  规则键值对, column => 1
     * @param bool $json  $enableColumns 是否为 json 数据
     * @return array
     */
    public function formatEnableColumns($enabelColumns, $json = true)
    {
        $data = [];

        $columns = $this->selectColumns();

        if ($json) {
            $enabelColumns = json_decode($enabelColumns, true);
        }

        foreach ($columns as $item) {
            if (isset($enabelColumns[$item['column']]) && $enabelColumns[$item['column']] == 1) {
                $data[$item['column']] = true;
            } else {
                $data[$item['column']] = false;
            }
        }

        return $data;
    }


    /**
     * 获取栏目关键字，修改原关键字请确保ArticlesTable 内文章具体分类不受影响
     * @param null $key
     * @return array|mixed
     */
//    public function getKey($key = null)
//    {
//        $data = [
//            'index' => '首页内容',
//            'about' => '关于我们',
//        ];
//
//        return !empty($key) ? $data[$key] : $data;
//
//    }

}
