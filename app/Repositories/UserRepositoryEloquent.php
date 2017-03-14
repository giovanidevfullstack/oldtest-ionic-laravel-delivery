<?php

namespace Delivery\Repositories;

use Delivery\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getDeliverymen(){
        return $this->findWhere(['role'=>'deliveryman'])->lists('name','id');
    }

    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }


    public function updateDeviceToken($id, $deviceToken)
    {
        $model = $this->model->find($id);
        $model->device_token = $deviceToken;
        $model->save();
        return $this->parserResult($model);
    }

}
