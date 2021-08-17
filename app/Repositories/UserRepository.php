<?php
namespace App\Repositories;

use App\Repositories\Main\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }
}