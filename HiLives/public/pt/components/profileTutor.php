<div class="container">

    <div class="row">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">A minha área</li>
            </ol>
        </nav>

        <a class="mt-4 col-md-6 text-end buttonEdit" href="editProfile.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
            <span class="ps-2 align-middle textEdit">Editar Perfil</span>
        </a>
    </div>

    <section class="text-center pt-5 pb-3">
        <div class="col-12">
            <div class="pe-3">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                        <label class="label" for="fileToUpload"><i class="fas fa-edit mx-auto my-auto text-center"></i></label>
                        <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                    </div>
                    <img id="img_perf" class="imgProfile mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="sem imagem de perfil" />
                </div>
                <!----------------------MODAL DE CROP--------------->
                <div id="uploadimageModal" class="modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Importar e cortar a imagem de perfil</h4>
                                <button type="button" class="close" aria-label="Fechar" aria-hidden=true data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row mx-auto">
                                    <div class="col-12 text-center">
                                        <div id="image_demo" style="display:block; margin:auto;"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="buttonCustomise btn btn-primary crop_image" value="Upload Image" name="Submit"> Guardar </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <h1 class="pb-2">Ângelo Silva</h1>
        <p>Região: Aveiro</p>
    </section>

    <section class="pb-5">
        <hr>
        <form method="post" role="form" id="register-form" action="scripts/login.php">

            <!--NAME-->
            <div class="form-group pb-4">
                <label class="boldFont mt-3 pb-2" for="username">Nome</label>
                <div class="p-0 m-0">
                    <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Escreva aqui o nome da empresa" aria-required="true" required="required">
                </div>
            </div>
            <!--EMAIL-->
            <div class="form-group pb-4">
                <label class="boldFont mt-3 pb-2" for="email">Email</label>
                <div class="p-0 m-0">
                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escreva aqui o email da empresa" aria-required="true" required="required" onchange="email_validate(this.value);">
                </div>
            </div>
            <!--PASSWORD-->
            <div class="form-group pb-4">
                <label class="boldFont mt-3 pb-2" for="password">Palavra-passe </label>
                <div class="p-0 m-0">
                    <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Crie a sua palavra-passe para o HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                </div>
            </div>

            <!--CONFIRM PASSWORD-->
            <div class="form-group pb-4">
                <label class="boldFont mt-3 pb-2" for="password_confirm">Verificar palavra-passe </label>
                <div class="p-0 m-0">
                    <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Repita a sua palavra-passe" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>
            </div>

            <div class="form-group text-center mt-2">
                <div class="mx-auto col-sm-10 pb-3 pt-2">
                    <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize me-4">Guardar</button>
                    <button type="cancel" class="btn buttonDesign buttonCancel buttonLoginSize">Cancelar</button>
                </div>
            </div>
        </form>
    </section>

</div>