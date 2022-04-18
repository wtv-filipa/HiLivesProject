<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="profile.php">A minha área</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar uma Unidade Curricular ou Curso feito</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="paddingForms">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Editar a Unidade Curricular ou Curso feito</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="scripts/login.php">
                            <!--NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nomeuc">Nome da Unidade Curricular ou Curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nomeuc" name="nomeuc" placeholder="Escreve aqui o nome da Unidade Curricular/ Curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--HEIS MADE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="uniuc">Instituição de Ensino Superior onde foi feita <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="uniuc" name="uniuc" placeholder="Escreve aqui o nome da Instituição de Ensino Superior onde concluíste a Unidade Curricular ou o Curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CONCLUSION DATE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="data">Data de conclusão <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="date" class="form-control greyBorder" id="data" name="data" placeholder="Escreve aqui o nome da Unidade Curricular/ Curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <div class="form-group text-center mt-2">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>