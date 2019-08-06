$(document).ready(function() {
    // start js table sort search
    $.fn.dataTable.ext.order['dom-text-numeric'] = function  ( settings, col )
    {
        return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
            return $('input', td).val() * 1;
        } );
    }
    var table = $('#categorytable').DataTable({
        "dom": '<"pull-right"f><"pull-left"l>tip',
        "lengthMenu": [ 5, 25, 50, 100 ],
        "aaSorting": [[ 1, "asc" ]],
        "language": {
            'paginate': {
              'previous': '<span class="prev-icon">‹</span>',
              'next': '<span class="next-icon">›</span>'
            }
        },
        "columns": [
        null,
        null,
        null,
        null,
        null,
        null,
        ],
    });
    // end js table sort search
    $( '.delete_simple' ) . on ('click', function () {
        var id = $(this).data('id');
		$.confirm({
            title: 'Delete this Item!',
            content: 'Are You Sure To Delete It',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Yes',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                            url : 'simple/delete/' + id,
                            data : {'_token' : token},
                            method : 'get',
                            success : function (r) {
                                location.reload();
                            },
                            error : function (r) {
                                console.log(r);
                            }
                        });
                    }
                },
                close: {
                    'text' : "No"
                }
            }
        });
	})
});