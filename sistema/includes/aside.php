<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../sistema/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
    
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="#">
            <i class="fa fa-home"></i> <span>Inicio</span>
          </a>
          
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i><span>Mantenimiento</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
              <li><a href=""><i class="fa fa-circle-o"></i> Categorias</a></li>
              <li><a href=""><i class="fa fa-circle-o"></i> Clientes</a></li>
              <li><a href=""><i class="fa fa-circle-o"></i> Productos</a></li>
          </ul>
        </li>
        <li class="treeview">
           <a href="#">
               <i class="fa fa-share-alt"></i> <span>Movimientos</span>
               <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
               </span>
           </a>
           <ul class="treeview-menu">
               <li><a href=""><i class="fa fa-circle-o"></i>Ventas</a></li>
           </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-print"></i> <span>Reportes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Categorias</a></li>
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Clientes</a></li>
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Productos</a></li>
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Ventas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user-circle-o"></i> <span>Administrador</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Tipo Documentos</a></li>
                            <li><a href="lista_usuarios.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
    <!-- /.sidebar -->
  </aside>
