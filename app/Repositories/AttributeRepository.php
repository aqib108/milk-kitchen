<?php

namespace App\Repositories;

use App\Repositories\Main\BaseRepository;
use App\Models\Attribute;

/**
 * Class AttributeRepository.
 */
class AttributeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Attribute::class;
    }
}