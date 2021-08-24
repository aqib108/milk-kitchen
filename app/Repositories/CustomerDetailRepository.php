<?php

namespace App\Repositories;

use App\Repositories\Main\BaseRepository;
use App\Models\CustomerDetail;

/**
 * Class CustomerDetailRepository.
 */
class CustomerDetailRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return CustomerDetail::class;
    }
}