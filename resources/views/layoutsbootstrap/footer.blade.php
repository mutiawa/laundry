      
        
      </div>
    </div>
  </div>
  <script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/sidebarmenu.js')}}"></script>
  <script src="{{asset('js/app.min.js')}}"></script>
  <script src="{{asset('libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>


  <!-- Datatables plugin -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>    
    
  <!-- js untuk select2  -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
          $(document).ready(function () {
              $("#jenis_dok").select2({
                dropdownParent: $('#ubahModal')
              });
          });
      </script>

  <!-- fancy box -->
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

</body>

</html>