<?php echo $this->Html->script(array('jquery.validate.min', 'jquery-form.min')); ?>
<?php echo $this->fetch('script'); ?>

<script>
    $().ready(function() {
          $("#submit-indicator").hide();
            $("#submit_id").click(function(){
             if($('#CustomerFeedbackQuestionApproveForm').valid()){
                 $("#submit_id").prop("disabled",true);
                 $("#submit-indicator").show();
		 $("#CustomerFeedbackQuestionApproveForm").submit();
             }

        });
        $('#CustomerFeedbackQuestionApproveForm').validate();
    });
</script>

<div id="customerFeedbackQuestions_ajax">
    <?php echo $this->Session->flash(); ?>
    <div class="nav panel panel-default">
        <div class="customerFeedbackQuestions form col-md-8">
            <h4><?php echo $this->element('breadcrumbs') . __('Approve Customer Feedback Question'); ?>
                <?php echo $this->Html->link(__('List'), array('action' => 'index'), array('id' => 'list', 'class' => 'label btn-info')); ?>

            </h4>
            <?php echo $this->Form->create('CustomerFeedbackQuestion', array('role' => 'form', 'class' => 'form')); ?>
            <?php echo $this->Form->input('id'); ?>
            <div class="row">
                <div class="col-md-12"><?php echo $this->Form->input('title', array('label' => 'Question')); ?></div>
            </div>
            <?php
                if ($showApprovals && $showApprovals['show_panel'] == true) {
                    echo $this->element('approval_form');
                } else {
                    echo $this->Form->input('publish');
                }
            ?>
            <?php echo $this->Form->submit('Submit', array('div' => false, 'class' => 'btn btn-primary btn-success','id'=>'submit_id')); ?>
             <?php echo $this->Html->image('indicator.gif', array('id' => 'submit-indicator')); ?>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
<script> $("[name*='date']").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
    });
</script>
        <div class="col-md-4">
            <p><?php echo $this->element('helps'); ?></p>
        </div>
    </div>
    <?php $this->Js->get('#list'); ?>
    <?php echo $this->Js->event('click', $this->Js->request(array('action' => 'index', 'ajax'), array('async' => true, 'update' => '#customerFeedbackQuestions_ajax'))); ?>
    <?php echo $this->Js->writeBuffer(); ?>
</div>