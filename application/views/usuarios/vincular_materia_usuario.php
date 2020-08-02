
<?php $this->load->view('layout/sidebar'); ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">


            <div class="card-body">

                <form class="user" method="POST" name="form_add">

                    <fieldset class="mt-4 border p-2">
                        <legend class="font-small"><i class="fab fa-product-hunt"></i>&nbsp;Dados principais</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Nome Aluno</label>
                                <input type="text" class="form-control form-control-user" name="first_name" value="<?php echo $usuario->first_name;?>" readonly="">
                                <input type="hidden" name="user_id" value="<?php echo $usuario->id?>">
                            </div>              
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Matéria</label>
                                <select class="browser-default custom-select" name="materia_id">
                                    <?php foreach ($materias as $linha): ?>
                                        <option value="<?php echo $linha->materia_id ?>"><?php echo $linha->materia_nome; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" style="margin-right: 10px;"class="btn btn-primary btn-sm float-right">Confirmar</button>
                        <a title="Voltar" href="<?php echo base_url('usuarios')?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
                    </fieldset>

                </form>

            </div>
        </div>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Matéria</th>
                            <th class="text-center">Ativo</th>
                            <th class="text-right ">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($materias_usuario as $linha){
                        ?>
                                <tr>
                                    <td><?php echo $linha->id?></td>
                                    <td><?php echo $linha->materia_nome?></td>
                                    <td class="text-center pr-4"><?php echo ($linha->materia_ativa == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>')?></td>
                                    <td class="text-right" >
                                        <a title="Excluir" href="<?php echo base_url('usuarios/del_materias_usuario/'.$linha->id.'/'.$usuario->id); ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i>&nbsp;Excluir</a>
                                    </td>
                                </tr>
                        <?php    
                            }
                        ?>
                    </tbody>
                </table>
                </tbody>
              </table>
            </div>
          </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

