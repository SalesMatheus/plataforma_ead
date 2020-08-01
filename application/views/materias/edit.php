
    <?php $this->load->view('layout/sidebar'); ?>


      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

 
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('materias')?>">Matérias Cadastradas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
          </ol>
        </nav>

        <!-- DataTales -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <a title="Voltar" href="<?php echo base_url('materias')?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
          </div>
          <div class="card-body">
            <form method="POST" name="form_edit">
              <div class="form-group row">
                <div class="col-md-4">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="materia_nome" placeholder="Digite o nome da matéria" value="<?php echo $materia->materia_nome?>">
                  <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>'); ?>
                </div>
                <div class="col-md-4">
                    <label>Ativo</label>
                    <select class="form-control" name="materia_ativa">
                      <option value="0" <?php echo ($materia->materia_ativa == 0) ? 'selected' : ''?>>Não</option>
                      <option value="1" <?php echo ($materia->materia_ativa == 1) ? 'selected' : ''?>>Sim</option>
                    </select>
                </div>
              </div>
              <input type="hidden" name="materias_id" value="<?php echo $materia->materia_id?>">
              <button type="submit" class="btn btn-primary float-right">Confirmar</button>
            </form>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

