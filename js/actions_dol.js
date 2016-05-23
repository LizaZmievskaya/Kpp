$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "dolzhnost";
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
        var dol = $('input#inputDol').val();
        $.ajax({
            url:'../add_dol.php',
            method:'post',
            data:'dol=' + dol,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var dol = $(this).closest('tr').data('dol');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-dol',dol);
        $('input[name="dol"]').val(dol);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var dol = $('#editModal input[name="dol"]').val();
        $.ajax({
            url:'../update_dol.php',
            method:'POST',
            data:'id=' + id + '&dol=' + dol,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})