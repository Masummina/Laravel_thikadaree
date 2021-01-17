<!DOCTYPE html>
<html>
<head>    

    @include('admin.layouts.includes.header-style')
    @yield('extra_style')
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
     <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <style>
        #fixednavbar {
            overflow: hidden;
            background-color: #ecf0f5;
            z-index: 1;
        }

 

        /* Page content */
        .content {
            padding: 16px;
        }

        /* The sticky class is added to the navbar with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 83%;
            padding-bottom: 20px;
            border-bottom: 4px solid #d2d6de;
        }

        /* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
        .sticky + .content {
            padding-top: 60px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/admin/css/est.css')}}">
    
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        @include('admin.layouts.includes.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.layouts.includes.left-menu')
         
        @yield('content')
    
    </div>
    <!-- ./wrapper -->
    
    @include('admin.layouts.includes.footer-script')  

    @yield('extra_script')
 
  <script type="text/javascript">


    function PrintElem(elem)
    {
        PrintDiv($(elem).html());
    }

    function PrintDiv(data) 
    {
        var mywindow = window.open('', 'Urban design & development ltd.', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Urban design & development ltd.</title>');
        mywindow.document.write('</head><body >');        
        mywindow.document.write('<style> .box-title { margin-top: 20px; }  </style>');
        mywindow.document.write('<style> h1, h2, h3, h4, h5 { margin: 0px; padding: 0px; } .table {width:98%;} </style>');
        mywindow.document.write('<style> .table tr th,.table tr td{border:1px solid #000; border-width:1px 1px 0px 0px; color: #000; } .table{border-left:1px solid #000;}.table{border-bottom:1px solid #000; } #print_able .table tr th:last,#print_able .table tr td:last{display:none;} </style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

      function exportTableToExcel(tableID, filename = '',report_header='')
      {
          var downloadLink;
          var dataType = 'application/vnd.ms-excel';
          var tableSelect = document.getElementById(tableID);
          var tableHTML = '';

          if(report_header!='')
          {
              tableHTML = $("#"+report_header).html();
          } else {
              tableHTML = '';
          }

          tableHTML = tableHTML + tableSelect.outerHTML.replace(/ /g, '%20');

          // Specify file name
          filename = filename?filename+'.xls':'excel_data.xls';

          // Create download link element
          downloadLink = document.createElement("a");

          document.body.appendChild(downloadLink);

          if(navigator.msSaveOrOpenBlob){
              var blob = new Blob(['\ufeff', tableHTML], {
                  type: dataType
              });
              navigator.msSaveOrOpenBlob( blob, filename);
          }else{
              // Create a link to the file
              downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

              // Setting the file name
              downloadLink.download = filename;

              //triggering the function
              downloadLink.click();
          }
      }

  </script>


    <script src="{{ asset('js/word/FileSaver.js') }}"></script>
    <script src="{{ asset('js/word/jquery.wordexport.js') }}"></script>

    <script type="text/javascript">
        function wordDownload(content_ID) {
            //$("table").css({"background-color": "yellow", "font-size": "200%"});
            $('table.table').attr('border', '1');
            $("#"+content_ID).wordExport();
        }
    </script>
 



</body>
</html>
