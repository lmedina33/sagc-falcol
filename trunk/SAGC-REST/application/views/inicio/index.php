<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="jarviswidget jarviswidget-sortable" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false" data-widget-custombutton="false" data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"><i class="fa fa-user"></i></span>
                    <h2>Turmas Ativas</h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>                                    
                                    <th>Codigo</th>
                                    <th>Nome</th>
                                    <th>Ano</th>
                                    <th>Inicio</th>
                                    <th>Termino</th>
                                    <th>Vagas</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($turmas as $turma): ?>
                                    <tr>
                                        <td><?= $turma->getCodigo(); ?></td>
                                        <td><?= $turma->getNome();?></td>                                        
                                        <td><?= $turma->getAno(); ?></td>  
                                        <td><?= dataObjectToStr($turma->getDataInicio(),false)?></td>
                                        <td><?= dataObjectToStr($turma->getDataTermino(),false)?></td>
                                        <td><?= count($turma->getAlunos())." / ".$turma->getVagas(); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-default" href="<?="#turmas/editar/{$turma->getId()}"?>">
                                                    <i class="fa fa-eye"></i> Visualizar
                                                </a>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>                                
                            </tbody>                            
                        </table>
                    </div>
                </div>
    </div>    
</section>