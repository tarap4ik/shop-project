function toogle(element) {
    var url = '/bitrix/components/custom/partner/templates/.default/ajax.php';
    var status = '';

    if (document.getElementById(element).getAttribute('data-active') == 'N') {
        document.getElementById(element).textContent = 'Деактивировать';
        status = 'Y';
        document.getElementById(element).setAttribute('data-active', status);
    }
    else {
        document.getElementById(element).textContent = 'Активировать';
        status = 'N';
        document.getElementById(element).setAttribute('data-active', status);
    }

    BX.ajax({
        url: url,
        data: {id: element, status: status},
        method: 'POST',
        onsuccess: function (data) {

        },
        onfailure: function () {

        }
    });
}
