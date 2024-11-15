<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Consecutivos;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::all();
        $menu = $this->setMenuOrder($data->toArray());
        $libraries = $this->getLibraries();
        return view(
            'index/main',
            [
                'libraries' => $libraries,
                'menu' => $menu
            ]
        );
    }

    public function getLibraries()
    {
        return Consecutivos::all()->toArray();
    }



    public function setMenuOrder($data)
    {
        $menus = [];
        foreach ($data as $key => $menu) {
            if ($menu["parent"]) {
                $this->checkParentElement($menus, $menu);
            } else if (!isset($menus[$menu["id"]])) {
                $menus[$menu["id"]] = [
                    'id' => $menu["id"],
                    'label' => $menu["label"],
                    'action' => $menu["action"],
                    'childElements' => [],
                ];
            }
        }
        return $menus;
    }


    public function checkParentElement(&$menus, &$menu, $pos = null)
    {
        foreach ($menus as $key => $subMenu) {
            if ($menu['parent'] == $key) {
                $menus[$key]['childElements'][$menu["id"]] = [
                    'id' => $menu["id"],
                    'label' => $menu["label"],
                    'action' => $menu["action"],
                    'childElements' => [],
                ];
            } else if (sizeof($menus[$key]['childElements']) > 0) {
                $this->checkParentElement($menus[$key]['childElements'], $menu);
            }
        }
    }
}
