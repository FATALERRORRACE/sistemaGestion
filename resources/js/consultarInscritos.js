import $ from 'jquery';
import { Grid, html } from "gridjs";
import { esES } from "gridjs/l10n";
import 'jquery-ui';
import toastr from "toastr";

export class ConsultarInscritos {
    newOrEdit = "new";

    							
    columns = [
        { id: '', name: 'Consecutivo'},
        { id: '', name: 'F. Solicitud'},
        { id: '', name: 'Biblioteca Afiliación'},
        { id: '', name: 'Nombre'},
        { id: '', name: 'Afiliación'},
        { id: '', name: 'C. Barras'},
        { id: '', name: 'Documento No.'},
        { id: '', name: 'Opciones'},
        {
            name: 'Acción',
            width: '9em',
            formatter: (_, row) => html(
                `<div class="flex justify-center">
                    <button class="py-1 px-2 rounded-md text-white bg-invented-300  btn-sm mx-1 hover:bg-green-600" onclick="formSeguimiento">
                        Seguimiento
                    </button>
                    <button class="bg-009F4D py-1 px-2 rounded-md text-white  btn-sm hover:bg-blue-700" onclick="formSeguimiento(${row._cells[0].data})">
                        Formulario
                    </button>
                </div>`
            ),
        },
    ];

    async qrGenerate(activeSubMenu) {
        var classContext = this;
        if (activeSubMenu == 'QrCode') {
            classContext.qrInitBefore();
            return;
        };
        await fetch(`api/qr/form`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
        .then((response) => response.text().then(text => {
            classContext.jqActions(text);
        }));
    }

    async jqActions(text) {
        var classContext = this;
        $("#dialog-form").html(text);
        $("#dialog-form").dialog({
            autoOpen: false,
            position: { my: "top", at: "bottom", of: $('#contain-e-t') },
            height: 'auto',
            width: '40em',
            modal: false,
            open: function(event, ui) {
                $(".ui-dialog-title").text('');
                $('#contain-e-t').css({ "z-index": "1000" });
            },
            close: function(event, ui) {
                $('#contain-e-t').css({ "z-index": "10" });
            },
        });

        $("#close-biblioteca-dialog").click(() => {
            $("#dialog-form").dialog('close');
        });

        $("#dialog-form").dialog('open');
        $("#espacio").off('change.qr');
        $("#espacio").on('change.qr', (ev) => {
            $("#qr-content").html(
                `<a href="api/qr/donwload/${$("#espacio").val()}/png" class="rounded-lg base-1-color btn-sm p-2 mx-1 border-2 border-bblr-1 " download="">Descargar .PNG</a>
                <a href="api/qr/donwload/${$("#espacio").val()}/pdf" class="rounded-lg base-1-color btn-sm p-2 mx-1 border-2 border-bblr-1 " download="">Descargar .PDF</a>
                <a href="http://afiliacion.biblored.net/afiliacion/admin/qrcodes/${$("#espacio").val()}.png" class="rounded-lg base-1-color btn-sm p-2 mx-1 border-2 border-bblr-1 " Target="_blank">Link a la imagen</a>
                <div class="p-2 w-100">
                    <img style="w-100" src="http://afiliacion.biblored.net/afiliacion/admin/qrcodes/${$("#espacio").val()}.png">
                </div>`
            );
        });
        $("#espacio").trigger('change.qr');
    }

    renderFindRegistered(){
        fetch(`api/inscritos/view`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
        .then((response) => response.text().then(text => {
            this.renderFindRegisteredUtils(text)
        }));
    }

    renderFindRegisteredUtils(text){
        var instance = this;
        $("#tableContent").html(text);
        var urlParams = 
            `?documento=${$("#documento").val()}&
            nombres=${$("#nombres").val()}&
            apellidos=${$("#apellidos").val()}&
            email=${$("#email").val()}&
            consecutivo=${$("#espacio").val()}&
            consecutivonm=${$("#espacio option:selected").text()}`;
        gridInstance = new Grid({
            className: {
                tr: 'table-tr-custom',
            },
            columns: this.columns,
            sort: true,
            language: esES,
            resizable: true,
            pagination: true,
            server: {
                url: `/api/inscritos/${$('#espacio').val()}/get${urlParams}`,
                then: data => data.data,
                total: data => data.total
            }
        }).render(document.getElementById("tableinscritos"));
        $("#espacio").off('change.inscritos').off('change.utilsespacio').off('change.qr');
        $("#espacio").on('change.inscritos', (ev) => {
            gridInstance.updateConfig({
                columns: instance.columns,
                server: {
                    url: `/api/inscritos/${$('#espacio').val()}/get${urlParams}`,
                    then: data => data.data,
                    total: data => data.total
                },
                data: []
            }).forceRender();
        });
    }
}
