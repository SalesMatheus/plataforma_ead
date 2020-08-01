
    <?php $this->load->view('layout/sidebar'); ?>


      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

 
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
          </ol>
        </nav>

        <?php if($message = $this->session->flashdata('sucesso')):?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $message?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        <?php endif;?>

        <?php if($message = $this->session->flashdata('error')):?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $message?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        <?php endif;?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <a title="Cadastrar novo usuário" href="<?php echo base_url('materias/add')?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp; Novo</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nome da Matéria</th>
                    <th class="text-center">Ativo</th>
                    <th class="text-right ">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  
                    <?php
                      foreach($materias as $linha){
                    ?>
                      <tr>
                        <td><?php echo $linha->materia_id?></td>
                        <td><?php echo $linha->materia_nome?></td>
                        <td class="text-center pr-4"><?php echo ($linha->materia_ativa == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>')?></td>
                        <td class="text-right" >
                            <a title="Editar" href="<?php echo base_url('materias/edit/'.$linha->materia_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Editar</a>
                            <a title="Excluir" href="<?php echo base_url('materias/del/'.$linha->materia_id); ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i>&nbsp;Excluir</a>
                        </td>
                      </tr>
                    <?php    
                      }
                    ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

