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
        <img class="imgProfile mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
        <h1 class="pb-2">Universidade de Aveiro</h1>
        <p>Região: Aveiro</p>
    </section>

    <section class="pb-5">
        <ul class="nav nav-tabs nav-fill profileTabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book align-middle" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                    </svg>
                    <span class="ps-2 align-middle">Cursos</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infos" type="button" role="tab" aria-controls="infos" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle align-middle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                    <span class="ps-2 align-middle">Informações</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat align-middle" viewBox="0 0 16 16">
                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                    </svg>
                    <span class="ps-2 align-middle">Contactos</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="stories-tab" data-bs-toggle="tab" data-bs-target="#stories" type="button" role="tab" aria-controls="stories" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video align-middle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z" />
                    </svg>
                    <span class="ps-2 align-middle">Histórias</span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!--COURSES-->
            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Direito, Ciências Sociais e Serviços</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-4">
                    <a href="uploadCourse.php">
                        <button class="btn buttonDesign buttonStudy buttonRegisterSizeHEI m-0">Adicionar novos cursos</button>
                    </a>
                </div>

            </div>

            <!--INFORMATIONS-->
            <div class="tab-pane fade" id="infos" role="tabpanel" aria-labelledby="infos-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0"><b>Tipo de instituição</b>: Pública</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                        <p class="mb-0"><b>Tipo de ensino</b>: Ensino Universitário</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0"><b>Morada</b>: Universidade de Aveiro, 3810-193 Aveiro</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--CONTACTS-->
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div class="row pt-4">
                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">
                                <i class="fa-solid fa-at align-middle"></i>
                                <b class="ps-2 align-middle">Email :</b>
                                <a class="linkContacts align-middle" title="Clicar para enviar e-mail para geral@ua.pt" href="mailto:geral@ua.pt">geral@ua.pt</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone align-middle" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                                <b class="ps-2 align-middle">Telefone :</b>
                                <a class="linkContacts align-middle" title="Clicar para telefonar para 234300200" href="tel:234300200">234300200</a>
                            </p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-md-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe align-middle" viewBox="0 0 16 16">
                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                                </svg>
                                <b class="ps-2 align-middle">Website :</b>
                                <a class="linkContacts align-middle" title="Clicar para visitar o website" href="https://www.oli-world.com/pt/" target="_blank">www.ua.pt</a>
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
                        <img class="img-content" src="https://www.tesla.com/sites/default/files/red-tesla-model-s.jpg" />
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>