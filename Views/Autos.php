
<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES'&& $_SESSION['tipo']=='administrador')
  {?>
    <!doctype html>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="../Resources/css/vendor.css">
        <!-- Theme initialization -->
        <link rel="stylesheet" id="theme-style" href="../Resources/css/app.css">
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
                <i class="fa fa-bars"></i>
            </button> </div>
                    
                    
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> <span class="name">
                        <?php echo $_SESSION['nombre']; ?>
                    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="login.html"> <i class="fa fa-power-off icon" onclick='cerrar()'></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> Geolocalizacion </div>
                        </div>
                        <!--navegador contiene los botones-->
                        <?php
                        include_once "navigator.php";
                        ?>
                    </div>
                    
                </aside>
                <div class="sidebar-overlay" id="sidebar-oaverlay"></div>
                <article class="content dashboard-page" >
                    
                    <section class="section">
                        <div class="main col-lg-12">
                        <div class="card card-block sameheight-item">
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Codicono</th>
                                    <th>Color</th>

                                    <th>Foto</th>
                                    <th>Marca</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Placa</th>
                                    <th>Codicono</th>
                                    <th>Color</th>

                                    <th>Foto</th>
                                    <th>Marca</th>
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>
                             
                                <tbody>

                                <?php
                                 require("../Models/modelo_auto.php");
                                 $modeloauto=new modelo_auto();
                                 $autos=$modeloauto->getAll();

                                $longitud = count($autos);
                                for($i=0; $i<$longitud; $i++)
                                  {
                                      $a=$i+1;
                                echo '  <tr id="'.$a.'" onclick="mostrar(this.id);">';
                                echo'<td>'.$autos[$i]->getPlaca().'</td>
                                     <td>'.$autos[$i]->getCodicono().'</td>
                                     <td>'.$autos[$i]->getColor().'</td>
                                     <td>'.$autos[$i]->getFoto().'</td>
                                     <td>'.$autos[$i]->getMarca().'</td>;
                                      <td>
                                        <ul class="item-actions-list">
                                            <a class="remove" id="'.$a.'" data-toggle="modal" data-target="#confirm-modal" onclick="eliminar(this.id);"> <i class="fa fa-trash-o "></i>eliminar </a>   
                                            <a class="edit" id="'.$a.'" data-toggle="modal" data-target="#myModal" onclick="editar(this.id);"> <i class="fa fa-pencil" ></i> editar</a>
                                        </ul>
                                     </td>';
                                 echo '</tr>';
                                    }
                                 ?>
                            </tbody></table>
                                    
                        </div>
                        </div>
                    </section>
                    <section>
                    <div class="main col-lg-12">
                        <div class="card card-block sameheight-item">
                            <table class="table table-condensed" width="50%" >
                                <tr>
                                    <td rowspan="5" id="mostrar_imagen"></td>
                                </tr>
                                <tr>
                                    <th>Placa</th>
                                    <td id="mostrar_placa"></td>
                                </tr>
                                <tr>
                                    <th>Codicono</th>
                                    <td id="mostrar_codicono"></td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td id="mostrar_color"></td>
                                </tr>

                                <tr>
                                    <th>Marca</th>
                                    <td id="mostrar_marca"></td>
                                </tr>
                            </table>
         º                   
                            </div>
                    </div>
                    </section>
                </article>
                <footer class="footer">
                    <div class="footer-block buttons">  </div>
                    <div class="footer-block author">
                        <ul>
                            <li> created by <a>Edson Lipa Urbina</a> </li>
                            <li> <a>Ruth</a> </li>
                            <li> <a>willy</a> </li>
                            <li> <a>Milagros</a> </li>
                        </ul>
                    </div>
                </footer>
              
            </div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="myModalLabel">EDITAR</h4>
              </div>
              <div class="modal-body" style=" height: 600px;">

                
                <div class="main-wrapper" style="position;bottom: 0px;height: 600px;width: 580px;">
                    <div class="app" id="app" style=" padding: 0px;">
                        
                    
                    <div class="sidebar-overlay" id="sidebar-oaverlay"></div>
                
                <article class="content dashboard-page" style="padding-top: 0px;padding-right: 9px;padding-left: 9px;padding-bottom: 0px;">
                    
                    <section class="section">

                        <div class="container">
                        <div class="row">
                            <div class="main col-lg-12" style="padding-right: 1px; padding-left: 1px;">
                            <div class="card card-block sameheight-item" style="padding-bottom: 0px;">
                                <h1 class="page-header">
                                    <small>Registro de Autos</small>
                                </h1>
                            <div class="subtitle-block" style="margin-bottom: 0px;">
                                <h3 class="subtitle">
                                    Editar Auto
                                </h3>
                            <hr class="fx-line">
                            <div class="panel">
                            <form class="test" role="form" style="width: 521px; height: 301px;">
                            <div class="form-group" >
                                <label for="placa" class="col-lg-2 control-label">Placa:</label>
                                <input type="text" class="form-control" name="placa" id="form_placa" placeholder="Placa" style="width:330px;" required>
                            </div>

                            <div class="form-group">
                                <label for="codicono" class="col-lg-2 control-label">Codigo de Icono:</label>
                                <input type="text" class="form-control" name="codicono" id="form_codicono" placeholder="Codicono" style="width:330px;" required>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-lg-2 control-label">Color:</label>
                                <input type="text" class="form-control" name="color" id="form_color" placeholder="Color" style="width:330px;" required>
                            </div>
                            <div class="form-group">
                                <label for="marca" class="col-lg-2 control-label">Marca:</label>
                                <input type="text" class="form-control" name="marca" id="form_marca" placeholder="Marca" style="width:330px;" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen" class="col-lg-2 control-label">Imagen: </label>
                                <input class="inputFile " type='file' id='form_foto' name='foto' ><br>
                                            
                            </div>
                            </form>
                            <p class="login-submit">
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" id="update">Guardar cambios</button>
                                </div>
                            </p>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
            </div>
        </div>
            <!-- Reference block for JS -->
           
            
        
          </div>
        </div>
      </div>
    </div>
        <!-- Reference block for JS -->
       
        
        <script src="../Resources/js/vendor.js"></script>
        <script src="../Resources/js/app.js"></script>
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script>
        function cerrar()
        {
            $.ajax({
                url:'../Controllers/usuario.php',
                type:'POST',
                data:"boton=cerrar"
            }).done(function(resp){
                location.href = '../Views/'
            });
        }

    </script>
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            var table = $('#example').DataTable();

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        } );

        function mostrar(h) {
            document.getElementById("mostrar_imagen").innerHTML =" <img src='../Resources/img/"+document.getElementById("example").rows[h].cells[3].innerHTML+" ' width='250px' height='250px' >";
            document.getElementById("mostrar_placa").innerHTML = document.getElementById("example").rows[h].cells[0].innerHTML ;
            document.getElementById("mostrar_codicono").innerHTML = document.getElementById("example").rows[h].cells[1].innerHTML ;
            document.getElementById("mostrar_color").innerHTML = document.getElementById("example").rows[h].cells[2].innerHTML ;
            document.getElementById("mostrar_marca").innerHTML = document.getElementById("example").rows[h].cells[4].innerHTML ;
                       
        }

        function eliminar(h){
            var placa = document.getElementById("example").rows[h].cells[0].innerHTML ;
            
            if (confirm("¿seguro que desea eliminar un registro?")) {
                $.ajax({
                url:'../Controllers/eliminar_auto.php',
                type:'POST',
                data:"placa="+placa
                }).done(function(resp){
                alert(resp);
                    }
                )
           }
               else{

               }
        }

        function editar(h) {
                 var placa = document.getElementById("example").rows[h].cells[0].innerHTML ;
                 $.ajax({
                    url:'../Controllers/editar_auto.php',
                    type:'POST',
                    data:"placa="+placa
                }).done(function(resp){
                    
                    document.getElementById("form_placa").value = resp.placa;
                    document.getElementById("form_codicono").value = resp.codicono;
                    document.getElementById("form_color").value = resp.color;
                    document.getElementById("form_marca").value = resp.marca;
                    document.getElementById("form_foto").value = resp.foto;
                    }
                )
               
            }
        

    </script>
    <script type="text/javascript">
        $(function() {

        $("button#update").click(function(){
                    $.ajax({
                    type: "POST",
                    url: "../Controllers/actualizarAuto.php",
                    data: $('form.test').serialize(),

                    success: function(msg){
                             $("#modal-results").html(msg)
                            $("#myModal").modal('hide');
                            location.reload(); 
                            alert("se han guardado correctamente los datos");
                         },

                error: function(){
                    alert("error al capturar datos");
                    }
                      });
            });
        
        });
       
    </script>
    </body>

</html>    
<?php

  }
  else
  {
    header("location: ./");
  }
 ?>
