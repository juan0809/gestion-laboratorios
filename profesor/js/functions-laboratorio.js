function eliminarlaboratorio(id){
    var id = id;

    swal({
        title: "Eliminar Laboratorio",
        text: "¿Desea eliminar este laboratorio?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar usuario",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },function(confirm){
        if(confirm){
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/usuarios/delet-usuarios.php';
            request.open('POST',url,true);
            var strData = "idusuario="+id;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(data.status){
                    swal('Eliminar',data.msg,'success');
                    tableusuarios.ajax.reload();
                }else{
                    swal('Usuario',data.msg,'error');
                }
            }
        }
        }
    })
}