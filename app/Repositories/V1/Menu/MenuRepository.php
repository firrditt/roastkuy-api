<?php

namespace App\Repositories\V1\Menu;

use App\Models\Menu;

class MenuRepository
{
    public function findMenuByOutlet(string $outlet_id)
    {
        return Menu::with('outlet')->select()->where('outlet_id', $outlet_id)->get();
    }

    public function findMenuById(string $id)
    {
        return Menu::with(['outlet', 'menusCategory'])->select()->where('outlet_id', $id)->get();
    }

    public function findDetailById(string $id)
    {
        return Menu::with('menusCategory')->where('id', $id)->first();
    }
}
