
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
            <a title="Cadastrar novo usuário" href="<?php echo base_url('usuarios/add')?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-plus"></i>&nbsp; Novo</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>Login</th>
                    <th>Perfil</th>
                    <th class="text-center">Ativo</th>
                    <th class="text-right ">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  
                    <?php
                      foreach($usuarios as $linha){
                    ?>
                      <tr>
                        <td><?php echo $linha->id?></td>
                        <td><?php echo $linha->username?></td>
                        <td><?php echo $linha->email?></td>
                        <td><?php echo ($this->ion_auth->is_admin($linha->id) ? 'Administrador' : 'Aluno') ?></td>
                        <td class="text-center pr-4"><?php echo ($linha->active == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>')?></td>
                        <td class="text-right" >
                            <a title='Vincular Matérias' href='<?php echo base_url('usuarios/vincular_materia_usuario/'.$linha->id); ?>' class='btn btn-sm btn-success'><i class='fas fa-plus'></i>&nbsp;Matérias</a>
                            <a title="Editar" href="<?php echo base_url('usuarios/edit/'.$linha->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i>&nbsp;Editar</a>
                            <a title="Excluir" href="<?php echo base_url('usuarios/del/'.$linha->id); ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i>&nbsp;Excluir</a>
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

