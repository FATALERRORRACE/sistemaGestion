import { Usuarios } from './usuarios';
import { Utilities } from './utils';
import $ from 'jquery';
import 'jquery-ui';

var activeMenu;// for whole content or specific modal
var activeSubMenu;// for whole content or specific modal

$(document).ready(function () {
    var instanceUtils = new Utilities;
    instanceUtils.render();

    $('#submenu-78').click((ev) => {
        if(activeMenu == 'Usuarios') return;
        var instanceUsers = new Usuarios;
        instanceUsers.render();
        activeMenu = 'Usuarios';
    });

    $('#submenu-82').click((ev) => {
        instanceUtils.biblioteca(activeSubMenu);
        activeSubMenu = "biblioteca";
    });

    $('#submenu-58').click((ev) => {
        instanceUtils.biblioteca(activeSubMenu);
        activeSubMenu = "biblioteca";
    });
    
});