<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content" id="criar">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo _l('agente_ia_builder_add'); ?>
                            <a href="#" class="btn btn-danger pull-right btnfechar" style="color:#fff"><i class="fas fa-times"></i></a>
                        </h4>
                        <hr>

                        <div class="row">
                            <!-- <div class="col-md-6"> -->
                                <?php echo form_open(admin_url('agente_ia/save'), ['id' => 'agente_ia_form']); ?>
                                    <?php echo form_hidden('id', $agente_ia->id ?? ''); ?>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo 'Agente'; ?></label>
                                            <?php echo form_dropdown('agente', $agentes, $agente_ia->agente ?? '', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- nome -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_name'); ?></label>
                                            <?php echo form_input('name', $agente_ia->name ?? '', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- descricao -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_description'); ?></label>
                                            <?php echo form_input('description', $agente_ia->description ?? '', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- modelo -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_model'); ?></label>
                                            <?php echo form_dropdown('modelo', $modelos, $agente_ia->modelo ?? '', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- atuacao -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_atuacao'); ?></label>
                                            <?php echo form_dropdown('atuacao', ['staff' => _l('Staff'), 'client' => _l('Client'), 'all' => _l('All')], $agente_ia->atuacao ?? 'all', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- max_tokens -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_max_tokens'); ?></label>
                                            <?php echo form_input('max_tokens', $agente_ia->max_tokens ?? 250, ['class' => 'form-control', 'type' => 'number', 'min' => 1, 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- temperature -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_temperature'); ?></label>
                                            <?php echo form_input('temperature', $agente_ia->temperature ?? 0.2, ['class' => 'form-control', 'type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 1, 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- token -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_token'); ?></label>
                                            <?php echo form_input('token', $agente_ia->token ?? '', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                    <!-- status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_status'); ?></label>
                                            <?php echo form_dropdown('status', ['active' => _l('Active'), 'inactive' => _l('Inactive')], $agente_ia->status ?? 'active', ['class' => 'form-control', 'required' => 'required']); ?>
                                        </div>
                                    </div>

                                     <!-- role -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_role'); ?></label>
                                            <?php echo form_input('role', $agente_ia->role ?? '', ['class' => 'form-control']); ?>
                                        </div>
                                    </div>

                                    <!-- content -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo _l('agente_ia_content'); ?></label>
                                            <?php echo form_textarea('content', $agente_ia->content ?? '', ['class' => 'form-control', 'rows' => 5]); ?>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary"><?php echo _l('agente_ia_save'); ?></button>
                                    </div>

                                <?php echo form_close(); ?>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo _l('agente_ia_builder_list'); ?>
                            <a href="#" class="btn btn-primary pull-right btncriar"><?php echo _l('agente_ia_builder_add'); ?></a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table dt-table dt-table-exists">
                                    <thead>
                                        <tr>
                                            <th><?php echo _l('agente_ia_name'); ?></th>
                                            <th><?php echo _l('agente_ia_description'); ?></th>
                                            <th><?php echo _l('agente_ia_agent'); ?></th>
                                            <th><?php echo _l('agente_ia_status'); ?></th>
                                            <th><?php echo _l('agente_ia_acoes'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($agente_ias as $agent) { ?>
                                            <tr>
                                                <td><?php echo $agent->name; ?></td>
                                                <td><?php echo $agent->description; ?></td>
                                                <td><?php echo $agent->agente; ?></td>
                                                <td><?php echo $agent->status == 'active' ? _l('Active') : _l('Inactive'); ?></td>
                                                <td>
                                                    <a href="<?php echo admin_url('agente_ia/edit/' . $agent->id); ?>" class="btn btn-success btn-icon"><i class="fa fa-edit"></i></a>
                                                    <a href="<?php echo admin_url('agente_ia/delete/' . $agent->id); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

<style>
td a{
    color: #fff !important;
}
</style>

<script>
/**discount_value apenas numero */
$(document).ready(function(){
    $('#criar').hide();

    $('.btncriar').on('click', function(){
        // $('#wrapper').hide();
        $('#criar').show();
    });

    $('.btnfechar').on('click', function(){
        $('#criar').hide();
    });
});
</script>
<?php
if(isset($edit)){
?>
<script>
$(document).ready(function(){
    $('#criar').show();
    $('.btnfechar').hide();
});
</script>
<?php
}