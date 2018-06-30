<?php

namespace Someline\Component\Role\Models;

use Carbon\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Someline\Models\BaseModel;
use Someline\Models\Foundation\User;
use Someline\Models\Traits\RelationUserTrait;

class SomelineRoleBase extends BaseModel implements Transformable
{
    use TransformableTrait;
    use RelationUserTrait;

    protected $table = 'someline_roles';

    protected $primaryKey = 'someline_role_id';

    protected $fillable = [
        'user_id',
        'title',
        'someline_role_id',
        'body_html',
        'body_text',
        'pinned_at',
    ];

    // Fields to be converted to Carbon object automatically
    protected $dates = [
        'pinned_at',
    ];

    /**
     * @return Carbon|null
     */
    public function getPinnedAt()
    {
        return $this->pinned_at;
    }

    /**
     * @return bool
     */
    public function isPinned()
    {
        return !empty($this->getPinnedAt());
    }

}
