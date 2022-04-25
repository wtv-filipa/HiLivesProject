<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_SESSION["idUser"];

$query = "SELECT idareas, name_interested_area FROM areas";
$query2 = "SELECT idcourse_regime, name_regime FROM course_regime";
$query3 = "SELECT idaccommodation, name_accommodation FROM accommodation";

$query5 = "SELECT region_idregion, idregion, name_region FROM users_has_region
INNER JOIN region ON users_has_region.region_idregion = region.idregion
WHERE users_idusers = ?";
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Voltar aos meus cursos">Cursos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Carregar um novo curso</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["course"])) {
        $msg_show = true;
        switch ($_SESSION["course"]) {
            case 1:
                $message = "É necessário preencher todos os campos obrigatórios.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 2:
                $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["course"] = 0;
        }

        if ($msg_show == true) {
            echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                     <button type=\"button\" class=\"close\" data-bs-dismiss=\"alert\" aria-label=\"Close\">
                        <span title=\"Fechar\" aria-hidden=\"true\" style=\"position: absolute;
                         top: 0;
                         right: 0;
                         padding: 0.75rem 1.25rem;
                         color: inherit;\">&times;</span>
                    </button>
                </div>";
            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
        }
    }
    ?>

    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="paddingForms">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Criar novo curso</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourseHei.php?course=<?= $idUser ?>">
                            <!--COURSE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome">Nome do Curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Insira aqui o nome do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Breve descrição do curso <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Insira uma pequena descrição relativamente ao curso" aria-required="true" required="required"></textarea>
                            </div>

                            <!--WEBSITE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="website">Website <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Insira o link do website com informação do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FACEBOOK-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="facebook">Facebook </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Insira aqui o facebook do curso">
                                </div>
                            </div>

                            <!--INSTAGRAM-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="instagram">Instagram </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Insira aqui o instagram do curso">
                                </div>
                            </div>

                            <!--COURSE DIRECTOR-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="diretor">Diretor(a) do Curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Insira aqui o nome do diretor do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">Email do Curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Insira aqui o email que as pessoas podem contactar para esclarecer dúvidas do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--PHONE NUMBER-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="telefone">Telefone do curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Insira aqui o telefone que as pessoas podem contactar para esclarecer dúvidas do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REGION-->
                            <div class="form-group pb-4 formulario">
                                <label class="boldFont mt-3 pb-2" for="regiao">Selecione a região do curso <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao" aria-required="true" required="required">
                                    <option selected disabled>Selecione uma opção</option>
                                    <?php
                                    if (mysqli_stmt_prepare($stmt, $query5)) {
                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $region_idregion, $idregion, $name_region);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idregion\">$name_region</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Características gerais do Curso</h3>
                            <!----------->

                            <!--AREAS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Selecione as áreas científicas que se adequam ao Curso <span class="asteriskPink">*</span></label>
                                <div class="row ps-3">
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idareas, $name_interested_area);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<div class='form-check col-12 col-md-6'>
                                                    <input class='form-check-input' type='checkbox' name='area[]' value='$idareas' id='$idareas'>
                                                    <label class='form-check-label' for='$idareas'>
                                                        $name_interested_area
                                                     </label>
                                                </div>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!--DURATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="duracao">Duração do Curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Indique a duração prevista do curso (em semestres)" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--ECTCS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="ects">Créditos ECTS <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Indique o número de ECTS que os estudantes podem adquirir" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--COURSE REGIME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="regime">Regime <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query2)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idcourse_regime, $name_regime);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idcourse_regime\">$name_regime</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--LANGUAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="idioma">Idioma(s) de lecionação <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Insira o(s) idioma(s) em que o curso será lecionado" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FEE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="propina">Valor da propina <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Indique o valor da propina do curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CERTIFICATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="certificacao">Certificação de curso <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Indique o tipo de certificação que os estudantes irão obter ( se dão certificado, diploma ...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Destinatários e condições de admissão</h3>
                            <!----------->

                            <!--TARGET-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="destinatarios">Destinatários <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Indique a quem se destina o curso (todas as Pessoas com DID, a Pessoas com e sem DID, apenas a um grupo mais específico de DID...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VACANCIES AVAILABLE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vagas">Vagas disponíveis <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Indique o número de vagas anuais disponíveis para o Curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--STAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="periodo">Fase(s) de candidatura <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Indique em que datas podem ser realizadas as candidaturas aos cursos" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIREMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Requisitos <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Indique os requisitos que a pessoa deve cumprir para entrar no curso" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Detalhes do Curso</h3>
                            <!----------->

                            <!--CURRICULUM PLAN-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="curricular">Tipo de plano curricular <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Indique se é um Plano curricular com UCs para estudantes com DID e sem DID e/ou Plano curricular com UCs só para estudantes com DID (domínio académico e/ou domínio profissional)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VOCATIONAL DIMENSION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vocacional">Dimensão profissional <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Se o curso tem uma dimensão profissional ou se proporciona atividades do âmbito profissional. Se não existir, escreva: “Não existe esta dimensão no curso”" aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACTIVITIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="atividades">Atividades extracurriculares <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Se há atividades extracurriculares promovidas pela HE e/ou específicas para as pessoas com DID, bem como se estas atividades são obrigatórias ou não" aria-required="true" required="required"></textarea>
                            </div>

                            <!--SUPPORT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="apoios">Apoios <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Apoio ao nível académico, social, para uma vida independente (por exemplo: saber orientar-se) ou outro." aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACCOMMODATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="alojamento">Alojamento <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query3)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idaccommodation, $name_accommodation);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idaccommodation\">$name_accommodation</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group text-center mt-4">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Adicionar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>