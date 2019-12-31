<div>
<?php
    foreach($this->tasks as $key => $task)
    {
?>
<ul>
    <li><p><?php  echo $task->nombre ?></p>	</li>
    <li><img src="/images/<?php echo $task->imagen?>" alt=""></li>
</ul>
    

<?php
} ?>
</div>