<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 17:21
 */
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected $app;

    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of
            Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * 查询所有记录
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->select($columns)->get();
    }

    /**
     * 通过ID(主键)查找一条记录
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->select($columns)->findOrFail($id);
    }

    /**
     * 通过某一字段查找记录
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*'])
    {
        return $this->model->select($columns)->where($field, $value)->get();
    }

    /**
     * 通过传入的where条件查找记录
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        return $this->model->select($columns)->where($where)->get();
    }

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {

    }

    /**
     * 创建一个新的实例
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = new $this->model;
        return $model->create($attributes);
    }

    /**
     * 更新一个实例
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {

    }

    /**
     * 删除一个实例
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 根据$column字段排序
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc')
    {
        return $this->model->orderBy($column, $direction);
    }

    /**
     * 载入关联
     * @param $relations
     * @return mixed
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function getAllForSelect( $key, $v, $firstInfo = "--请选择--")
    {
        $data[''] = $firstInfo;
        $data +=  $this->all()->pluck($key, $v)->all();
        return $data;
    }
}