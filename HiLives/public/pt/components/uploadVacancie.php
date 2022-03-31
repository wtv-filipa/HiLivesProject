<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="#">Vagas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Carregar uma nova vaga</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Criar nova vaga</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="scripts/login.php">
                            <!--VACANCIE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nomevaga">Cargo na empresa <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nomevaga" name="nomevaga" placeholder="Insira o nome do cargo disponível." aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Descrição da vaga <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Insira um texto que descreva a vaga que está a anunciar." aria-required="true" required="required"></textarea>
                            </div>

                            <!--NUMBER OF VACANCIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="numvagas">Número de vagas disponíveis <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="numvagas" name="numvagas" placeholder="Insira o número de vagas disponíveis para o cargo." aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIRENMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Requisitos <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Insira um texto que descreva a vaga que está a anunciar." aria-required="true" required="required"></textarea>
                            </div>

                            <!--AREA-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Área <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="area" name="area" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <option value="pt">opção 1</option>
                                    <option value="es">opção 2</option>
                                    <option value="be">opção 3</option>
                                    <option value="ic">opção 4</option>
                                </select>
                            </div>
                            <!--WORK JOURNEY-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="jornada">Jornada de trabalho <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="jornada" name="jornada" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <option value="pt">opção 1</option>
                                    <option value="es">opção 2</option>
                                    <option value="be">opção 3</option>
                                    <option value="ic">opção 4</option>
                                </select>
                            </div>
                            <!--CAPACITIES-->
                            <div class="form-group pb-4">
                                <label class="label-margin" for="personality">Selecione cinco (5) capacidades necessárias <span class="asterisk">*</span></label>
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
                            <!--EDUCATION LEVEL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="educ">Nível de educação <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="educ" name="educ" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <option value="pt">opção 1</option>
                                    <option value="es">opção 2</option>
                                    <option value="be">opção 3</option>
                                    <option value="ic">opção 4</option>
                                </select>
                            </div>
                            <!--REGION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="regiao">Região da vaga <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao" required="required">
                                    <option value="pt">Portugal</option>
                                    <option value="es">Espanha</option>
                                    <option value="be">Bélgica</option>
                                    <option value="ic">Islândia</option>
                                </select>
                            </div>
                            <!--STORY VIDEO-->
                            <div class="alert alert-warning mb-3" role="alert">
                                Insere um vídeo até 50MB.
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4, .jpg, .png" aria-required="true" required="required">
                                <label class="custom-file-label" for="fileToUpload">Escolher ficheiro</label>
                            </div>

                            <div class="form-group text-center mt-4">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Adicionar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>