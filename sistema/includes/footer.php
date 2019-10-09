  <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.1.0
            </div>
            <strong>Copyright &copy; <?=date("Y")?> <a href="">Colorlib </a><strong>and</strong><a href=""> NEXT LINE STUDIO</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../assets/template/jquery/jquery.min.js"></script>

<script src="../assets/template/jquey-print/jquery.print.js"></script>

<script src="../assets/template/jquery-ui/jquery-ui.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="../assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/template/dist/js/demo.js"></script>
<script>
$(document).ready(function () {
    var base_url= "";
    /*$(".btn-remove").on("click", function(e){
        //Cancelar accion de href mediante preventDefault
        e.preventDefault();
        //agrega la ruta http://localhost/ventas_ci/mantenimiento/delete a ruta
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });*/
    $(".btn-view-producto").on("click", function(){
        var data = $(this).val(); 
        //alert(producto);
        var infousuario = data.split("*");
        html = "<p><strong>Nombre: </strong>"+infousuario[1]+"</p>"
        html += "<p><strong>Correo: </strong>"+infousuario[2]+"</p> "
        html += "<p><strong>Usuario: </strong>"+infousuario[3]+"</p>"
        html += "<p><strong>Rol: </strong>"+infousuario[4]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
     $(".btn-view-proveedor").on("click", function(){
        var data = $(this).val(); 
        //alert(producto);
        var infoproveedor = data.split("*");
        html = "<p><strong>Proveedor: </strong>"+infoproveedor[1]+"</p>"
        html += "<p><strong>Contacto: </strong>"+infoproveedor[2]+"</p> "
        html += "<p><strong>Telefono: </strong>"+infoproveedor[3]+"</p>"
        html += "<p><strong>Direccion: </strong>"+infoproveedor[4]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
    $('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('.sidebar-menu').tree();

    $("#comprobantes").on("change", function(){
        option = $(this).val();
        if (option != "") {
            infocomprobante = option.split("*");
            $("#idcomprobante").val(infocomprobante[0]);
            $("#iva").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
        } else {
            $("#idcomprobante").val(null);
            $("#iva").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumar();
    });
    $(document).on("click", ".btn-check", function(){
        cliente = $(this).val();

        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });
    $("#producto").autocomplete({
        source: function(request, response){
        $.ajax({
                url: base_url+"movimientos/ventas/getproductos",
                type: "POST",
                dataType: "json",
                data: { valor: request.term},
                success: function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select: function(event, ui){
            data = ui.item.id + "*"+ ui.item.codigo + "*"+ ui.item.label + "*"+ ui.item.precio + "*"+ ui.item.stock;
            $("#btn-agregar").val(data);

        },
    });
    $("#btn-agregar").on("click", function(){
        data = $(this).val();
        if (data != '') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
            html += "<td>"+infoproducto[4]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='1' class='cantidades' onkeypress='return numerosenteros(event)'></td>";
            html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#producto").val(null);
        } else {
            alert("Seleccione un producto");
        }
    });
    //Quita los productos del detalle de venta y resta los totales
    $(document).on("click", ".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });

    //funcion permite que al editar en el input de cantidades se sume automaticamente en el importe 
    $(document).on("keyup", "#tbventas input.cantidades", function(){

        cantidad = $(this).val();
        

        

        if (cantidad!=0) {
        precio = $(this).closest("tr").find("td:eq(2)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumar();
          } else {
              alert("No se permite cantidades con cero");
              //cantidad = $(this).closest("tr").find("td:eq(4)").children("input").onkeypress("return numerosenteros(event)"));

          }
            
        
    });

    $(document).on("click", ".btn-view-venta", function(){
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type: "POST",
            dataType: "html",
            data: {id: valor_id},

            success: function (data) {
                $("#modal-default .modal-body").html(data);
            }
        });
    });

    $(document).on("click", ".btn-print", function(){
        $("#modal-default .modal-body").print({
            title: "Comprobante de Venta"
        });
    });

})

function sumar() {
    subtotal = 0;
    $("#tbventas tbody tr").each(function () {
       subtotal = subtotal +  Number($(this).find("td:eq(5)").text());

    });
   
    porcentaje = $("#iva").val();
    iva = subtotal * (porcentaje/100);
    $("input[name=iva]").val(iva.toFixed(2));
    subtotal2 = subtotal - iva;
    $("input[name=subtotal]").val(subtotal2.toFixed(2));
    descuento = $("input[name=descuento]").val();
    total = subtotal2 + iva  - descuento;
    $("input[name=total]").val(total.toFixed(2));

}

function numerosenteros(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numeros="0123456789";
    especiales="8-37-38-46";
    teclado_especial=false;
    for(var i in especiales){
        if (key==especiales[i]) {
            teclado_especial=true;
        }
    }
    if(numeros.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}

function numerosenterosSinCero(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numeros="123456789";
    especiales="8-37-38-46";
    teclado_especial=false;
    for(var i in especiales){
        if (key==especiales[i]) {
            teclado_especial=true;
        }
    }
    if(numeros.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}



function generarnumero(numero){
    if (numero >= 99999 && numero < 999999) {
        return Number(numero)+1;
    }
    if (numero >= 9999 && numero < 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero >= 999 && numero < 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero >= 99 && numero < 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero >= 9 && numero < 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ) {
        return "00000" + (Number(numero)+1);
    }
}


</script>
</body>
</html>
