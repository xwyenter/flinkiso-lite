<?php echo "<h4>&nbsp;&nbsp;" . __("Evidence Files ") . ucwords($this->request->params['pass'][0])."</h4>"; ?>
<table class="table table-striped table-hover table-bordered table-responsive ">
	<tr>
		<th>File Name</th>
		<th>Version</th>
		<th>Comment</th>
		<th>By</th>
        <th>Created</th>  
        <th>Prepared By</th>  
        <th>Approved By</th>     
                             
		<th>Edit</th>                
	</tr>        
<?php foreach($files as $file):
	if($file['FileUpload']['file_status'] == 0)echo "<tr class='danger text-danger'>";
	else echo "<tr>";
	$webroot = "/ajax_multi_upload";
	$fullPath = WWW_ROOT . DS. '/files/'.$this->Session->read('User.company_id').'/'.$file['FileUpload']['file_dir'];
	$displayPath = '/files/'.$this->Session->read('User.company_id').'/'.$file['FileUpload']['file_dir'];
	$baseEncFile = base64_encode($fullPath);
	$delUrl = "$webroot/file_uploads/delete//$baseEncFile/";
?>
        <td><?php echo $this->Html->image('../ajax_multi_upload/img/fileicons/'.$file['FileUpload']['file_type'].'.png'); ?> 
        <?php 
				if($file['FileUpload']['file_status'] == 1)echo $this->Html->link($file['FileUpload']['file_details'].'.'.$file['FileUpload']['file_type'],$displayPath,array('target'=>'_blank','escape'=>TRUE)); 
				else echo "<s>".$file['FileUpload']['file_details'].'.'.$file['FileUpload']['file_type']."</s>";		
		?></td>              
        <td><?php echo $file['FileUpload']['version']; ?></td>
        <td><?php echo $file['FileUpload']['comment']; ?></td> 
        <td><?php echo $file['CreatedBy']['name']; ?></td>  
		<td><?php echo $file['PreparedBy']['name']; ?></td>  
		<td><?php echo $file['ApprovedBy']['name']; ?></td>  
        <td>
        <?php
            if($file['FileUpload']['file_status'] == 0)echo "Deleted ". $this->Time->niceShort($file['FileUpload']['created']);
            else echo $this->Time->niceShort($file['FileUpload']['modified']);
        ?>
        </td>                                       
        <td>
        <?php 
            if($file['FileUpload']['file_status'] == 1){
                echo $this->Html->link('Edit',array('controller'=>'file_uploads','action'=>'edit',$file['FileUpload']['id'],$this->request->params['controller'],$this->request->params['pass'][0],$file['FileUpload']['record']),array('class'=>'badge btn-warning')); 
                echo $this->Html->link($this->Html->image('../ajax_multi_upload/img/delete.png'),$delUrl,array('escape'=>FALSE));
            }else {
                echo $this->Html->link('Delete',array('controller'=>'file_uploads','action'=>'delete',$file['FileUpload']['id'],$this->request->params['controller'],$this->request->params['pass'][0],$file['FileUpload']['record']),array('class'=>'badge btn-danger')); 
            }
        ?></td>                
    </tr>
<?php endforeach; ?>
</table>
<?php echo $this->Form->create('Upload', array('role' => 'form', 'class' => 'form')); ?>
<fieldset>
    <?php
        echo $this->Upload->edit('upload', $this->request->params['pass'][2] . '/products/' . $this->request->params['pass'][1] . '/' . $this->request->params['pass'][0]);
        echo $this->Form->end();
    ?>
</fieldset>