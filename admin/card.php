<?php
require_once '_main.php';

$invite = new \Ss\User\Invite($uid);
$code = $invite->CodeArray();
?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                生成充值卡
                <small>Generate Cards</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">生成充值卡</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="card_add_do.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="cate_title">充值卡前缀</label>
                                    <input  class="form-control" name="card_sub" placeholder="小于8个字符"  >
                                </div>

                                <div class="form-group">
                                    <label for="cate_title">充值卡面额</label>
                                    <input  class="form-control" name="card_money"  placeholder="充值卡可以充值的流量(单位GB)" >
                                </div>

                                <div class="form-group">
                                    <label for="cate_title">充值卡数量</label>
                                    <input  class="form-control" name="card_num" placeholder="要生成的充值卡数量"  >
                                </div>


                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" name="action" value="add" class="btn btn-primary">添加</button>
                            </div>

                        </form>
                    </div>
                </div><!-- /.box -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>
