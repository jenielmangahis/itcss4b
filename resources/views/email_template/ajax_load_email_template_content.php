<?php 
if( $emailTemplate ){
  echo Form::textarea('content', $emailTemplate->content ,['id' => 'ckeditor', 'class' => 'form-control', 'required' => '']);
}else{
  echo Form::textarea('content', '' ,['id' => 'ckeditor', 'class' => 'form-control', 'required' => '']);
}
?>
<script>
  $(function () {   
    CKEDITOR.replace('ckeditor');
  });
</script>