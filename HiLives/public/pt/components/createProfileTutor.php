<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeTutor.php">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="registerRequestsTutor.php">Pedidos de registo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Criar perfil</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5 paddingForms">
        <div class="card-body p-0">
            <h1 class="text-center">Criar Perfil</h1>
            <hr>
            <form class="ps-3" method="post" role="form" id="register-form" action="scripts/login.php">
                <p style="font-size: 14px; color: #005E89 !important;">* Preenchimento
                    obrigatório</p>

                <!--Escolaridade-->
                <div class="form-group pb-4">
                    <label class="boldFont mt-3 pb-2" for="esc">Escolaridade <span class="asterisk">*</span></label>
                    <select class="form-select greyBorder" id="esc">
                        <option value="pt">1º ciclo</option>
                        <option value="es">2º ciclo</option>
                        <option value="be">3º ciclo</option>
                        <option value="ic">Ensino secundário</option>
                    </select>
                </div>

                <!--AREAS-->
                <div class="form-group pb-4">
                    <label class="boldFont mt-3 pb-2" for="area">Áreas de interesse (para estudar ou trabalhar) <span class="asterisk">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </div>
                </div>

                <!--WORK EXPERIENCE-->
                <div class="form-group pb-4">
                    <label class="boldFont mt-3 pb-2" for="exp_t">Experiência de trabalho </label>
                    <textarea class="form-control " id="exp_t" rows="5" name="exp_t" placeholder="Escreva aqui sobre a experiência de trabalho que a Pessoa com DID tem"></textarea>
                </div>

                <!--CAPACITIES-->
                <div class="form-group pb-4">
                    <label class="boldFont mt-3 pb-2" for="capacity">As frases que melhor descrevem a Pessoa com DID (selecionar cinco ou mais frases) <span class="asterisk">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </div>
                </div>

                <!--WORK ENVIRONMENT-->
                <div class="form-group pb-4">
                    <div class="row">
                        <label class="boldFont mt-3 pb-2" for="environment">Ambientes de trabalho preferidos <span class="asterisk">*</span></label>
                        <div class="form-check col-xs-12 col-md-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check col-xs-12 col-md-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check col-xs-12 col-md-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check col-xs-12 col-md-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </div>
                </div>

                <!--WORK EXPERIENCE-->
                <div class="form-group pb-4">
                    <label class="boldFont mt-3 pb-2" for="def">O que mais pode dizer a Pessoa com DID sobre si </label>
                    <textarea class="form-control " id="def" rows="5" name="def" placeholder="Por exemplo: se tiver alguma necessidade pode indicar aqui (como necessidade de elevador e/ou rampas de acesso)."></textarea>
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