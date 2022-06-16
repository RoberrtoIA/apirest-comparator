function edit_cpu(id_cpu) {

    id_cpu = id_cpu - 1;

    // alert(passedArray[id_cpu]['Speed']);

    // alert(document.getElementById(id_cpu).value);
    // alert(document.getElementById('id_send_cpu').value);
    document.getElementById('id_send_cpu').value = document.getElementById((id_cpu + 1)).value;


    document.getElementById('idcpu').value = passedArray[id_cpu]['CPUModel'];
    document.getElementById('idscore').value = passedArray[id_cpu]['Score'];
    document.getElementById('idspeed').value = passedArray[id_cpu]['Speed'];
    document.getElementById('idcpubrand').value = passedArray[id_cpu]['idCPUBrand'];
}

function delete_cpu(id_cpu) {

    id_cpu = id_cpu - 1;

    // alert(passedArray[id_cpu]['Speed']);

    // alert(document.getElementById(id_cpu).value);
    // alert(document.getElementById('id_send_cpu').value);id_mostrar
    document.getElementById('id_mostrar').value = document.getElementById((id_cpu + 1)).value;
    document.getElementById('id_send_cpu_delete').value = document.getElementById((id_cpu + 1)).value;

}
