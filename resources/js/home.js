import './bootstrap';
import { Grid, html, h } from "gridjs";
import 'gridjs/dist/theme/mermaid.min.css';
import { esES } from "gridjs/l10n";

$(document).ready(function () {
    $('.js-example-basic-single').select2();
    gridInstance = new Grid({
        className: {
            tr: 'table-tr-custom',
        },
        columns: [
            {
                name: "id", width: '60px'
            },
            {
                name: "alias", width: '100px'
            },
            {
                name: "nombre_usuario", width: '180px'
            },
            {
                name: "email", width: '180px'
            },
            {
                name: "biblioteca", width: '70px'
            },
            {
                name: "privilegios", width: '60px'
            },
            {
                name: "estado", width: '60px',
                formatter: (cell) => html(cell == 1 ? `<span class="text-emerald-600">Activo</span>` : `<span class="text-red-400">Inactivo</span>`)
            },
            {
                name: 'Acción',
                width: '50px',
                formatter: (cell) => html(`<div class="flex justify-center"><button class="py-1 px-2 border rounded-md text-white bg-invented-300"><i class="fa-solid fa-pen-to-square"></i></button></div>`),
            },
        ],
        search: true,
        sort: true,
        pagination: true,
        language: esES,
        resizable: true,
        selector: (cell, rowIndex, cellIndex) => cellIndex === 0 ? cell.firstName : cell,
        data: []
    }).render(document.getElementById("tableContent"));

    setTimeout(() => {

        $(`#acceso_${defaultAccess}`).prop("checked", true).trigger("change");

        setTimeout(() => {
            $(".gridjs-head").append(`<button class="mx-3 base-1-color btn rounded-lg p-2"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-user"></i></button>`);
            $("#espacio").val(defaultLibrary).trigger('change');
        }, 200);
    }, 200);

});
