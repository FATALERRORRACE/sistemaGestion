import { Grid, html, h } from "gridjs";
import 'gridjs/dist/theme/mermaid.min.css';
import { esES } from "gridjs/l10n";
import $ from 'jquery';
import 'jquery-ui';
import toastr from "toastr";

export class Usuarios {
    columns = [
        { name: "id", width: '60px' },
        { name: "alias", width: '100px' },
        { name: "nombre_usuario", width: '180px' },
        { name: "email", width: '150px' },
        { name: "biblioteca", width: '150px' },
        { name: "privilegios", width: '60px' },
        {
            name: "estado", width: '60px',
            formatter: (cell) => html(cell == 1 ? `<span class="text-emerald-600">Activo</span>` : `<span class="text-red-400">Inactivo</span>`)
        },
        {
            name: 'Acción',
            width: '50px',
            formatter: (_, row) => html(
                `<div class="flex justify-center">
                    <button class="py-1 px-2 border rounded-md text-white bg-invented-300" onclick="editUser(${row._cells[0].data})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>`
            ),
        },
    ];

    async render() {
        var instance = this;
        await fetch(`api/users/view`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
            .then((response) => response.text().then(text => {
                $("#whole-content").html(text);
                instance.instanceGrid();
            }));
    }

    async instanceGrid() {
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
            data: []
        }).render(document.getElementById("tableContent"));

        await this.createModalCreateUser();

        $('#espacio').change((ev) => {
            //get data for grid
            if(ev.currentTarget.value != undefined && ev.currentTarget.value != '' ){
                fetch(`api/users/${ev.currentTarget.value}/get`,
                {
                    method: "GET",
                    headers: headers,
                    redirect: "follow"
                })
                .then((response) => response.json().then(json => {
                    gridInstance.updateConfig({
                        data: json
                    }).forceRender();
                    gridInstance.data = json;
                    this.createModalCreateUser();
                }));
            }
        });

        $("#espacio").trigger("change");

        $("#dialog-form").dialog({
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            modal: true,
            open: function (event, ui) {
            },
        });
    }

    async createModalCreateUser() {
        var classEnv = this;
        $(".gridjs-head").append(`<button id=\"create-user\" class="px-3 mx-3 base-1-color btn rounded-lg p-2"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-user"></i></button>`);
        $("#create-user").off().on("click", function () {
            classEnv.actionsNewUserModal();
        });
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
                $("#save-new-user").click(() => {
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
window.editUser = ($idUser) => {
    fetch(`api/users/view/${$idUser}/edit`,
        {
            method: "GET",
            headers: headers,
            redirect: "follow"
        }
    )
        .then((response) => response.text().then(text => {
            $(".ui-dialog-title").text("Editar Usuario");
            $("#dialog-form").html(text);
            $("#dialog-form").dialog("open");
            $("#save-change-user").click(() => {

                var dataNewUser = {};
                $("#nu-form").serializeArray().forEach(element => {
                    dataNewUser[element.name] = element.value
                });
                if ($("#id-edit").val() != undefined) {
                    fetch(`/api/users/${$("#id-edit").val()}/edit`,
                        {
                            method: "POST",
                            headers: headers,
                            body: JSON.stringify(dataNewUser),
                        }
                    )
                        .then((response) => response.json().then(json => {
                            $("#dialog-form").dialog('close');
                            $("#espacio").trigger("change");
                            if (json.status == 'ok') {
                                toastr.success(json.message);
                            } else {
                                toastr.error(json.message);
                            }
                        }));
                }
            });
            $("#close-dialog").click(() => {
                $("#dialog-form").dialog('close');
            });
        }));
    console.log($idUser);
}
