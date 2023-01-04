<?php
if(!empty($_GET["ID"]))
{
    $ID=$VT->filter($_GET["ID"]);

    $veri=$VT->VeriGetir("kargolimit","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
    if($veri!=false)
    {

        $sil=$VT->SorguCalistir("DELETE FROM kargolimit","WHERE ID=?",array($ID),1);
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kargolimit-liste">
        <?php
    }
    else
    {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kargolimit-liste">
        <?php
    }


}
else
{
    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>">
    <?php
}
?>