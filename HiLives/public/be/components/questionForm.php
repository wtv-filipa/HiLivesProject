<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php" title="Terug naar Startpagina"> Startpagina</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>
    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="paddingForms">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Twijfel/Suggestie</h1>
                            <p class="mt-5">Als je een vraag of suggestie hebt, stuur ons dan een bericht! Wij geven u graag
                                antwoorden!</p>
                        </div>
                        <form method="post" role="form" id="register-form" action="scripts/login.php">
                            <!--NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome_user">Naam <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome_user" name="nome_user" placeholder="Schrijf hier uw naam" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">E-mail <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Schrijf hier uw e-mail" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--TEXT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Twijfel/Suggestie <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Schrijf hier wat is uw vraag / suggestie" aria-required="true" required="required"></textarea>
                            </div>

                            <div class="form-group text-center mt-2">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Verzenden</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>