<?php
$caminhoImagens = "../src/";
include_once("../src/models/Categoria.php");
include_once("../src/models/Tarefa.php");
$categoria = new Categoria();
$tarefa = new Tarefa();
$tarefasUsuario = $tarefa->listarPrivado($_SESSION['id']);
$tarefasUsuarioPend = $tarefa->listarPrivadoPend($_SESSION['id']);
$categoriasUsuario = $categoria->listarPrivado($_SESSION['id']);
$tab =  @$_GET['tab'];
$home = "";
$homeDiv = "";
$gerenciar = "";
$gerenciarDiv = "";
$desempenho = "";
$desempenhoDiv = "";
$config = "";
$configDiv = "";
switch ($tab) {
    case 'home':
        $home  = " active";
        $homeDiv = "show active";
        break;
    case 'gerenciar':
        $gerenciar  = " active";
        $gerenciarDiv = "show active";
        break;
    case 'desempenho':
        $desempenho  = " active";
        $desempenhoDiv = "show active";
        break;
    case '':
        $config  = " active";
        $configDiv = "show active";
        break;
}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>
    .fotoUsuario {
        background: url('<?php echo $caminhoImagens.$_SESSION['fotoUsuario'] ?>') no-repeat;
        background-size: cover;
        height: 200px;
        width: 200px;
        border-radius: 50%;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: white;
        color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
    }
</style>

<div class="d-flex align-items-start container-fluid">
    <div class="nav flex-column nav-pills p-3 d-flex align-items-center rounded-bottom bg-dark me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <div class="fotoUsuario border border-2"></div>
        <h2 class="text-white align-self-center"><?php echo $_SESSION['nome'] ?></h2>

        <button onclick="location.href='?tab=home'" onclick="location.href='?tab=home'" href="?tab=home" class="text-white mt-4 nav-link  <?php echo $home ?>" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <i class="fa-solid fa-list-check"></i> Tarefas
        </button>

        <button onclick="location.href='?tab=gerenciar'" onclick="location.href='?tab=home'" class="text-white nav-link <?php echo $gerenciar ?>" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            <i class="fa-solid fa-list"></i> Gerenciar
        </button>

        <button onclick="location.href='?tab=desempenho'" class="text-white nav-link <?php echo $desempenho ?>" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
            <i class="fa-solid fa-chart-line"></i> Desempenho
        </button>

        <button onclick="location.href='?tab=config'" class="text-white nav-link <?php echo $config ?>" id="v-pills-config-tab" data-bs-toggle="pill" data-bs-target="#v-pills-config" type="button" role="tab" aria-controls="v-pills-config" aria-selected="false">
            <i class="fa-solid fa-gear"></i> Configurações
        </button>

        <button onclick="location.href='../logout.php'" class="mt-3 btn btn-danger" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
            Sair
        </button>
    </div>