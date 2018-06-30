<?php

namespace Someline\Component\Role\Presenters;

use Someline\Transformers\SomelineRoleTransformer;
use Someline\Presenters\BasePresenter;

/**
 * Class SomelineRolePresenter
 *
 * @package namespace Someline\Component\Role\Presenters;
 */
class SomelineRolePresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SomelineRoleTransformer();
    }
}
