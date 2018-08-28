$(document).ready(function () {
  // confirm delete
  $(document.body).on('submit', '.js-confirm', function () {
    var $el = $(this)
    var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin melakukan tindakan ini?'
    var c = confirm(text);
    return c;
  });
  
  $('.js-selectize').selectize({
    //sortField: 'text'
  });


/*
  // add selectize to select element
  $('.js-selectize').selectize({
    sortField: 'text'
  });*/

  // delete review book
  $(document.body).on('submit', '.js-review-delete', function () {
    var $el  = $(this);
    var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin melakukan tindakan ini?';
    var c    = confirm(text);
    // cancel delete
    if (c === false) return c;

    // delete via ajax
    // disable behaviour default dari tombol submit
    event.preventDefault();
    // hapus data buku dengan ajax
    $.ajax({
      type     : 'POST',
      url      : $(this).attr('action'),
      dataType : 'json',
      data     : {
        _method : 'DELETE',
        // menambah csrf token dari Laravel
        _token  : $( this ).children( 'input[name=_token]' ).val()
      }
    }).done(function(data) {
      // cari baris yang dihapus
      baris = $('#form-'+data.id).closest('tr');
      // hilangkan baris (fadeout kemudian remove)
      baris.fadeOut(300, function() {$(this).remove()});
    });
  });

   $('.submit-release').click(function(){
    var release_detail_id = $('#release_detail_id').val();
    
    var checker = $('#checker').val();
    var drafter = $('#drafter').val();
    var approved = $('#approved').val();
    var keterangan = $('#keterangan').val();

    var _token = $('input[name="_token"]').val();
    var table = $('#dataTableBuilder').DataTable();

    var pathname = location.pathname;

    // if($('#title').val() =! '')
    // {
    //   alert('tes');
    //   var title = $('#title').val();
    // }
    var link = $('#link').val();
    var url = $('#url').val()+'/'+release_detail_id;

    var link_type = $('#link_type').val()+'/'+type;
    var url_type = $('#url_type').val()+'/'+release_detail_id;

    $('#releaseModal').hide();
    $('.modal-backdrop').hide();

    if (release_detail_id != ''){
      if(pathname == '/admin/release')
        {
        $.ajax({
        url: url ,
        data : {"_token" : _token , "checker" : checker, "drafter" : drafter, "approved": approved, "keterangan": keterangan},
        type: 'post',
        cache : false ,
        success : function (success){
            alert("Berhasil Release");
            window.location.href = link;
            //table.ajax.reload();
        },
        error :   function(data){
            alert ("Gagal Release");
            window.location.href = link;
        }
        });
      }
      else
      {
        $.ajax({
        url: url_type ,
        data : {"_token" : _token , "checker" : checker, "drafter" : drafter, "approved": approved, "keterangan": keterangan},
        type: 'post',
        cache : false ,
        success : function (success){
            alert("Berhasil Release");
            window.location.href = link_type;
            //table.ajax.reload();
        },
        error :   function(data){
            alert ("Gagal Release");
            window.location.href = link_type;
        }
        });
      }
    }
  });

});

