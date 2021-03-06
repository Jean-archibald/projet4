<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
$chapterToDelete = "";

if ($id != 0)
{
    $chapterToDelete = $manager->getUnique($id);
    $chapterToDelete->setTrash('oui');
    $chapterToDelete->setPublish('non');
    if($chapterToDelete->isValid())
    {
        $manager->save($chapterToDelete);

        $message = '<p class="messageAvertissement">Le chapitre a bien été mis dans la Corbeille!</p>';
    }
    else
    {
        $errors = $chapterToModify->errors();
    }

    
}
$commentsInTrash = $managerComment->countTrash();
$elementsInTrash = $manager->countTrash();
?>

<?php
    if (isset($message))
    {
        echo $message, '<br />';
    }
?>
        

<p class="messageInfo">Il y a  <?= $elementsInTrash ?> chapitre(s) dans la corbeille </p>\<br/>
<table>
    <?php
    if ( $elementsInTrash != 0)
    {
        ?>
        <tr><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
        <?php

        foreach ($manager->getListInTrash() as $chapter)
        {
            echo '<tr><td>',
            $chapter->title(), '</td><td>',
            $chapter->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
            ($chapter->dateCreated() == $chapter->dateModified() ? '-' : $chapter->dateModified()->format('d/m/Y à H\hi')),'</td><td>
            <a href="chapitre-supprimer-', $chapter->id(), '">Supprimer</a>
            | <a href="republier-', $chapter->id(), '">Récuperer</a>
            </td></tr>', "\n";
        }
    }
    ?>
</table>

<br/><p class="messageInfo">Il y a  <?= $commentsInTrash ?> commentaire(s) dans la corbeille </p><br/>

<table>
    <?php
    if ( $commentsInTrash != 0)
    {
        ?>
    <tr><th>id</th><th>chapterId</th><th>Auteur</th><th>Contenu</th><th>Trash</th><th>Date</th><th>Action</th></tr>
    <?php
    foreach ($managerComment->getListTrash() as $comment)
        {
            echo '<tr><td>',
            $comment->id(), '</td><td>',
            $comment->chapterId(),'</td><td>',
            $comment->author(), '</td><td>',
            $comment->content(), '</td><td>',
            $comment->trash(), '</td><td>',
            $comment->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
            <a href="commentaire-supprimer-', $comment->id(), '">Supprimer</a>
            | <a href="recuperer-commentaire-', $comment->id(), '">Récuperer</a>
            </td></tr>', "\n";
        }
    }
    ?>
</table>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashView.php';
?>