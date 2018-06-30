<?php

namespace Someline\Component\Role\Transformers;

use Someline\Component\Role\Models\Entrust\Role;
use Someline\Transformers\BaseTransformer;

/**
 * Class SomelineRoleTransformer
 * @package namespace Someline\Component\Role\Transformers;
 */
class SomelineRoleTransformerBase extends BaseTransformer
{

    /**
     * Transform the SomelineRole entity
     * @param Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description,
        ];
    }
}
