    <footer class="footer">
            <strong>Copyright © 2021 <b>PowerOn BMS</b>.</strong>
            All rights reserved. Powered by <a href="mailto:skema221@gmail.com"><b>JM Tripoli</b></a>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.4
            </div>
            
    </footer>

    <style>
        #pageTable,#TItemTable,#DTable,#ATable,#POTable,.dataTables_info,.dataTables_paginate  {
    font-family: tahoma;
    font-size: 12px;
    direction: ltr;
    position: relative;
    clear: both;
    *zoom: 1;
    zoom: 1;
}
    </style>
<script> 
   
    // $('.material_date').bootstrapMaterialDatePicker({ weekStart: 0, time: false,format: 'MM/DD/YYYY' }); 
    // $('.material_date_time').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm',shortTime: true });

    $(".select2").select2(); 
    $('.material_date_time').bootstrapMaterialDatePicker({time: false, format: 'YYYY-MM-DD'});
    $('.dropify').dropify(); 
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });

    $('.dropify-filename-inner').html('');

    $('#pageTable').DataTable({
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        'aaSorting': [],
        
        "aoColumnDefs": [{ 
            'bSortable': false, 
            'aTargets': [0] 
        }]
    });

    $('#TItemTable').DataTable({
        'aaSorting': [],
        "aoColumnDefs": [{ 
            'bSortable': false, 
            'aTargets': [0] 
        }],
        dom: 'Bfrtip',
        "pageLength": 10
    });

    $('#DTable').DataTable({
        'aaSorting': [],
        "aoColumnDefs": [{ 
            'bSortable': false, 
            'aTargets': [0] 
        }],
        dom: 'Bfrtip',
        "pageLength": 10
    });

    $('#ATable').DataTable({
        'aaSorting': [],
        "aoColumnDefs": [{ 
            'bSortable': false, 
            'aTargets': [0] 
        }],
        dom: 'Bfrtip',
        "pageLength": 10
    });

    $('#POTable').DataTable({
        'aaSorting': [],
        "aoColumnDefs": [{ 
            'bSortable': false, 
            'aTargets': [0] 
        }],
        dom: 'Bfrtip',
        "pageLength": 10
    })
    
    $('.table').removeClass('dataTable');
</script>
</body>

</html>