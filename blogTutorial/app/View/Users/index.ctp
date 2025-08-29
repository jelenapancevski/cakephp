<h1>Blog users</h1>
<?php echo $this->Html->link("Register to the blog", array("controller" => "users", "action"=>"add")); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Role</th>
    </tr>
    <?php foreach($users as $user):?>
    <tr>
        <td> <?php echo $user['User']['id'];?></td>
        <td>
            <?php  
            echo $this->Html->link(
                $user['User']['username'],
                array("controller" => "users", "action" => "view", $user['User']['id'])
            ); 
        ?>
        </td>
        <td> <?php echo $user['User']['role'];?></td>
        <?php  if ($this->Session->read("Auth.User.id") === $user["User"]["id"]): ?>
        <td> <?php echo $this->Html->link("Edit", array("controller"=>"users", "action"=>"edit", $user["User"]["id"]))?></td>
        <td> <?php echo $this->Form->postLink("Delete", array("controller"=>"users", "action"=>"delete", $user["User"]["id"]), array('confirm'=>'Are you sure?'))?></td>

        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    <?php unset($user);?>
</table>