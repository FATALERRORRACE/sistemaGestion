import './bootstrap';
var headers = new Headers();
headers.append("Accept", "application/json");
headers.append("Content-Type", "application/x-www-form-urlencoded");

$(document).ready(function () {
    $('#espacio').select2();
    $(".radio-lg").change((ev) => {
        fetch(`/api/libraries/get?type=${ev.currentTarget.value}`,
            {
                method: "GET",
                headers: headers,
                redirect: "follow"
            }
        )
        .then((response) => 
            response.json().then(json=>{
                json.unshift({
                    id: 0 ,
                    text: 'Seleccione el Espacio'
                })
                $('#espacio').empty().trigger('change');
                $("#espacio").select2({
                    data: json
                });
            })
        )
        .then((result) => {
            console.log('result');
            console.log(result);
        })
        .catch((error) => {
        });
    });
});
