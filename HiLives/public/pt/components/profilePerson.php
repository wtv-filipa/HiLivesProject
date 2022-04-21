<div class="container">

    <div class="row">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">A minha área</li>
            </ol>
        </nav>

        <a class="marginButtonProfile col-md-6 text-sm-start text-md-end buttonEdit" href="editProfile.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
            <span class="ps-2 align-middle textEdit">Editar Perfil</span>
        </a>
    </div>

    <section class="text-center pt-5 pb-3">
        <img class="imgProfile mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
        <h1 class="pb-2">Filipa Ferreira</h1>
        <p>Regiões de interesse: Aveiro, Coimbra</p>
    </section>

    <section class="pb-5">
        <ul class="nav nav-tabs nav-fill profileTabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="studies-tab" data-bs-toggle="tab" data-bs-target="#studies" type="button" role="tab" aria-controls="studies" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard align-middle" viewBox="0 0 16 16">
                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Estudos</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="areas-tab" data-bs-toggle="tab" data-bs-target="#areas" type="button" role="tab" aria-controls="areas" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal align-middle" viewBox="0 0 16 16">
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Áreas</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab" aria-controls="skills" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check align-middle" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Competências</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="env-tab" data-bs-toggle="tab" data-bs-target="#env" type="button" role="tab" aria-controls="env" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building align-middle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                        <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                    </svg>
                    <span class="ps-2 align-middle textHideSmall">Ambientes</span>
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
            <!--STUDY-->
            <div class="tab-pane fade show active" id="studies" role="tabpanel" aria-labelledby="studies-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Universidade de Aveiro</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Universidade de Aveiro</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsBigger">
                            <h5>Novas Tecnologias da Comunicação</h5>
                            <p class="cardInfo14 mb-2">Universidade de Aveiro</p>
                            <p class="cardInfo13 mb-0">2020-06-25</p>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-4">
                    <a href="uploadCourse.php" title="Adicionar um curso ou unidade curricular">
                        <button class="btn buttonDesign buttonStudy buttonRegisterSizeHEI m-0">Adicionar novos estudos</button>
                    </a>
                </div>

            </div>

            <!--AREAS-->
            <div class="tab-pane fade" id="areas" role="tabpanel" aria-labelledby="areas-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">Informática</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">Informática</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsStudy itemsSmaller">
                            <p class="mb-0">Informática</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--SKILLS-->
            <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Eu consigo participar em atividades de grupo.</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Eu consigo participar em atividades de grupo.</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Eu consigo participar em atividades de grupo.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--ENVIRONMENTS-->
            <div class="tab-pane fade" id="env" role="tabpanel" aria-labelledby="env-tab">
                <div class="row pt-4">
                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Escritório</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Biblioteca</p>
                        </div>
                    </div>

                    <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                        <div class="items itemsWork itemsSmaller">
                            <p class="mb-0">Piscinas</p>
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