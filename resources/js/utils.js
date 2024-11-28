import $ from 'jquery';;
import 'select2';
import 'jquery-ui/ui/widgets/dialog';
import 'jquery-ui/ui/effects/effect-highlight';
import toastr from "toastr";

export class Utilities {
    newOrEdit = "new";
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
            if(!ev.currentTarget.checked) return;
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

        $("#search-by-menu").select2();

        $("#filter-submenu").click(()=>{
            $("#filter-menu-dropdown").data("open");
            $("#filter-menu-dropdown").css({'display': "block"}).data("open",1);
        });

        $("#close-submenu-filter").click(()=>{
            $("#filter-menu-dropdown").css({'display': "none"}).data("open",0);
        });

        $("#search-by-menu").change((eveS)=>{
            if($("#filter-menu-dropdown").data("open") == 1){
                $(".dropdown-menu-hover").attr('style', false);
                $(".sub-dropdown-menu").attr('style', false);
                $("#" + eveS.currentTarget.value).trigger('click');
                var parent = $("#" + eveS.currentTarget.value).parent();
                do {
                    if(parent[0].localName == 'ul'){
                        parent.fadeIn(400)
                        $("#" + eveS.currentTarget.value).effect('highlight', {}, 1500);
                    };
                    parent = parent.parent();
                } while ( parent[0].localName != 'div');

                $(".dropdown-menu-hover").fadeOut(2000)
                $(".sub-dropdown-menu").fadeOut(2000)
                setTimeout(() => {
                    $(".dropdown-menu-hover").attr('style', false);
                    $(".sub-dropdown-menu").attr('style', false);
                }, 3000);
                $("#filter-menu-dropdown").css({'display': "none"}).data("open",0);
            }   
        });
        $("#search-by-menu").closest('.list_product').css({'display': "block"});
    }

    async biblioteca(activeSubMenu) {
        var classContext = this;
        if (activeSubMenu == 'biblioteca') {
            classContext.bibliotecaInitBefore();
            return;
        };
        await fetch(`api/biblioteca/form`,
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
        $("#sub-content").html(text);
        $("#dialog-bbltc").dialog({
            autoOpen: false,
            position: { my: "top", at: "bottom", of: $('#contain-e-t') },
            height: 'auto',
            width: 'auto',
            modal: false,
            open: function(event, ui) {
                $(".ui-dialog-title").text('');
                setTimeout(() => {
                    $("#modal-mask").css({'display': 'block'});    
                }, 200);
                if(classContext.newOrEdit == 'edit'){
                    $('#contain-e-t').css({ "z-index": "1000" });
                    $("#espacio").trigger('change');
                }
            },
            close: function(event, ui) {
                $('#contain-e-t').css({ "z-index": "10" });
                $("#modal-mask").css({'display': 'none'});
            },
        });

        $("#close-biblioteca-dialog").click(() => {
            $("#dialog-bbltc").dialog('close');
        });

        $("#dialog-bbltc").dialog('open');

        $("#new-library").off().click(() => {
            classContext.ChangeActiveInactive("new", "edit");
            $('#contain-e-t').css({ "z-index": "10" });
            $("#biblioteca").val('');
            $("#carne").val('');
            $("#codigo").val('');
            $("#impresion").prop("checked",false);
            $("#publico").prop("checked",false);
            $("#localidad").val('').trigger("change");
            
        });
        
        $("#espacio").on('change.utilsespacio', (ev) => {
            if(this.newOrEdit == 'new') return;
            if(ev.currentTarget.value < 0){
                toastr.warning('Selecciona el Espacio a Editar');
                return;
            }
            fetch(`api/biblioteca/${ev.currentTarget.value}`,
            {
                method: "GET",
                headers: headers,
            })
            .then((response) => response.json().then( json => {
                $("#biblioteca").val(json.biblioteca);
                $("#carne").val(json.carne);
                $("#codigo").val(json.codigo);
                if(json.impresion == 1) $("#impresion").prop("checked",true); else $("#impresion").prop("checked",false);
                if(json.publico_escolar == 1) $("#publico").prop("checked",true); else $("#publico").prop("checked",false);
                $("#localidad").val(json.localidad).trigger("change");
                $(`#bbltcacceso-${json.tipo}`).prop("checked",true);
            })); 
        });

        $("#edit-library").click((eve) => {
            classContext.ChangeActiveInactive("edit", "new");
            $('#contain-e-t').css({ "z-index": "1000" });
            $("#espacio").trigger('change');
        });

        $("#localidad").select2()

        this.saveActions();
    }

    async saveActions() {
        $("#save-biblioteca").off().click(()=>{
            var url = (this.newOrEdit == 'edit' ? `/api/biblioteca/${$("#espacio").val()}` : `api/biblioteca`);
            var dataNewUser = {};
            $("#biblioteca-form").serializeArray().forEach(element => {
                dataNewUser[element.name] = element.value
            });
            fetch(url,
                {
                    method: "POST",
                    headers: headers,
                    body: JSON.stringify(dataNewUser),
                }
            )
            .then((response) => response.json().then(json => {
                if (json.status == 'ok'){
                    toastr.success(json.message);
                    $(`#acceso-${json.tipo}`).prop("checked",true);
                    fetch(`/api/libraries/get?type=${json.tipo}`,
                        {
                            method: "GET",
                            headers: headers,
                            redirect: "follow"
                        }
                    )
                    .then((response) => response.json().then(jsonLibrary => {
                        jsonLibrary.unshift({
                            id: -1,
                            text: 'Seleccione el Espacio'
                        })
                        $('#espacio').empty().trigger('change');
                        $("#espacio").select2({
                            data: jsonLibrary
                        });
                        $("#espacio").val(json.id).trigger('change');
                    }))
                    $("#dialog-bbltc").dialog('close');
                } else {
                    toastr.error(json.message);
                }
            }));
        })
    }

    async ChangeActiveInactive(active, inactive) {
        $(`#${active}-library`).removeClass('hover:bg-slate-500 bg-slate-200').addClass('hover:bg-blue-700 bg-blue-600');
        $(`#${inactive}-library`).removeClass('hover:bg-blue-700 bg-blue-600').addClass('hover:bg-slate-500 bg-slate-200');
        this.newOrEdit = active;
    }

    async bibliotecaInitBefore() {
        $("#dialog-bbltc").dialog('open');
    }
}