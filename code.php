<?php
require_once 'lib/config.php';
include_once 'header.php';
$c = new \Ss\User\Invite();
?>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <div class="row center">
            <h5>Invitation code real-time refresh.</h5>
            <h5>If you encounter no invitation code, please find the user has been registered to obtain.</h5>
			<h5>Click the invitation code can be directly entered the registration.</h5>
        </div>
    </div>
</div>


<div class="container">
    <div class="section"> 
        <!--   Icon Section   -->
        <div class="row">
            <div class="row marketing">
                <h2 class="sub-header">邀请码</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>###</th>
                            <th>邀请码</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $datas = $c->CodeArray(); 
                        foreach($datas as $data ){
                            ?>
                            <tr>
                                <td><?php echo $data['id'];?></td>
                                <td><a href="user/register.php?code=<?php echo $data['code'];?>"><?php echo $data['code'];?></a></td>
                                <td>可用</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>  
</div>
<?php  include_once 'ana.php';
include_once 'footer.php';?>
