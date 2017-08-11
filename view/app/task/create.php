<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 13:35
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include __DIR__ . '/../head.php';
    ?>

    <style type="text/css">
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }

        div.container div.row {
            padding-top: 50px;
        }

    </style>

</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="well well-sm">
            <form class="form-horizontal" action="/index.php?action=create" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center">Добавить задание</legend>

                    <?php
                    if (isset($this->content['message'])) {
                        print "<div class='alert alert-danger'>{$this->content['message']}</div>";
                    }
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="username">Имя пользователя</label>
                        <div class="col-md-10">
                            <input id="name" name="username" type="text" placeholder="Имя пользователя" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="email">E-mail</label>
                        <div class="col-md-10">
                            <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="message">Описание задания</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="message" name="text" placeholder="" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="image">Изображение</label>
                        <div class="col-md-10">
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                    </button>
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="upload"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-block" style="width: 160px;" name="submit">Создать</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>

<script type="application/javascript">

    $(document).on('click', '#close-preview', function(){
        $('.image-preview').popover('hide');
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
        );
    });

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            };
            reader.readAsDataURL(file);
        });
    });

</script>

</body>
</html>
