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
        foreach ($menus as $menu) {
            if(!is_null($menu['rol']) && $menu['rol'] < $privilegio) continue;
            $html .=
                "<div class=\"dropdown dropdown-hover\">
                    <button data-mdb-button-init data-mdb-ripple-init data-mdb-dropdown-init
                        class=\"border-bblr-1 rounded-lg dropdown-toggle base-1-color btn js-consultar-inscritos-single border-bblr-1 rounded-lg\"
                        type=\"button\" id=\"menu-{$menu["id"]}\" data-mdb-toggle=\"dropdown\" aria-expanded=\"false\">
                        {$menu["label"]}
                    </button>";
            if (sizeof($menu["childElements"]) > 0) {
                $html .= "<ul class=\"dropdown-menu dropdown-menu-hover\" aria-labelledby=\"menu-{$menu['id']}\">";
                self::setSubmenuHtml($menu["childElements"], $html, $privilegio);
                $html .= "</ul>";
            }
            $html.= "</div>";
        }
        return $html;
    }

    public static function setSubmenuHtml($menus, &$html, $privilegio){
        foreach ($menus as $menu) {
            if(!is_null($menu['rol']) && $menu['rol'] < $privilegio) continue;
            $html .=
                "<li>
                    <a class=\"dropdown-item\" href=\"#\" id=\"submenu-{$menu['id']}\">
                        {$menu["label"]} " . (sizeof($menu["childElements"]) > 0 ? "&raquo;" : "") . "
                    </a>";
            if (sizeof($menu["childElements"]) > 0) {
                $html .= "<ul class=\"sub-dropdown-menu dropdown-menu dropdown-submenu\">";
                self::setSubmenuHtml($menu["childElements"], $html, $privilegio);
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
