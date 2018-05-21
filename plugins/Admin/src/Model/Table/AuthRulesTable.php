<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuthRules Model
 *
 * @property \Admin\Model\Table\AuthRulesTable|\Cake\ORM\Association\BelongsTo $ParentAuthRule
 * @property \Admin\Model\Table\AuthRulesTable|\Cake\ORM\Association\HasMany $ChildAuthRule
 *
 * @method \Admin\Model\Entity\AuthRule get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\AuthRule newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\AuthRule[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\AuthRule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\AuthRule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\AuthRule[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\AuthRule findOrCreate($search, callable $callback = null, $options = [])
 */
class AuthRulesTable extends Table
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

        $this->setTable('ad_auth_rules');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentAuthRules', [
            'className' => 'Admin.AuthRules',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAuthRules', [
            'className' => 'Admin.AuthRules',
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
            ->maxLength('name', 80)
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('title')
            ->maxLength('title', 20)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('condition')
            ->maxLength('condition', 100)
            ->allowEmpty('condition');

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
