function clearForm() {
    // getElementById('idnombre').value = '';
    // alert('idsmart1');

    // document.getElementById('idnombre').value = ''
    const form = document.getElementById('formulario');
    form.reset();
}

function actionCompare() {
    const QueryString = window.location.search; 
    const urlParams = new URLSearchParams(QueryString); 
    let id1 = document.getElementById("idsmart1").value
    let id2 = document.getElementById("idsmart2").value
    // alert(urlParams.get('lang'));

    if (urlParams.get('lang')) {
        window.location.href="http://localhost/apirest-comparator/public/compare/" + id1 + "/" + id2 + "?lang=" + urlParams.get('lang');
    } else {
        window.location.href="http://localhost/apirest-comparator/public/compare/" + id1 + "/" + id2 + "?lang=en";
    }
    
    
}