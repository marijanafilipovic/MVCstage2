
<div class="login">
<div id="pretragainner"  class="search2" style="width:350px;">
    <p >
<form action="" method="POST" style=" padding-left:30px;">
<input style="margin: 0 auto; padding-left:50px;" type="text" name="value" placeholder="pronadjite sport"/>

<input style="margin: 0 auto;" type="submit" name="submit" value="pretrazi"/>
</form>
</p>
</div>
</div>

</div>
<div style="margin:0 auto; padding-left:60px;">
<?php
    if(isset($_POST['submit'])){
        $value=$_POST['value'];
        foreach($viewmodel as $sport) : ?>
            <div class="innerPopular">
                <p><?php echo $sport['sport']; ?></p>

                <? echo  "<a href='".  ROOT_URL ."shares/selectPost". $sport['sid'] ."'>";
                ?>
                <? echo
                    "<img src='".ROOT_PATH."img/" . $sport['sport'].".png'/></a>";
                ?>

            </div>
        <?php endforeach; }

    if(!isset($_POST['submit'])){
        foreach($viewmodel as $sp) : ?>
            <div class="innerPopular">
                <p><?php echo $sp['sport']; ?></p>

                <? echo  "<a href='".  ROOT_URL ."shares/selectPost". $sp['sid'] ."'>";
                ?>
                <? echo
                    "<img src='".ROOT_PATH."img/" . $sp['sport'].".png'/></a>";
                ?>

            </div>
        <?php endforeach; } ?>

</div>