$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "otdel";
        var ident = "id";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-id='" + id +"']").remove();
                } else {
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var otdel = $('input#inputOtdel').val();
        $.ajax({
            url:'../add_otdel.php',
            method:'post',
            data:'otdel=' + otdel,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var otdel = $(this).closest('tr').data('otdel');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-otdel',otdel);
        $('input[name="otdel"]').val(otdel);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var otdel = $('#editModal input[name="otdel"]').val();
        $.ajax({
            url:'../update_otdel.php',
            method:'POST',
            data:'id=' + id + '&otdel=' + otdel,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})