import './bootstrap';
var headers = new Headers();
headers.append("Accept", "application/json");
headers.append("Content-Type", "application/x-www-form-urlencoded");

$(document).ready(function () {
    $('.js-example-basic-single').select2();

    fetch("/api/libraries/get?tipo=asdasd",
    {
        method: "GET",
        headers: headers,
        //body: raw,
        redirect: "follow"
    })
    .then((response) => {
        
    })
    .then((result) => {
        
    })
    .catch((error) => console.error(error));
});
