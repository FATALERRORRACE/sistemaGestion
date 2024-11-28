import { Grid, html } from "gridjs";
import { esES } from "gridjs/l10n";
import $ from 'jquery';
import 'jquery-ui/ui/widgets/dialog';
import 'jquery-ui/ui/widgets/tabs';
import toastr from "toastr";


export class Seguimiento {

    columns = [
        { id: 'consecutivo_id', name: 'consecutivo', hidden: true},
        { id: 'Biblioteca', name: 'Biblioteca', width: '10em'},
        { id: 'fech_naci_usua', name: 'Fecha Nacimiento', width: '5em'},
        { id: 'nombre', name: 'Nombre', width: '14em'},
        { id: 'docu_pais_usua', name: 'Documento No.', width: '12em'},
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

    async render() {
        var instance = this;
        $("#tableContent").empty();
        $('#espacio').off('change.usuariosespacio');
        $('#espacio').on('change.seguimientoespacio', () => {
            //get data for grid
            gridInstance.updateConfig({
                columns: this.columns,
                server: {
                    url: `/api/registro/${$('#espacio').val()}/get`,
                    then: data => data.data,
                    total: data => data.total
                }
            }).forceRender();
        });
        if(gridInstance !== undefined)
            gridInstance.updateConfig({
                columns: this.columns,
                server: {
                    url: `/api/registro/${$('#espacio').val()}/get`,
                    then: data => data.data,
                    total: data => data.total
                }
            }).forceRender();
            
        else
            gridInstance = new Grid({
                className: {
                    tr: 'table-tr-custom',
                },
                columns: this.columns,
                search: true,
                sort: true,
                language: esES,
                resizable: true,
                pagination: true,
                server: {
                    url: `/api/registro/${$('#espacio').val()}/get`,
                    then: data => data.data,
                    total: data => data.total
                }
            }).render(document.getElementById("tableContent"));
        instance.instanceGrid();
    }

    async instanceGrid() {

        $("#dialog-form").dialog({
            autoOpen: false,
            height: 'auto',
            width: '55em',
            modal: true,
            open: function (event, ui) {
            },
        });


    }

    async createModalCreateUser() {
    }

    actionsNewUserModal() {
        fetch(`api/users/view/new`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
            .then((response) => response.text().then(text => {
                $(".ui-dialog-title").text("Nuevo Usuario");
                $("#dialog-form").html(text);
                $("#dialog-form").dialog("open");
                $("#place-txt").val($("#espacio option:selected").text());
                $("#nubiblioteca").val($("#espacio").val());
                $("#save-new-user").off().on('click.save-newuser', () => {
                    var dataNewUser = {};
                    $("#nu-form").serializeArray().forEach(element => {
                        dataNewUser[element.name] = element.value
                    });
                    fetch(`/api/users`,
                        {
                            method: "POST",
                            headers: headers,
                            body: JSON.stringify(dataNewUser),
                        })
                        .then((response) => response.json().then(json => {
                            $("#dialog-form").dialog('close');
                            $("#espacio").trigger("change");
                            if (json.status == 'ok') {
                                toastr.success(json.message);
                            } else {
                                toastr.error(json.message);
                            }

                        }));
                });
                $("#close-dialog").click(() => {
                    $("#dialog-form").dialog('close');
                });
            }));
    }
}

// GLOBAL FUNCTIONS
window.formSeguimiento = (idSeguimiento) => {
    fetch(`api/registro/form/${idSeguimiento}`,
        {
            method: "GET",
            headers: headers,
            redirect: "follow"
        }
    )
    .then((response) => response.text().then(text => {

        $(".ui-dialog-title").text("INFORMACIÓN DEL AFILIADO");
        $("#dialog-form").html(text);
        $("#dialog-form").dialog("open");
        $("#tabs").tabs();
        $("#localidad").select2();
        $("#diremuni").select2();
        $("#programa").select2();
        $("#barrio").select2();
        $("#convenio").select2();

        $("#diremuni").change((eve)=>{
            if(eve.currentTarget.value == 11){
                $("#localidad").attr('disabled', false);
                return;
            }
            $("#localidad").attr('disabled', true);
            $("#localidad").val('').trigger('change');
        });

        $("#localidad").change((eve)=>{
            fetch(`api/localidad/${eve.currentTarget.value}/barrio`,
                {
                    method: "GET",
                    headers: headers,
                    redirect: "follow"
                }
            )
            .then((response) => response.json().then( json => {
                $("#barrio").empty();
                $("#barrio").select2({
                    data: json
                });
            }));
        });

    }));
}
