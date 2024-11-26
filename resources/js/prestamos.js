import { Grid, html } from "gridjs";
import { esES } from "gridjs/l10n";
import $ from 'jquery';
import 'jquery-ui';
import toastr from "toastr";

export class Prestamos {
    columns = [
        { id: "id", name: "Teléfono (s)", width: '60px' },
        { id: "alias", name: "Documento usuario", width: '100px' },
        { id: "nombre_usuario", name: "Código de barras", width: '180px' },
        { id: "email", name: "Título del material", width: '150px' },
        { id: "biblioteca", name: "Autor del material", width: '150px' },
        { id: "privilegios", name: "Fecha de solicitud", width: '60px' },
        {
            name: 'Acción',
            width: '50px', //onclick="editUser(${row._cells[0].data})"
            formatter: (_, row) => html(
                `<div class="flex justify-center">
                    <button class="py-1 px-2 border rounded-md text-white bg-invented-300" >
                        <i class="fa-solid fa-check"></i> Validar
                    </button>
                </div>`
            ),
        },
    ];

    async render() {
        var instance = this;
        instance.instanceGrid();
        if(gridInstance !== undefined)
            gridInstance.updateConfig({
                columns: instance.columns,
                server: {
                    url: `/api/prestamos/${$('#espacio').val()}/get`,
                    then: data => data.data,
                    total: data => data.total
                },
                data: []
            }).forceRender();
        else
            gridInstance = await new Grid({
                className: {
                    tr: 'table-tr-custom',
                },
                columns: this.columns,
                search: true,
                sort: true,
                pagination: true,
                language: esES,
                resizable: true,
                selector: (cell, rowIndex, cellIndex) => cellIndex === 0 ? cell.firstName : cell,
                server: {
                    url: `/api/prestamos/${$('#espacio').val()}/get`,
                    then: data => data.data,
                    total: data => data.total
                }
            }).render(document.getElementById("tableContent"));

    }
}
