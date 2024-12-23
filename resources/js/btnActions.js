import { Usuarios } from './usuarios';
import { Seguimiento } from './seguimiento';
import { Utilities } from './utils';
import { Prestamos } from './prestamos';
import { ConsultarInscritos } from './consultarInscritos';
import $ from 'jquery';

var activeMenu, activeSubMenu;// for whole content or specific modal
var instanceUtils;// Base Instance
var instanceUsers, instanceSeguimiento, prestamosInstance, consultarInscritos;
$(document).ready(function () {
    instanceUtils = new Utilities;
    instanceUtils.render();

    $('.dropdown-item').click((ev) => {
        instanceUsers, instanceSeguimiento, prestamosInstance = null;// clean previous instances to not load to much cpu
    });

    $('#submenu-78').click((ev) => {
        if(activeMenu == 'usuarios') return;
        instanceUsers = new Usuarios;
        instanceUsers.render();
        activeMenu = 'usuarios';
    });

    $('#submenu-82').click((ev) => {
        instanceUtils.biblioteca(activeSubMenu);
        activeSubMenu = "biblioteca";
    });

    $('#submenu-58').click((ev) => {
        if(activeMenu == 'seguimiento') return;
        instanceSeguimiento = new Seguimiento;
        instanceSeguimiento.render();
        activeMenu = "seguimiento";
    });

    $('#submenu-91').click((ev) => {
        if(activeMenu == 'prestamos') return;
        prestamosInstance = new Prestamos;
        prestamosInstance.render();
        activeMenu = "prestamos";
    });

    $('#submenu-15').click((ev) => {
        if(!consultarInscritos) consultarInscritos = new ConsultarInscritos;
        consultarInscritos.qrGenerate(activeSubMenu);
        activeSubMenu = "QrCode";
    });

    $('#submenu-12').click((ev) => {
        if(activeMenu == 'buscarinscritos') return;
        if(!consultarInscritos) consultarInscritos = new ConsultarInscritos;
        consultarInscritos.renderFindRegistered();
        activeMenu = 'buscarinscritos';
    });

});