import $ from 'jquery';;
import 'select2';
import 'jquery-ui/ui/widgets/dialog';

export class Utilities{
    async render() {
        if (defaultAccess) {
            $(`#acceso-${defaultAccess}`).prop("checked", true);
            fetch(`/api/libraries/get?type=${$(`#acceso-${defaultAccess}`).val()}`,
                {
                    method: "GET",
                    headers: headers,
                    redirect: "follow"
                }
            )
            .then((response) => response.json().then(json => {
                json.unshift({
                    id: -1,
                    text: 'Seleccione el Espacio'
                })
                $("#espacio").select2({
                    data: json
                })
                $("#espacio").val(defaultLibrary).trigger('change');
            }))
        }

        $(".radio-lg").change((ev) => {
            fetch(`/api/libraries/get?type=${ev.currentTarget.value}`,
                {
                    method: "GET",
                    headers: headers,
                    redirect: "follow"
                }
            )
            .then((response) => response.json().then(json => {
                json.unshift({
                    id: -1,
                    text: 'Seleccione el Espacio'
                })
                $('#espacio').empty().trigger('change');
                $("#espacio").select2({
                    data: json
                });
            }))
        });
    }
    async biblioteca(){
        var classContext = this;
        await fetch(`api/biblioteca/form`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
        .then((response) => response.text().then(text => {
            $("#sub-content").html(text);
            $("#dialog-bbltc").dialog({
                autoOpen: false,
                position: { my: "top", at: "bottom", of: $('#contain-e-t')},
                height: 'auto',
                width: 'auto',
                modal: true,
            });
            //btn-header-dialog
            $(".ui-dialog-title").prepend($("#btn-header-dialog").html());
            $("#btn-header-dialog").remove();
            $("#dialog-bbltc").dialog('open');
            $("#new-library").click(()=>{
                
                classContext.ChangeActiveInactive("new", "edit");
                $('#contain-e-t').css({"z-index": "10"});
            });
            $("#edit-library").click((eve)=>{
                classContext.ChangeActiveInactive("edit", "new");
                
                $('#contain-e-t').css({"z-index": "1000"});
            });
        }));
    }

    async ChangeActiveInactive(active, inactive){
        $(`#${active}-library`).removeClass('hover:bg-slate-500 bg-slate-200').addClass('hover:bg-blue-700 bg-blue-600');
        $(`#${inactive}-library`).removeClass('hover:bg-blue-700 bg-blue-600').addClass('hover:bg-slate-500 bg-slate-200');
        $(`#save-${active}-biblioteca`).css({"display": "block"});
        $(`#save-${inactive}-biblioteca`).css({"display": "none"});
    }
}

// GLOBAL FUNCTIONS
window.newLibrary = ($idUser) => {
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
                if(json.status == 'ok'){
                    toastr.success(json.message);
                }else{
                    toastr.error(json.message);
                }
            }));
        });
        $("#close-dialog").click(() => {
            $("#dialog-form").dialog('close');
        });
    }));
    console.log($idUser);
}
