function edit_model(id_model) {

    
    id_model = id_model - 1;

    passedArray[id_model]['idModel'];

    // alert(passedArray[id_model][1]);
    

    
    
    document.getElementById('edit_serie').value = passedArray2[id_model]['Serie'];
    document.getElementById('edit_year').value = passedArray[id_model]['YEAR'];
    document.getElementById('edit_screensize').value = passedArray[id_model]['ScreenSize'];
    document.getElementById('edit_pixeldensity').value = passedArray[id_model]['PixelDensity'];
    document.getElementById('edit_batterypower').value = passedArray[id_model]['BatteryPower'];
    document.getElementById('edit_ram').value = passedArray[id_model]['RAM'];
    document.getElementById('edit_resolutionx').value = passedArray[id_model]['ResolutionX'];
    document.getElementById('edit_resolutiony').value = passedArray[id_model]['ResolutionY'];
    document.getElementById('edit_frontmaincamera').value = passedArray[id_model]['FrontMainCamera'];
    document.getElementById('edit_backmaincamera').value = passedArray[id_model]['BackMainCamera'];
    document.getElementById('edit_weight').value = passedArray[id_model]['Weight'];
    document.getElementById('edit_refreshrate').value = passedArray[id_model]['RefreshRate'];

    // button
    document.getElementById('get_id_update').value = document.getElementById((id_model + 1)).value;
    // alert(document.getElementById('get_id_update').value);

}

function delete_model(id_model) {

    id_model = id_model - 1;

    // alert(passedArray[id_model]['Smartphone']);

    // alert(document.getElementById(id_cpu).value);
    // alert(document.getElementById('id_send_cpu').value);id_mostrar
    document.getElementById('id_mostrar').value = passedArray[id_model]['Smartphone']
    document.getElementById('id_send_model_delete').value = document.getElementById((id_model + 1)).value;

}