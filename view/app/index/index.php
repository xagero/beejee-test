<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 17:21
 */

/** @var $this Response */
use App\Response;
use App\Service\PaginatorService;

/** @var PaginatorService $paginator */
$paginator = $this->content['paginator'];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include __DIR__ . '/../head.php';
    ?>

</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 100px;">
        <div class="col-md-12">

            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">Менеджер задач</h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a href="/index.php?action=create" type="button" class="btn btn-sm btn-primary btn-create" style="width: 200px;">Добавить задание</a>
                            <?php
                            if (isset($this->content['admin'])) {
                                print '<a href="/index.php?action=logout" type="button" class="btn btn-sm btn-primary btn-create" style="width: 200px;">Выход</a>';
                            } else{
                                print '<a href="/index.php?action=login" type="button" class="btn btn-sm btn-primary btn-create" style="width: 200px;">Управление</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th style="width: 160px;"><a href="<?php print $paginator->url(['sortby' => 'username']); ?>">Пользователь</a></th>
                            <th style="width: 100px;"><a href="/index.php?sort=email">Email</a></th>
                            <th style="width: 700px; ">Задание</th>
                            <th style="width: 320px; ">Изображение</th>
                            <th style="width: 40px"><em class="fa fa-cog" style="width: 40px;"></em></th>

                            <?php
                            if (isset($this->content['admin'])):
                            ?>
                            <th>Управление</th>

                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($this->content['list'] as $row):
                            print "<tr>\n";
                            print "<td>{$row['username']}</td>\n";
                            print "<td>{$row['email']}</td>\n";
                            print "<td>{$row['text']}</td>\n";
                            if ($row['image']) {
                                print "<td><img src='{$row['image']}' style='width:320px;height:240px;' ></td>\n";
                            } else {
                                print "<td>&nbsp;</td>\n";
                            }


                            if ($row['status'] == 1) {
                                print "<td>Yes</td>\n";
                            } else {
                                print "<td>No</td>\n";
                            }

                            if (isset($this->content['admin'])):
                            ?>
                        <td align="center">
                            <a class="btn btn-default" href="/index.php?action=edit&id=<?php print $row['id'];?>">
                                <em class="fa fa-pencil"></em>
                            </a>
                            <a href="/index.php?action=delete&id=<?php print $row['id'];?>" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                        </td>
<?php
                                endif;
                        print "</tr>";
                        endforeach;
                        ?>
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-4">
                            <?php printf('Страница %1$d из %2$d', $paginator->getCurrentPage(), $paginator->getTotalPage()); ?>
                        </div>
                        <div class="col col-xs-8">
                            <ul class="pagination hidden-xs pull-right">
                                <li><a href="<?php print $paginator->url(['page' => 1]); ?>">&laquo;</a></li>
                                <?php
                                for ($i=1; $i<= $paginator->getTotalPage(); $i++) {
                                    if ($i == $paginator->getCurrentPage()) {
                                        printf('<li class="disabled"><a href="%2$s">%1$d</a></li>', $i, $paginator->url(['page' => $i]));
                                    } else {
                                        printf('<li><a href="%2$s">%1$d</a></li>', $i, $paginator->url(['page' => $i]));
                                    }
                                }
                                ?>
                                <li><a href="<?php print $paginator->url(['page' => $paginator->getTotalPage()]); ?>">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
