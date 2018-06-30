<?php

namespace Someline\Component\Role\Http\Controllers\Console;

use Someline\Http\Controllers\BaseController;

class SomelineRoleControllerBase extends BaseController
{

    public function getRoleList()
    {
        return view('console.roles.list');
    }

    public function getRoleNew()
    {
        return view('console.roles.new');
    }

}