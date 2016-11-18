<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 17:06
 */
namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * 查询所有记录
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * 通过ID(主键)查找一条记录
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * 通过某一字段查找记录
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*']);

    /**
     * 通过传入的where条件查找记录
     *
     * @param array $columns
     * @return mixed
     */
    public function findWhere($column, $operator = null, $value = null, $columns = ['*']);

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']);

    /**
     * 创建一个新的实例
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * 更新一个实例
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * 删除一个实例
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * 根据$column字段排序
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * 载入关联
     * @param $relations
     * @return mixed
     */
    public function with($relations);

    public function paginate($perPage, $columns = array('*'));
}