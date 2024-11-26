<?php

namespace App\View\Components;

use Illuminate\View\Component;

class menuComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public static function renderMenu($menus,$privilegio){
        $html = "";
        $select = 
        "<div class=\"dropdown\">
            <button 
                class=\"rounded-lg dropdown-toggle base-1-color btn rounded-lg mx-1\"
                type=\"button\" id=\"filter-submenu\" >
                <i class=\"fa-solid fa-lg fa-magnifying-glass\"></i>
            </button>
            <ul id=\"filter-menu-dropdown\"  class=\"dropdown-menu p-2\" aria-labelledby=\"filter-submenu\">
                <li>
                    <div class=\"flex  justify-between\">
                        <label class=\"font-medium text-gray-700 block opacity-80\" for=\"direccion\">
                            Filtrar Menú
                        </label>
                        <button id=\"close-submenu-filter\" class=\"text-black\">Cerrar</button>
                    </div>
                    <select id=\"search-by-menu\" class=\"base-1-color  rounded-md shadow-sm border-gray-300 \" style=\"width:35em;\">";
        foreach ($menus as $menu){
            if(!is_null($menu['rol']) && $menu['rol'] < $privilegio) continue;
            $html .=        
                "<div class=\"dropdown dropdown-hover\">
                    <button data-mdb-button-init data-mdb-ripple-init data-mdb-dropdown-init
                        class=\"border-bblr-1 rounded-lg dropdown-toggle base-1-color btn js-consultar-inscritos-single border-bblr-1 rounded-lg mx-1\"
                        type=\"button\" id=\"menu-{$menu["id"]}\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\">
                        {$menu["label"]}
                    </button>";
            if (sizeof($menu["childElements"]) > 0) {
                $html .= "<ul class=\"dropdown-menu dropdown-menu-hover\" aria-labelledby=\"menu-{$menu['id']}\">";
                self::setSubmenuHtml($menu["childElements"], $html, $privilegio, $select, $menu["label"]);
                $html .= "</ul>";
            }
            $html.= "</div>";
        }
        $select.= "</select>
                </li>
            </ul>
        </div>";
        return "$select $html";
    }

    public static function setSubmenuHtml($menus, &$html, $privilegio, &$select, $parentLabel){
        foreach ($menus as $menu) {
            if(!is_null($menu['rol']) && $menu['rol'] < $privilegio) continue;
            $select.='<option value="submenu-'.$menu['id'].'">'.($parentLabel ? "$parentLabel - ":"") .$menu["label"].'</option>';
            $html .=
                "<li>
                    <a class=\"dropdown-item\" href=\"#\" id=\"submenu-{$menu['id']}\">
                        {$menu["label"]} " . (sizeof($menu["childElements"]) > 0 ? "&raquo;" : "") . "
                    </a>";
            if (sizeof($menu["childElements"]) > 0) {
                $html .= "<ul class=\"sub-dropdown-menu dropdown-menu dropdown-submenu\">";
                self::setSubmenuHtml($menu["childElements"], $html, $privilegio, $select, "$parentLabel - {$menu["label"]}");
                $html .= "</ul>";
            }
            $html .= "</li>";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-component');
    }
}
