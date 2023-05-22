<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <?php
                  if($_SERVER['SERVER_NAME'] == 'app.mecadevelopment.com'){
                    echo '<div class="logo-src"><img src="public/images/logo_meca_name.png" height="50px" width="150px"></div>';
                  }else{
                    echo '<div class="logo-src"><img src="public/images/logo_AUDIOS_PRC.png" height="50px" width="150px"></div>';
                  }
                  ?>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper" title="<?=$_SESSION['name_cod_serv']?>">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn"><img width="42" class="rounded-circle" src="public/images/avatar.jpg" alt=""><i class="fa fa-angle-down ml-2 opacity-8"></i></a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="?view=usuarios&mode=account" tabindex="0" class="dropdown-item">Mi cuenta</a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="?view=session&mode=disconect" tabindex="0" class="dropdown-item">Salir</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?=$_SESSION['nombre'];?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?=$_SESSION['apellido'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div> 
       
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                        </button>
                    </span>
                </div>
            <!--FIN DE NAVBAR-->
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Llamadas</li>
                        <li><a href="?view=llamadas&mode=index" class="mm-active"><i class="metismenu-icon pe-7s-pen"></i>Buscar</a></li>
                        <?php 
                        if ($_SESSION['type_user'] == 1 OR $_SESSION['type_user'] == 4 OR $_SESSION['type_user'] == 5) {?>
                            <li class="app-sidebar__heading">Configuración</li>
                            <li><a href="#"><i class="metismenu-icon pe-7s-display2"></i>Usuarios</a>
                                <ul>
                                    <li><a href="?view=usuarios&mode=index"><i class="metismenu-icon"></i>Bandeja</a></li>
                                    <li><a href="?view=usuarios&mode=new"><i class="metismenu-icon"></i>Nuevo</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>