import './bootstrap';

$(document).ready(function () {
    $("#create-user").button().on("click", function () {
        dialog.dialog("open");
    });
    $("#espacio").change(() => {

    });
    $('#submenu-78').click((ev) => {
        fetch(`api/users/${0}/get`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
        .then((response) => response.json().then(json => {
            gridInstance.updateConfig({
                data: json
            }).forceRender();
            gridInstance.data = json;
            $(".gridjs-head").append(`<button class="mx-3 base-1-color btn rounded-lg p-2"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-user"></i></button>`);
        }))
    });
});
