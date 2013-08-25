<div id="sidebar">
<?php
  if (is_active_sidebar('sidebar-1')) :
    dynamic_sidebar('sidebar-1');
  elseif (is_active_sidebar('sidebar-2')) :
    dynamic_sidebar('sidebar-2');
  else:
?>
  
<?php
  endif;
?>
</div>

