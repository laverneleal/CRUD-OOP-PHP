<?php 
    include 'database.class.php';
    $conn = new database();

    $msg = '';
    // Check if POST data is not empty
    if (!empty($_POST)) {
        $conn->insert( 'contacts', $_POST );
        $msg = 'Created Successfully!';
    }

?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Create');

?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>

        <select name="title" id="title">
            <option value=""></option>
            <option value="Manager">Manager <i class="fa fa-caret-down" aria-hidden="true"></i></option>
            <option value="Supervisor">Supervisor</option>
            <option value="Team Head">Team Head</option>
            <option value="Member">Member</option>
        </select>

        <div class="input-group">
            <input type="datetime-local" name="created" type="text" readonly="readonly" id="created"/>
            <span class="btn btn-default" style="padding: 11px 10px; margin-left:-25px; margin-top:-5px"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<?php $template->template_footer('Copyright &copy; 2016 Your Company'); ?>


