<?php

namespace App\Services;

use App\Dictionaries\UserRolesDictionary;
use App\Models\User;
use App\Traits\ServiceTrait;

class UserService
{
    use ServiceTrait;

    public function __construct()
    {
        return $this;
    }

    public function getAll(array $data): \Illuminate\Database\Eloquent\Collection
    {
        $query = User::query()->select('*');

        //no admins can watch only their data
        if (!auth()->user()->hasRole([UserRolesDictionary::ROLE_SUPERADMIN])) {
            $query->where('id', auth()->user()->id);
        } else {
            //only superadmin childs
            $query->where('parent_id', auth()->user()->id);
        }

        (isset($data['sort_by'])) ? $query->orderBy($data['sort_by'], (array_key_exists('order_by', $data) ? $data['order_by'] : 'desc')) : $query->orderBy('created_at', 'desc');

        return $query->get();
    }
}
