<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository {

    function model () {
        return 'App\Models\Product';
    }
}
