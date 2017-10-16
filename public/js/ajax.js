// this function fires when the whole web page is loaded
$(document).ready(function() {
    $("#category_id").on("change", function() {
        var cid = $(this).val();

        $.ajax({
            url: "/admin/featured/ajaxproduct/" + cid,
            type: 'get',
            success: function(response) {
                var combobox = '<select name="product_id" class="form-control" id="product_id">';
                $.each(response,function(k,v){
                    combobox += '<option value="' + v.id + '">' + v.title + '</option>';
                });
                combobox += '</select>';
                $('#productoption').html(combobox);

            },
            error: function(error) {
                console.log(error);
            }
        });

    });
});
