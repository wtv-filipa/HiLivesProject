<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="profile.php" title="Voltar à minha área">A minha área</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5 paddingForms">
        <div class="card-body p-0">
            <h1 class="text-center">Editar Perfil</h1>
            <hr>
            <div class="row">
                <!--PROFILE PICTURE-->
                <div class="col-xs-12 col-md-4 text-center">
                    <div class="pe-3">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                <label class="label" for="fileToUpload"><i class="fas fa-edit alignEditBtn"></i></label>
                                <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                            </div>
                            <img id="img_perf" class="image_profile" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="sem imagem de perfil" />
                        </div>
                        <div class="alert alert-warning mt-3" role="alert">
                            <span>Carregue no botão que está em cima da imagem para alterar a sua fotografia.</span>
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
                <!--OTHER INFOS-->
                <div class="col-xs-12 col-md-8">
                    <form method="post" role="form" id="register-form" action="scripts/login.php">
                        <p style="font-size: 14px; color: #005E89 !important;">* Preenchimento
                            obrigatório</p>
                        <!--NAME-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="username">Nome <span class="asterisk">*</span></label>
                            <div class="p-0 m-0">
                                <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Escreva aqui o nome da empresa" aria-required="true" required="required">
                            </div>
                        </div>
                        <!--EMAIL-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="email">Email <span class="asterisk">*</span></label>
                            <div class="p-0 m-0">
                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escreva aqui o email da empresa" aria-required="true" required="required" onchange="email_validate(this.value);">
                            </div>
                        </div>

                        <!--DATE OF BIRTH-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="data_nasc">Data de fundação <span class="asterisk">*</span></label>
                            <div class="p-0 m-0">
                                <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="data de nascimento" aria-required="true" required="required">
                            </div>
                        </div>

                        <!--MOBILE PHONE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="phone">Contacto telefónico <span class="asterisk">*</span></label>
                            <div class="p-0 m-0">
                                <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Escreve aqui o teu número de telemóvel" aria-required="true" required="required">
                            </div>
                        </div>

                        <!--COUNTRY-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="pais">Selecione o país da empresa <span class="asterisk">*</span></label>
                            <select class="form-select greyBorder" id="pais">
                                <option value="pt">Portugal</option>
                                <option value="es">Espanha</option>
                                <option value="be">Bélgica</option>
                                <option value="ic">Islândia</option>
                            </select>
                        </div>

                        <!--REGION-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="pais">Região da empresa <span class="asterisk">*</span></label>
                            <select class="form-select greyBorder" id="pais">
                                <option value="pt">Portugal</option>
                                <option value="es">Espanha</option>
                                <option value="be">Bélgica</option>
                                <option value="ic">Islândia</option>
                            </select>
                        </div>

                        <!--WEBSITE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="site">Website <span class="asterisk">*</span></label>
                            <div class="p-0 m-0">
                                <input type="text" class="form-control greyBorder" id="site" name="site" placeholder="Insira aqui o website da empresa" aria-required="true" required="required">
                            </div>
                        </div>

                        <!--FACEBOOK-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="face">Facebook </label>
                            <div class="p-0 m-0">
                                <input type="text" class="form-control greyBorder" id="face" name="face" placeholder="Insira aqui o Facebook da empresa">
                            </div>
                        </div>

                        <!--INSTAGRAM-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="insta">Instagram </label>
                            <div class="p-0 m-0">
                                <input type="text" class="form-control greyBorder" id="insta" name="insta" placeholder="Insira aqui o Instagram da empresa">
                            </div>
                        </div>

                        <!--DESCRIÇÃO-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="desc">Descrição <span class="asterisk">*</span></label>
                            <textarea class="form-control " id="exp_t" rows="5" name="desc" placeholder="Escreva aqui uma descrição" aria-required="true" required="required"></textarea>
                        </div>

                        <div class="form-group text-center mt-2">
                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>