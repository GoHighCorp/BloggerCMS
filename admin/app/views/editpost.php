<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
</head>
<body>

<div id="wrapper">
    <!-- Navigation -->
    <?php require_once 'includes/nav.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title; ?></h1>
                <?php require_once 'includes/line.php' ?>

                <div class="content">
                    <?php echo $flash['info']; ?>

                    <form action="<?php echo $root; ?>/update_post/<?php echo $id; ?>" class="form-horizontal" method="post">
                        <div class="row">
                            <div class="form-group col-lg-8">
                                <label for="author">Post Author</label>
                                <input required type="text" id="author" name="author" class="form-control" value="<?php echo $data['author'];?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-8">
                                <label for="title">Post Title</label>
                                <input required type="text" id="title" name="title" class="form-control" value="<?php echo $data['title']; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-8">
                                <label for="tags">Tags</label>
                                <select required name="tags[]" id="tags" class="select2 tags form-control" multiple="multiple">
                                    <?php
                                    foreach ($data['tagsAll'] as $tag) {
                                        $selected = (true === in_array($tag, $data['tags'])) ? 'selected' : '';
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $tag; ?>"><?php echo $tag; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-8">
                                <label for="category">Category</label>
                                <select required name="category" id="category" class="select2 form-control">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($data['categories'] as $category) {
                                        $selected = ($category === $data['category']) ? 'selected' : '';
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <br/>
                                <button data-toggle="modal" data-target="#modal-category-new" style="margin-top: 3px;" type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> New Category
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="body">Post Body</label>
                                <textarea required id="body" name="body" class="form-control" rows="15"><?php echo $data['body']; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label for="status">Post Status</label>
                                <select required name="status" id="status" class="form-control">
                                    <option <?php echo $data['status'] === 'publised' ? 'selected' : ''; ?> value="publised">
                                        Publised
                                    </option>
                                    <option <?php echo $data['status'] === 'draft' ? 'selected' : ''; ?> value="draft">
                                        Draft
                                    </option>
                                    <option <?php echo $data['status'] === 'trashed' ? 'selected' : ''; ?> value="trashed">
                                        Trashed
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <button name="addpost" value="addpost" type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update
                                Post
                            </button>
                        </div>

                        <input type="hidden" name="prevStatus" value="<?php echo $data['status']; ?>"/>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'includes/foot.php' ?>

<!-- modal add new category start -->
<div id="modal-category-new" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 style="margin: 0;"><i class="fa fa-plus"></i> New Category</h4>
            </div>
            <div class="modal-body text-center">
                <input type="text" id="new_category" class="form-control"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    Close
                </button>
                <button id="btn_addcatgory_modal" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Add Category
                </button>
            </div>
        </div>
    </div>
</div>
<!-- modal add new category end -->


<script>
    (function () {
        $("textarea#body").pagedownBootstrap({
            "help": function () {
                window.open('http://daringfireball.net/projects/markdown/syntax');
            }
        });

        $('.wmd-preview').addClass('well');

        $('#btn_addcatgory_modal').click(function () {
            var category = $.trim($('#new_category').val());

            if (category) {
                var categoryInput = $('#category');

                categoryInput.append(
                   $('<option selected></option>')
                      .val(category)
                      .html(category)
                );

                categoryInput.select2();

                $('#modal-category-new').modal('hide');
            } else {
                alert('Please specify category name first');
            }
        });

    })();
</script>

</body>
</html>

