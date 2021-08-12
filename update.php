<?php 

    include 'database.class.php';
    $conn = new database();


    $msg = '';
    if (isset($_GET['id'])) {
        if (!empty($_POST)) {
            $conn->update( 'contacts', $_POST );
            $msg = 'Created Successfully!';
        }
        $contact = $conn->displayRecord('contacts', $_GET['id'] );
    }else{
        $msg = "Update Failed!";
    }

?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Create');

?>

<div class="content update">
	<h2>Update Contact #<?=$_GET['id']?></h2>
    <form action="update.php?id=<?=$_GET['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$_GET['id']?>" id="id">
        <input type="text" name="name" placeholder="" value="<?=$contact['name']?>" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="" value="<?=$contact['email']?>" id="email">
        <input type="text" name="phone" placeholder="" value="<?=$contact['phone']?>" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <select name="title" id="title">
            <option value="<?=$contact['title']?>"><?=$contact['title']?></option>
            <option value="Manager">Manager <i class="fa fa-caret-down" aria-hidden="true"></i></option>
            <option value="Supervisor">Supervisor</option>
            <option value="Team Head">Team Head</option>
            <option value="Member">Member</option>
        </select>
        <div class="input-group">
            <input type="datetime-local" name="created" type="text" value="<?=$contact['created']?>" readonly="readonly" id="created"/>
            <span class="btn btn-default" style="padding: 11px 10px; margin-left:-25px; margin-top:-5px"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?php $template->template_footer('Copyright &copy; 2016 Your Company'); ?>

