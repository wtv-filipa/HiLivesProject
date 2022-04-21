<div class="container">

    <div class="row">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">A minha área</li>
            </ol>
        </nav>

        <a class="marginButtonProfile col-md-6 text-sm-start text-md-end buttonEdit" href="editProfile.php" title="Editar o perfil">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
            <span class="ps-2 align-middle textEdit">Editar Perfil</span>
        </a>
    </div>

    <section class="text-center pt-5 pb-3">
        <img class="imgProfile mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
        <h1 class="pb-2">OLI - Sistemas Sanitários, SA</h1>
        <p>Região: Aveiro</p>
    </section>

    <section class="pb-5">
        <ul class="nav nav-tabs nav-fill profileTabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="vacancies-tab" data-bs-toggle="tab" data-bs-target="#vacancies" type="button" role="tab" aria-controls="vacancies" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase align-middle" viewBox="0 0 16 16">
                        <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Vagas</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat align-middle" viewBox="0 0 16 16">
                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Contactos</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="stories-tab" data-bs-toggle="tab" data-bs-target="#stories" type="button" role="tab" aria-controls="stories" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video align-middle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Histórias</span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--Vacancies-->
            <div class="tab-pane fade show active" id="vacancies" role="tabpanel" aria-labelledby="vacancies-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsBigger">
                            <h5>Operador/a de Armazém M/F</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsBigger">
                            <h5>Operador/a de Armazém M/F</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsBigger">
                            <h5>Operador/a de Armazém M/F</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-4">
                    <a href="uploadVacancy.php" title="Adicionar novas vagas">
                        <button class="btn buttonDesign buttonWork buttonRegisterSizeHEI m-0">Adicionar novas vagas</button>
                    </a>
                </div>

            </div>

            <!--Contacts-->
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">
                                <i class="fa-solid fa-at align-middle"></i>
                                <b class="ps-2 align-middle">Email :</b>
                                <a class="linkContacts align-middle" title="Clicar para enviar e-mail para geral@oli-world.pt" href="mailto:geral@oli-world.pt">geral@oli-world.pt</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone align-middle" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                                <b class="ps-2 align-middle">Telefone :</b>
                                <a class="linkContacts align-middle" title="Clicar para telefonar para 234300200" href="tel:234300200">234300200</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe align-middle" viewBox="0 0 16 16">
                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                                </svg>
                                <b class="ps-2 align-middle">Website :</b>
                                <a class="linkContacts align-middle" title="Clicar para visitar o website" href="https://www.oli-world.com/pt/" target="_blank">www.oli-world.com/pt/</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook align-middle" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                                <b class="ps-2 align-middle">Facebook :</b>
                                <a class="linkContacts align-middle" title="Clicar para visitar o Facebook" href="https://www.facebook.com/OLI.inspiredbywater/"> @OLI.inspiredbywater</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram align-middle" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg>
                                <b class="ps-2 align-middle">Instagram :</b>
                                <a class="linkContacts align-middle" title="Clicar para visitar o Instagram" href="https://www.instagram.com/oli.inspiredbywater/">@oli.inspiredbywater</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--STORIES-->
            <div class="tab-pane fade" id="stories" role="tabpanel" aria-labelledby="stories-tab">
                <!--Video-->
                <div class="wrapperStory">
                    <header class="cf">
                        <a href="#">
                            <img class="profile-pic" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                        </a>
                        <h5 class="name">
                            <a href="#" class="linkStory">Filipa Ferreira</a>
                        </h5>
                        <p class="cardInfo13">A 15 de Fevereiro</p>
                    </header>
                    <p class="status">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget nunc a ante pharetra placerat. Curabitur viverra neque sit amet interdum commodo.</p>
                    <div class="text-center videoStory">
                        <video width="600" controls>
                            <source src="mov_bbb.mp4" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>

                <!--Text-->
                <div class="wrapperStory">
                    <header class="cf">
                        <a href=#>
                            <img class="profile-pic" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                        </a>
                        <h5 class="name">
                            <a href="#" class="linkStory">Filipa Ferreira</a>
                        </h5>
                        <p class="cardInfo13">A 15 de Fevereiro</p>
                    </header>
                    <p class="status">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget nunc a ante pharetra placerat. Curabitur viverra neque sit amet interdum commodo. Sed ultrices vitae nunc pharetra rutrum. In at dictum tortor. Nulla condimentum tellus laoreet elit fermentum, scelerisque tempus tortor congue. Integer varius vulputate volutpat. Cras non augue congue purus consectetur pellentesque sit amet ut leo. Donec lacinia id ante a congue. Aliquam erat volutpat. Nullam ante nibh, faucibus ac scelerisque id, rhoncus sit amet nunc. Maecenas mollis ipsum eu dolor sollicitudin aliquet nec non est. Mauris quis molestie lacus, ac ornare neque. Integer accumsan id nisl id tincidunt. Maecenas cursus purus dui, eu dignissim nisi faucibus eget.</p>
                </div>

                <!--Audio-->
                <div class="wrapperStory">
                    <header class="cf">
                        <a href=#>
                            <img class="profile-pic" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                        </a>
                        <h5 class="name">
                            <a href="#" class="linkStory">Filipa Ferreira</a>
                        </h5>
                        <p class="cardInfo13">A 15 de Fevereiro</p>
                    </header>
                    <p class="status">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget nunc a ante pharetra placerat. Curabitur viverra neque sit amet interdum commodo.</p>
                    <div class="text-center">
                        <audio controls>
                            <source src="horse.ogg" type="audio/ogg">
                            <source src="horse.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>

                <!--Image-->
                <div class="wrapperStory">
                    <header class="cf">
                        <a href=#>
                            <img class="profile-pic" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                        </a>
                        <h5 class="name">
                            <a href="#" class="linkStory">Filipa Ferreira</a>
                        </h5>
                        <p class="cardInfo13">A 15 de Fevereiro</p>
                    </header>
                    <p class="status">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget nunc a ante pharetra placerat. Curabitur viverra neque sit amet interdum commodo.</p>
                    <div class="text-center">
                        <img class="img-content img-fluid" src="https://www.tesla.com/sites/default/files/red-tesla-model-s.jpg" />
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>