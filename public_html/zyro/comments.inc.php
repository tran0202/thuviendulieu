
<div id="wb_element_instance8" class="wb_element" style="width: 100%;">
    <?php
    global $show_comments;
    if (isset($show_comments) && $show_comments) {
        renderComments(1);
        ?>
        <script type="text/javascript">
            $(function() {
                var block = $("#wb_element_instance8");
                var comments = block.children(".wb_comments").eq(0);
                var contentBlock = $("#wb_main");
                contentBlock.height(contentBlock.height() + comments.height());
            });
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            $(function() {
                $("#wb_element_instance8").hide();
            });
        </script>
        <?php
    }
    ?>
</div>
