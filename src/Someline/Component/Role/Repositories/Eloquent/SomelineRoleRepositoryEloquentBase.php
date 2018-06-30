<?php

namespace Someline\Component\Role\Repositories\Eloquent;

use Someline\Repositories\Eloquent\BaseRepository;
use Someline\Repositories\Criteria\RequestCriteria;
use Someline\Repositories\Interfaces\SomelineRoleRepository;
use Someline\Models\Role\SomelineRole;
use Someline\Validators\SomelineRoleValidator;
use Someline\Component\Role\Presenters\SomelineRolePresenter;

/**
 * Class SomelineRoleRepositoryEloquentBase
 * @package namespace Someline\Component\Role\Repositories\Eloquent;
 */
class SomelineRoleRepositoryEloquentBase extends BaseRepository implements SomelineRoleRepository
{

    protected $fieldSearchable = [
        'title' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SomelineRole::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SomelineRoleValidator::class;
    }


    /**
     * Specify Presenter class name
     *
     * @return mixed
     */
    public function presenter()
    {

        return SomelineRolePresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
