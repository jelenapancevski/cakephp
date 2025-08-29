<h1>Blog posts</h1>
<?php 
echo $this->Html->link('Add Post', array('controller' => 'posts', 'action'=> 'add'));
?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>
    <?php foreach ($posts as $post):?>
    <tr>
        <td><?php echo $post['Post']['id'];?></td>
        <td><?php echo
            $this->Html->link( $post['Post']['title'], array('controller'=> 'posts', 'action' => 'view', $post['Post']['id']));
        ?></td>
        <td><?php echo $post['Post']['created']; ?></td>
        <?php if ($this->Session->read('Auth.User.id') == $post['Post']['user_id']):?>
        <td>
            <?php
            echo $this->Html->link('Edit', array('action'=>'edit', $post['Post']['id']));
            ?>
        </td>
        <td>
            <?php
            echo $this->Form->postLink('Delete', array(
                'action'=>'delete',
                $post['Post']['id']
            ),
            array('confirm'=>'Are you sure?'))
            ?>
        </td>
        <?php endif;?>
    </tr>
    <?php endforeach; ?>
    <?php unset($post);?> <!-- clear data, delete post variable  -->
</table>