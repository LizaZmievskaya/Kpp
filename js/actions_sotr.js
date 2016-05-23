$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "sotrudnik";
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
        var id = $('input#inputID').val();
        var fam = $('input#inputFam').val();
        var imya = $('input#inputImya').val();
        var ot = $('input#inputOt').val();
        var otdel = $('select[name=otdel]').val();
        var dol = $('select[name=dol]').val();
        $.ajax({
            url:'../add_sotr.php',
            method:'post',
            data:'id=' + id + '&fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&otdel=' + otdel + '&dol=' + dol,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var fam = $(this).closest('tr').data('fam');
        var imya = $(this).closest('tr').data('imya');
        var ot = $(this).closest('tr').data('ot');
        var otdel = $(this).closest('tr').data('otdel');
        var dol = $(this).closest('tr').data('dol');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-fam',fam);
        $('#editModal').attr('data-imya',imya);
        $('#editModal').attr('data-ot',ot);
        $('#editModal').attr('data-otdel',otdel);
        $('#editModal').attr('data-dol',dol);
        $('input[name="id"]').val(id);
        $('input[name="fam"]').val(fam);
        $('input[name="imya"]').val(imya);
        $('input[name="ot"]').val(ot);
        $("select[name='otdel'] :contains('" + otdel + "')").attr("selected", "selected");
        $("select[name='dol'] :contains('" + dol + "')").attr("selected", "selected");
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal input[name="id"]').val();
        var fam = $('#editModal input[name="fam"]').val();
        var imya = $('#editModal input[name="imya"]').val();
        var ot = $('#editModal input[name="ot"]').val();
        var otdel = $('#editModal select[name="otdel"] :selected').val();
        var dol = $('#editModal select[name="dol"] :selected').val();
        $.ajax({
            url:'../update_sotr.php',
            method:'POST',
            data:'id=' + id + '&fam=' + fam + '&imya=' + imya + '&ot=' + ot + '&otdel=' + otdel + '&dol=' + dol,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})