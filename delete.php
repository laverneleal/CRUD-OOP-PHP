<?php

include 'database.class.php';
$conn = new database();

$msg = '';

if (isset($_GET['id'])) {
    $contact = $conn->displayRecord('contacts', $_GET['id'] );
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $conn->delete( 'contacts', $_GET['id'] );
            $msg = 'Created Successfully!';
            header('Location: read.php');
            exit;
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }   

}

?>

<?php
    include 'template.class.php';
    $template = new template();
    $template->template_header('Create');
?>

<div class="content delete">
	<h2>Delete Contact #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?php $template->template_footer('Copyright &copy; 2016 Your Company'); ?>