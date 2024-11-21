import { Usuarios } from './usuarios';
import { Utilities } from './utils';
import $ from 'jquery';
import 'jquery-ui';

var activeMenu;// for whole content or specific modal
var activeSubMenu;// for whole content or specific modal

$(document).ready(function () {
    var instance = new Utilities;
    instance.render();

    $('#submenu-78').click((ev) => {
        if(activeMenu == 'Usuarios') return;
        var instance = new Usuarios;
        instance.render();
        activeMenu = 'Usuarios';
    });

    $('#submenu-82').click((ev) => {
        if(activeSubMenu == 'biblioteca') return;
        instance.biblioteca();
        activeSubMenu = "biblioteca";
    });
});