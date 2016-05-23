$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "otkritie";
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
        var dveri = $('select[name=dveri]').val();
        var sotr = $('select[name=sotr]').val();
        var d1 = $('input#inputD1').val();
        var d2 = $('input#inputD2').val();
        $.ajax({
            url:'../add_otkr.php',
            method:'post',
            data:'dveri=' + dveri + '&sotr=' + sotr + '&d1=' + d1 + '&d2=' + d2,
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
        var sotr = $(this).closest('tr').data('sotr');
        var d1 = $(this).closest('tr').data('d1');
        var d2 = $(this).closest('tr').data('d2');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-dveri',dveri);
        $('#editModal').attr('data-sotr',sotr);
        $('#editModal').attr('data-d1',d1);
        $('#editModal').attr('data-d2',d2);
        $("select[name='dveri'] :contains('" + dveri + "')").attr("selected", "selected");
        $("select[name='sotr'] :contains('" + sotr + "')").attr("selected", "selected");
        $('input[name="d1"]').val(d1);
        $('input[name="d2"]').val(d2);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var d1 = $('#editModal input[name="d1"]').val();
        var d2 = $('#editModal input[name="d2"]').val();
        var dveri = $('#editModal select[name="dveri"] :selected').val();
        var sotr = $('#editModal select[name="sotr"] :selected').val();
        $.ajax({
            url:'../update_otkr.php',
            method:'POST',
            data:'id=' + id + '&dveri=' + dveri + '&sotr=' + sotr + '&d1=' + d1 + '&d2=' + d2,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})