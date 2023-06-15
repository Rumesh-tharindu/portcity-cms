<?php

namespace App\Repositories;

use App\Models\ProductFeature;
use Exception;

class CommonRepository extends Repository
{
    // restore the record from the database
    public function productRestore($id)
    {
        try {
            $product = $this->model::withTrashed()->find($id);

            $product->restore();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
