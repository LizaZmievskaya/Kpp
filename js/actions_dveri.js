$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "dveri";
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
        var dveri = $('input#inputDveri').val();
        $.ajax({
            url:'../add_dveri.php',
            method:'post',
            data:'dveri=' + dveri,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var dveri = $(this).closest('tr').data('dveri');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-dveri',dveri);
        $('input[name="dveri"]').val(dveri);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var dveri = $('#editModal input[name="dveri"]').val();
        $.ajax({
            url:'../update_dveri.php',
            method:'POST',
            data:'id=' + id + '&dveri=' + dveri,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})