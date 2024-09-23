<?php

namespace App\Repositories\V1\Outlet;

use App\Models\Outlets;

class OutletRepository
{
    public function findOutletBySlug(string $slug) : Outlets
    {
        return Outlets::with('menus')->where('slug', $slug)->first();
    }


    public function getAllOutlet()
    {
        return Outlets::with('menus')->get();
    }
}
