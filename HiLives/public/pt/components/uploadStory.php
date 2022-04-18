<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="#">Histórias da HiLives</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar uma nova história à HiLives</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="paddingForms">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Carregar uma história</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="scripts/login.php">
                            <!--FILES-->
                            <div class="alert alert-warning mb-3" role="alert">
                                Insere um vídeo até 50MB.
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4, .jpg, .png" aria-required="true" required="required">
                                <label class="custom-file-label" for="fileToUpload">Escolher ficheiro</label>
                            </div>
                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Descrição <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Descreve a tua história" aria-required="true" required="required"></textarea>
                            </div>

                            <div class="form-group text-center mt-2">
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