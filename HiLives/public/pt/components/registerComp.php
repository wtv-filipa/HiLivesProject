<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">

            <div class="card o-hidden border-0 shadowCard my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <a href="../../../index.php"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="Logótipo do HiLives" title="Bem-vindo à HiLives!"></a>
                                    <h1 class="mb-4 weightTitle">Junte-se a nós!</h1>
                                </div>
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
                                    <!--PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Palavra-passe <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Crie a sua palavra-passe para o HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>

                                    <!--CONFIRM PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password_confirm">Verificar palavra-passe <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Repita a sua palavra-passe" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
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
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Registar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>

                                <div class="text-center textForm">
                                    <a class="small" title="Clica para te registares" href="login.php">Já está inscrito? Inicie sessão!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>