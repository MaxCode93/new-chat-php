<!--Permission denied Modal-->
<div id="sa-title"></div>
<!--Permission denied Modal-->
</div>
<footer class="footer text-center"> 20<?php echo date(y);?> &copy; Powered By Maxwell, Panel Admin <br> Version: 4.1(Beta)</footer>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="js/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Counter js -->
<script src="js/waypoints/lib/jquery.waypoints.js"></script>
<script src="js/counterup/jquery.counterup.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Sweet-Alert  -->
<script src="js/sweetalert/sweetalert.min.js"></script>
<script src="js/sweetalert/jquery.sweet-alert.custom.js"></script>
<!--Morris JavaScript -->
<script src="js/raphael/raphael-min.js"></script>
<script src="js/morrisjs/morris.js"></script>
<script src="js/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="js/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<script language="JavaScript"><!--
    function checkBox(theElement)
    {
        var theForm = theElement.form, z = 0;
        for(z=0; z<theForm.length;z++)
        {
            if(theForm[z].type == 'checkbox' && theForm[z].name != 'selall')
            {
                theForm[z].checked = theElement.checked;
            }
        }
    }
    function init(){
        var theForm = document.f1;
        var aBox = theForm["list[]"];
        var selAll = false;
        var i;
        for(i=0;i<aBox.length;i++){
            if(aBox[i].checked==false) selAll=true;
            aBox[i].onclick = function(){checkBox(this)};
        }
        //theForm.selall.checked = selAll;
    }

    function MM_jumpMenu(targ,selObj,restore){ //v3.0
        eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
        if (restore) selObj.selectedIndex=0;
    }
    //--></script>
<script type="text/javascript">
    $('#slimtest1').slimScroll({
        height: '250px'
    });
    $('#slimtest2').slimScroll({
        height: '250px'
    });
    $('#slimtest3').slimScroll({
        position: 'left',
        height: '250px',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '250px',
        alwaysVisible: true
    });
</script>

<script src="js/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>

<!-- end - This is for export functionality only -->

<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [
                    { "visible": false, "targets": 2 }
                ],
                "order": [[ 2, 'asc' ]],
                "displayLength": 25,
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;

                    api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                            );

                            last = group;
                        }
                    } );
                }
            } );

            // Order by the grouping
            $('#example tbody').on( 'click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
                    table.order( [ 2, 'desc' ] ).draw();
                }
                else {
                    table.order( [ 2, 'asc' ] ).draw();
                }
            });
        });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#message tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
        } );

        // DataTable
        var table = $('#message').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );
</script>

<script src="js/dashboard1.js"></script>
<script src="js/jasny-bootstrap.js"></script>
<!--Style Switcher -->
<script src="js/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
