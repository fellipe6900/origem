<?php
if ($acao == 'inserir') {
    $action = 'acabamento/inserir';
    $titulo = 'Inserir Acabamento';
    $id = '';
    $acabamento = new Acabamento_m();
} elseif ($acao == 'editar') {
    $action = 'acabamento/editar';
    $titulo = 'Editar Acabamento';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php $this->load->view('_include/head', ['titulo' => $titulo]); ?>
    <body>
        <?php $this->load->view('_include/menu'); ?>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $titulo ?></h3>
                </div>
                <div class="panel-body">
                    <?= form_open($action, 'class="form-horizontal" role="form"') ?>
                    <!--ID-->
                    <?= form_hidden('id', $acabamento->id) ?>

                    <!--Nome-->
                    <div class="form-group">
                        <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-5">
                            <?= form_input('nome', $acabamento->nome, 'required id="nome" class="form-control" placeholder="Nome"') ?>
                        </div>
                    </div>
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-5">
                            <?= form_textarea('descricao', $acabamento->descricao, ' id="descricao" class="form-control" placeholder="Descricao"') ?>
                        </div>
                    </div>

                    <!--Valor-->
                    <div class="form-group">
                        <?= form_label('Valor: ', 'valor', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-5">
                            <input required step="0.01" min="0" value="<?= $acabamento->valor ?>" name="valor" type="number" class="form-control" placeholder="Valor" />
                        </div>
                    </div>

                    <!--Botoes-->
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-5">
                            <?= anchor(base_url('acabamento'), 'Cancelar', 'class="btn btn-default"') ?>
                            <?= form_submit('salvar', 'Salvar', 'class="btn btn-success"') ?>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <?php $this->load->view('_include/footer'); ?>
        </div>
    </body>
</html>