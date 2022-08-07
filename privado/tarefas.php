<?php
session_start();
include_once("layout/cabecalho.php");
include_once("layout/menu.php");
include_once("sentinela.php");
?>
<div class="tab-content w-100" id="v-pills-tabContent">
    <!-- Tarefas -->
    <div class="tab-pane fade <?php echo $homeDiv ?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
        <h1 class="display-4 fw-bolder text-center">Tarefas Pendentes</h1>
        <h3 class="fw-bolder text-center">Não exqueça!</h3>


        <ul class="list-group mt-3 w-50 mx-auto border border-dark">
            <?php
            $i = 0;
            $tarefaHome = 0;
            foreach ($tarefasUsuarioPend as $linha) {
                $tarefaHome = 1 + $i;
            ?>

                <li class=" list-group-item  ">
                    <div style="height: 100% !important;" class="row d-flex align-items-baseline">
                        <div class="col-3">
                            <?php echo $linha['tituloTarefa'] ?>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $tarefaHome ?>">
                                Descrição
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-<?php echo $tarefaHome ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel"> <?php echo $linha['tituloTarefa'] ?> </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-dark">
                                                <?php echo $linha['descricaoTarefa'] ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <?php echo $linha['dataLimite'] ?>
                        </div>
                        <div class="col-auto">
                            <a class="rounded-5 text-decoration-none btn btn-outline-success btn-sm concluir  fw-4" href="../src/crud/tarefa/concluir-tarefa.php?tab=home&id=<?php echo $linha['idTarefa'] ?>">
                                <i class="fa-solid fa-check"></i>
                            </a>
                        </div>
                    </div>
                </li>
            <?php $i++;
            } ?>
        </ul>


    </div>

    <!-- Gerenciar -->
    <div class="tab-pane fade <?php echo $gerenciarDiv ?> " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
        <div class="container d-flex align-items-baseline row">
            <!-- Gerenciar categorias -->
            <div class="bg-dark p-5  col-3 ms-5 pt-2 pb-2 mb-5 mt-3 rounded  ">
                <table class="table table-dark table-responsive">
                    <thead>
                        <th>
                            Minhas Categorias
                        </th>
                    </thead>
                    <tbody>
                        <?php foreach ($categoriasUsuario as $linha) { ?>
                            <tr>
                                <td>
                                    <?php echo $linha['nomeCategoria'] ?>
                                </td>
                                <td>
                                    <a class="text-white" href="?tab=gerenciar&update=<?php echo $linha['nomeCategoria'] ?>&idC=<?php echo $linha['idCategoria'] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="text-danger" href="../src/crud/categoria/deleta-categoria.php?id=<?php echo $linha['idCategoria'] ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <form class="mt-4" action="../src/crud/categoria/insere-atualiza-categoria.php" method="post">
                    <div class="form-floating  mb-3">
                        <input class="d-none" type="text" class="form-control" name="txtIdCategoria" value="<?php echo @$_GET['idC'] ?>">
                        <input class="d-none" type="text" class="form-control" name="txtUsuario" value="<?php echo $_SESSION['id'] ?>">
                        <input value="<?php echo @$_GET['update'] ?>" type="text" class="form-control" name="txtCategoria" id="txtCategoria" placeholder="Nova Categoria:">
                        <label for="txtCategoria">Nova categoria:</label>
                    </div>
                    <div class="mb-3">
                        <?php
                        if (isset($_GET['update'])) { ?>
                            <button class="btn btn-primary" type="submit">Atualizar</button>
                            <a class="btn btn-warning" href="?tab=gerenciar">Cancelar</a>
                        <?php } else {
                        ?>
                            <button class="btn btn-success" type="submit">Salvar</button>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <!-- Gerenciar tarefas -->

            <div class=" bg-dark p-5 col-8 ms-5 pt-2 pb-2 mt-3 mb-3 rounded">
                <table class="table table-responsive">
                    <thead>
                        <th class="text-white">
                            Tarefa
                        </th>
                        <th class="text-white">
                            Descrição
                        </th>
                        <th class="text-white">
                            Categoria
                        </th>
                        <th class="text-white">
                            Prazo
                        </th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $tarefaGerenc = 0;
                        foreach ($tarefasUsuario as $linha) {
                            $tarefaGerenc = 1 + $i;
                        ?>
                            <tr>
                                <td class="text-white">
                                    <?php echo $linha['tituloTarefa'] ?>
                                </td>
                                <td class="text-white">


                                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#mod-<?php echo $tarefaGerenc ?>">
                                        Abrir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="mod-<?php echo $tarefaGerenc ?>" tabindex="-1" aria-labelledby="mod" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="mod"> <?php echo $linha['tituloTarefa'] ?> </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-dark">
                                                        <?php echo $linha['descricaoTarefa'] ?>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </td>
                                <td class="text-white">
                                    <?php echo $linha['nomeCategoria'] ?>
                                </td>
                                <td class="text-white">
                                    <?php echo $linha['dataLimite'] ?>
                                </td>
                                <td class="text-white">
                                   
                                        <?php
                                        $status = $linha['statusTarefa'];
                                        if ($status == 1) { ?>
                                            <i class="fa-solid fa-check btn btn-light disabled btn-sm rounded-5"></i>
                                        <?php
                                        } else { ?>
                                            <i class="fa-solid fa-xmark btn btn-light disabled btn-sm rounded-5"></i>
                                        <?php
                                        }
                                        ?>
                                    

                                </td>
                                <td>
                                    <?php
                                    $idT = $linha['idTarefa'];
                                    $titulo = $linha['tituloTarefa'];
                                    $desc = $linha['descricaoTarefa'];
                                    $idC = $linha['idCategoria'];
                                    $dtLimite = $linha['dt'];
                                    $status = $linha['statusTarefa'];

                                    $titulo = urlencode($titulo);
                                    $desc = urlencode($desc);

                                    $url = "?tab=gerenciar&idT=" . $idT . "&titulo=" . $titulo . "&categoria=" . $idC . "&desc=" . $desc . "&dtLimite=" . $dtLimite . "&status=" . $status;
                                    ?>
                                    <a class="text-white" href="<?php echo $url ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="text-danger" href="../src/crud/tarefa/deleta-tarefa.php?tab=gerenciar&id=<?php echo $linha['idTarefa'] ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
                <form action="../src/crud/tarefa/insere-atualiza-tarefa.php" method="post">
                    <input class="d-none" type="text" name="txtIdUsuario" value="<?php echo $_SESSION['id'] ?>">
                    <input class="d-none" type="text" name="txtIdTarefa" value="<?php echo @$_GET['idT'] ?>">
                    <div class="form-floating  mb-3">
                        <input required maxlength="15" type="text" class="form-control" name="txtTitulo" id="txtTitulo" placeholder="Título da Tarefa:" value="<?php echo urldecode(@$_GET['titulo']) ?>">
                        <label>Título:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea required class="form-control" name="txtDescricao"><?php echo urldecode(@$_GET['desc']) ?></textarea>
                        <label>Descrição: </label>
                    </div>
                    <div class="form-floating mb-3 w-50">
                        <select required class="form-select" style="height: 60px;" name="txtIdCategoria" id="txtIdCategoria">
                            <option value="nulo">Selecione</option>
                            <?php
                            $sl = "";
                            $cat = @$_GET['categoria'];
                            foreach ($categoriasUsuario as $linha) {
                                if ($linha['idCategoria'] == $cat) {
                                    $sl = "selected";
                                } else {
                                    $sl = "";
                                }
                            ?>
                                <option class <?php echo $sl ?> value="<?php echo $linha['idCategoria'] ?>"><?php echo $linha['nomeCategoria'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label>Categoria:</label>
                    </div>
                    <div class="row">
                        <div class="form-floating  col-6 mb-3 w-25">
                            <input required type="date" class="form-control " value="<?php echo date('Y-m-d') ?>" name="dtOrigem">
                            <label class="p-3">Prazo inicial:</label>
                        </div>
                        <div class="form-floating  col-6 mb-3 w-25">
                            <input required type="date" class="form-control " name="dtLimite" value="<?php echo @$_GET['dtLimite'] ?>">
                            <label class="p-3">Prazo limite:</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3 w-25">
                        <select required class="form-select" name="status" id="status">
                            <option value="0">❌ Pendente </option>
                            <option value="1">✔ Finalizada </option>
                        </select>
                        <label>Status</label>
                    </div>
                    <div class="mb-3">
                        <?php
                        if (isset($_GET['idT'])) { ?>
                            <button class="btn btn-primary" type="submit">Atualizar</button>
                            <a class="btn btn-warning" href="?tab=gerenciar">Cancelar</a>
                        <?php } else {
                        ?>
                            <button class="btn btn-success" type="submit">Salvar</button>
                        <?php } ?>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <div class="tab-pane fade <?php echo $desempenhoDiv ?>" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">

    </div>
    <div class="tab-pane fade <?php echo $configDiv ?>" id="v-pills-config" role="tabpanel" aria-labelledby="v-pills-config-tab" tabindex="0">3</div>
</div>
</div>



<?php
include_once("layout/rodape.php")
?>