$(function () {
    $(".my_table_data").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": true,
      "searching": true,
      "lengthChange": true,
      "paging": true,
    });

    $(".my_table_data_desc").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": true,
      "order": [[ 0, "desc" ]],
      "searching": true,
      "lengthChange": true,
      "paging": true,
    });

    $(".my_table_person").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": true,
      "searching": true,
      "lengthChange": false,
      "paging": false,
    });
  });