function edit_brand(id_brand) {

    
    id_brand = id_brand - 1;
    
    // alert(passedArray[id_cpu]['Speed']);
    
    // alert(document.getElementById(id_cpu).value);
    // alert(document.getElementById('id_send_cpu').value);
    document.getElementById('id_send_brand').value = document.getElementById((id_brand + 1)).value;
    // alert(passedArray[id_brand]['Brand']);


    document.getElementById('idbrand_name').value = passedArray[id_brand]['Brand'];
}

function delete_brand(id_brand) {
    id_brand = id_brand - 1;
    // alert(passedArray[id_brand]['Brand']);

    // alert(passedArray[id_cpu]['Speed']);

    // alert(document.getElementById(id_cpu).value);
    // alert(document.getElementById('id_send_cpu').value);id_mostrar
    document.getElementById('id_mostrar').value = passedArray[id_brand]['Brand'];
    document.getElementById('id_send_brand_delete').value = document.getElementById((id_brand + 1)).value;
}